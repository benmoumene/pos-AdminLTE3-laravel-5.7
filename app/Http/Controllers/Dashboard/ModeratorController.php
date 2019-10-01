<?php

namespace App\Http\Controllers\Dashboard;

use Alert;
use View;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class ModeratorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read_users'])->only('index');
        $this->middleware(['permission:create_users'])->only('create');
        $this->middleware(['permission:update_users'])->only('edit');
        $this->middleware(['permission:delete_users'])->only('destroy');

        $general_settings = DB::table('general_settings')->where('id', 1)->get();
        foreach ($general_settings as $key => $general_setting) {
            $store_id = $general_setting->id;
            $store_name = $general_setting->store_name;
            $start_day = $general_setting->start_day;
            $logo = $general_setting->image;
            $investment_capital = $general_setting->investment_capital;
        }
        // Sharing is caring
        View::share('store_id', $store_id);
        View::share('store_name', $store_name);
        View::share('start_day', $start_day);
        View::share('logo', $logo);
        View::share('investment_capital', $investment_capital);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $moderator = User::whereRoleIs('employer')->where(function ($q) use ($request) {
            return $q->when($request->search, function ($query) use ($request) {
                return $query
                    ->where('first_name', 'like', '%' . $request->search . '%')
                    ->orwhere(
                        'last_name',
                        'like',
                        '%' . $request->search . '%'
                    );
            });
        })->latest()->paginate(5);
        return view('dashboard.moderator.index', compact('moderator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.moderator.create', compact('moderator'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users',
            'image' => 'image',
            'password' => 'required|confirmed',
            'permissions' => 'required|min:1'
        ]);
        $request_data = $request->except([
            'password',
            'password_confirmation',
            'permissions',
            'image'
        ]);
        $request_data['password'] = bcrypt($request->password);
        if ($request->image) {
            Image::make($request->image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(
                    public_path(
                        'uploads/moderator_images/' .
                            $request->image->hashName()
                    )
                );
            $request_data['image'] = $request->image->hashName();
        }
        $moderator = User::create($request_data);
        $moderator->attachRole('employer');
        $moderator->syncPermissions($request->permissions);
        toast('Created Successfully', 'success', 'top-right');
        return redirect()->route('moderator.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $moderator)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $moderator)
    {
        return view('dashboard.moderator.edit', compact('moderator'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $moderator)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => [
                'required',
                Rule::unique('users')->ignore($moderator->id)
            ],
            'image' => 'image',
            'permissions' => 'required|min:1'
        ]);
        $request_data = $request->except(['permissions', 'image']);
        if ($request->image) {
            if ($moderator->image != 'default.png') {
                Storage::disk('public_uploads')->delete(
                    '/moderator_images/' . $moderator->image
                );
            }
            Image::make($request->image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(
                    public_path(
                        'uploads/moderator_images/' .
                            $request->image->hashName()
                    )
                );
            $request_data['image'] = $request->image->hashName();
        }
        $moderator->update($request_data);
        $moderator->syncPermissions($request->permissions);
        toast('Updated Successfully', 'success', 'top-right');
        return redirect()->route('moderator.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $moderator)
    {
        if ($moderator->image != 'default.png') {
            Storage::disk('public_uploads')->delete(
                '/moderator_images/' . $moderator->image
            );
        }

        $moderator->delete();
        toast('deleted Successfully', 'error', 'top-right');
        return redirect()->route('moderator.index');
    }
}