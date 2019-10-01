<?php

namespace App\Http\Controllers\Dashboard;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        $products = Product::when($request->search, function ($q) use ($request) {
            return $q->where('product_name', 'like', '%' . $request->search . '%');
        })->when($request->category_id, function ($q) use ($request) {
            return $q->where('category_id', $request->category_id);
        })->latest()->paginate(5);
        return view('dashboard.product.index', compact('categories', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.product.create', compact('categories'));
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
            'category_id' => 'required',
            'codebar' => 'required|unique:products,codebar',
            'product_name' => 'required|unique:products,product_name',
            'purchase_price' => 'required',
            'sale_price' => 'required',
            'stock' => 'required',
            'min_stock' => 'required',
            //'image' => 'image',

        ]);
        $request_data = $request->all();
        if ($request->image) {
            Image::make($request->image)
                ->resize(160, 160, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(
                    public_path(
                        'uploads/product_images/' .
                            $request->image->hashName()
                    )
                );
            $request_data['image'] = $request->image->hashName();
        }
        Product::create($request_data);
        toast('Created Successfully', 'success', 'top-right');
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }
    // search fuction for sale product
    public function searchsale(Request $request)
    {
        $output = "";
        $product = $request->pro;
        $products = Product::where('product_name', 'like', '%' . $product . '%')->get();
        foreach ($products as $product) {
            $output .= '<div class="col-lg-3 col-md-4 col-6"><a href="" id="product" data-toggle="tooltip" title="' . $product->product_name . ' Price : ' . $product->sale_price . '"
                            data-placement="top" id="product-' . $product->id . '" +
                            data-name="' . $product->product_name . '" + data-id="' . $product->id . '" +
                            data-price="' . $product->sale_price . '" + data-stock="' . $product->stock . '" class="con d-block mb-4
                                add-product-btn">
                            <img class="img-fluid img-thumbnail" src="' . $product->image_path . '" alt="">
                            <div class="overlay overlayFade text-center">
                                <div class="text">
                                    <h6>Stock Left</h6>
                                    <h6 class="text-nowrap stock">' . $product->stock . '</h6>
                                </div>
                            </div>
                        </a>
                    </div>';
        }

        return $data = array('row_result' => $output,);
    }
    // search fuction for purchase product
    public function searchpurchase(Request $request)
    {
        $output = "";
        $product = $request->pro;
        $products = Product::where('product_name', 'like', '%' . $product . '%')->get();
        foreach ($products as $product) {
            $output .= '<div class="col-lg-3 col-md-4 col-6"><a href="" id="product" data-toggle="tooltip" title="' . $product->product_name . ' Price : ' . $product->purchase_price . '"
                            data-placement="top" id="product-' . $product->id . '" +
                            data-name="' . $product->product_name . '" + data-id="' . $product->id . '" +
                            data-price="' . $product->purchase_price . '" + data-stock="' . $product->stock . '" class="con d-block mb-4
                                add-product-btn">
                            <img class="img-fluid img-thumbnail" src="' . $product->image_path . '" alt="">
                            <div class="overlay overlayFade text-center">
                                <div class="text">
                                    <h6>Stock Left</h6>
                                    <h6 class="text-nowrap stock">' . $product->stock . '</h6>
                                </div>
                            </div>
                        </a>
                    </div>';
        }

        return $data = array('row_result' => $output,);
    }

    public function addproduct(Request $request)
    {
        $out = "";
        $barcode = $request->code;
        $products = Product::where('codebar', '=', $barcode)->get();
        foreach ($products as $product) {
            $out .= '
                    <tr class="form-group items">
                                <td class="namex">' . $product->product_name . '</td>
                                <input type="hidden" name="product[]" value="' . $product->id . '">
                                <td style="display: flex;">        
                                <input id="qty" style="width: 60% !important;" type="number" name="quantity[]" data-price="' . $product->purchase_price . '" data-stock="' . $product->stock . '" class="form-control input-sm product-quantity" min="1" max="' . $product->stock . '" value="1">
                                </td>
                                <td class="product-price">' . $product->purchase_price . '</td>
                                <td><button type="button" class="btn btn-danger btn-sm remove-product-btn" data-id="' . $product->id . '"><span class="fa fa-trash"></span></button></td>
                    </tr>';
        }

        return $data = array('addproduct' => $out,);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('dashboard.product.edit', compact('categories', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => 'required',
            'codebar' => [
                'digits:13',
                'required',
                Rule::unique('products')->ignore($product->id)
            ],
            'product_name' => [
                'required',
                Rule::unique('products')->ignore($product->id)
            ],
            'purchase_price' => 'required',
            'sale_price' => 'required',
            'stock' => 'required',
            'min_stock' => 'required',
            'image' => 'image',

        ]);
        $request_data = $request->all();
        if ($request->image) {
            if ($product->image != 'product.png') {
                Storage::disk('public_uploads')->delete(
                    '/product_images/' . $product->image
                );
            }
            Image::make($request->image)
                ->resize(160, 160, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(
                    public_path(
                        'uploads/product_images/' .
                            $request->image->hashName()
                    )
                );
            $request_data['image'] = $request->image->hashName();
        }
        $product->update($request_data);
        toast('Product Updated Successfully', 'success', 'top-right');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if ($product->image != 'product.png') {
            Storage::disk('public_uploads')->delete(
                '/product_images/' . $product->image
            );
        }

        $product->delete();
        toast('Product deleted Successfully', 'error', 'top-right');
        return redirect()->route('product.index');
    }
}
