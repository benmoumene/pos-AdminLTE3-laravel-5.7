@extends('layouts.main')

@section('page')
Categories Page
@stop

@section('content')
@include('sweet::alert')
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header with-border">

            <form action="{{ route('category.index') }}" method="get">

                <div class="row no-gutters">
                    <div class="col-12 col-sm-6 col-md-8">
                        <h3 class="card-title">List Categories</h3>
                    </div>
                    <div class="col-6 col-md-4">
                        @if (auth()->user()->hasPermission('create_categories'))
                        <a type="" class="btn btn-success btn float-right" style="" href="{{ route('category.create') }}"><i
                                class="fas fa-user-plus"></i>
                            add new category</a>
                        @else
                        <a type="" class="btn btn-success disabled btn float-right" href="#"><i class="fas fa-user-plus"></i>
                            add
                            new
                            category</a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        <!-- /.card-header -->
        <div class="card-body">
            <div id="category_table_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="category_table" class="table table-bordered table-striped table-hover  dataTable"
                            role="grid" aria-describedby="category_table_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="category_table" rowspan="1"
                                        colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending"
                                        style="width: 283px;">No</th>
                                    <th class="sorting" tabindex="0" aria-controls="category_table" rowspan="1" colspan="1"
                                        aria-label="Browser: activate to sort column ascending" style="width: 359px;">Category
                                        name</th>
                                    <th class="sorting" tabindex="0" aria-controls="category_table" rowspan="1" colspan="1"
                                        aria-label="Platform(s): activate to sort column ascending" style="width: 320px;">Brand
                                        name</th>
                                    <th class="sorting" tabindex="0" aria-controls="category_table" rowspan="1" colspan="1"
                                        aria-label="Platform(s): activate to sort column ascending" style="width: 320px;">Related
                                        Product</th>
                                    <th class="sorting" tabindex="0" aria-controls="category_table" rowspan="1" colspan="1"
                                        aria-label="Engine version: activate to sort column ascending" style="width: 243px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($categories as $index => $category)

                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $category -> category_name }}</td>
                                    <td>{{ $category -> brand_name }}</td>
                                    <td><a href="{{ route('product.index', ['category_id'=>$category->id]) }}" class="btn btn-info text-white"><i
                                                class="fas fa-link"></i>
                                            {{
                                            $category ->
                                            products->count() }} Related
                                            Product</a></td>
                                    <td>
                                        @if (auth()->user()->hasPermission('update_categories'))
                                        <a class="btn btn-warning btn-sm" href="{{ route('category.edit', $category->id) }}"><i
                                                class="fas fa-edit"></i>
                                            update</a>
                                        @else
                                        <a class="btn btn-warning btn-sm disabled" href="{{ route('category.edit', $category->id) }}"><i
                                                class="fas fa-edit"></i>
                                            update</a>
                                        @endif
                                        @if (auth()->user()->hasPermission('delete_categories'))
                                        <button id="delete" onclick="deletemoderator({{ $category->id }})" class="btn btn-danger btn-sm"><i
                                                class="fas fa-trash"></i>
                                            delete</button>
                                        <form id="form-delete-{{ $category->id }}" action="{{ route('category.destroy', $category->id) }}"
                                            method="post" style="display:inline-block;">
                                            {{ csrf_field() }}
                                            {{ method_field('delete') }}
                                        </form>
                                        @else
                                        <button type="submit" class="btn btn-danger btn-sm disabled"><i class="fas fa-trash"></i>
                                            delete</button>
                                        @endif

                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th rowspan="1" colspan="1">No</th>
                                    <th rowspan="1" colspan="1">Category name</th>
                                    <th rowspan="1" colspan="1">Brand name</th>
                                    <th rowspan="1" colspan="1">Related Product</th>
                                    <th rowspan="1" colspan="1">Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->


    </div>
</div>


@stop
