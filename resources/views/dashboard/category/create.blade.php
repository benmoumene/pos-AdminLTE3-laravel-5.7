@extends('layouts.main')

@section('page')
Create Moderators
@stop

@section('content')

<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header with-border">
            <h3 class="card-title">Create a new Moderator</h3>
        </div>

        <!-- /.card-header -->
        <div class="card-body">

            <form action="{{ route('category.store') }}" method="post">
                {{ csrf_field() }}
                {{ method_field('post') }}
                @include('partials._errors')
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Category name</label>
                            <input type="text" name="category_name" id="" class="form-control" value="{{ old('category_name') }}">
                        </div>
                        <div class="form-group">
                            <label>Brand name</label>
                            <input type="text" name="brand_name" id="" class="form-control" value="{{ old('brand_name') }}">
                        </div>

                    </div>
                </div>
                <div class="modal-footer form-group">
                    <button type="submit" class="btn btn-success" href="{{ route('category.store') }}"><i class="fas fa-user-plus"></i>
                        Add new category</button>
                </div>
            </form>

        </div>
        <!-- /.card-body -->

    </div>
</div>


@stop
