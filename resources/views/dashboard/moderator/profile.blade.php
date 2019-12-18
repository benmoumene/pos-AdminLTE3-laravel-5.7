@extends('layouts.main')

@section('content')
<div class="col-md-12">
    <!-- Widget: user widget style 1 -->
    <div class="card card-widget widget-user">
        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class="widget-user-header bg-info">
            <h3 class="widget-user-username">{{ $profile->first_name }}
                {{ $profile->last_name }}</h3>
            <h4 class="widget-user-username">{{ $profile->email }}</h4>
        </div>
        <div class="widget-user-image">
            <img class="img-circle elevation-2" src="{{ $profile->image_path }}" alt="User Avatar">
        </div>
        <div class="card-body pt-5 text-center">
            @if($profile->hasRole('super_admin'))
            <h5 class="widget-user-desc">Role : Administrator</h5>
            @else
            <h5 class="widget-user-desc">Role : Employee</h5>
            @endif
            <h3>Lists Of All Permissions</h3>
        </div>
        <div class="card-footer">
            <div class="row">
                @foreach ($allprofilepermission as $profilepermission)
                <div class="col-sm-3 border-right">
                    <div class="description-block">
                        <h5 class="description-header">{{ $profilepermission->display_name }}</h5>
                    </div>
                    <!-- /.description-block -->
                </div>
                @endforeach
            </div>
            <!-- /.row -->
        </div>
    </div>
    <!-- /.widget-user -->
</div>
@endsection
