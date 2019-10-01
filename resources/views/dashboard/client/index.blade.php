@extends('layouts.main')

@section('page')
clients Page
@stop

@section('content')
@include('sweet::alert')
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header with-border">

            <form action="{{ route('client.index') }}" method="get">

                <div class="row no-gutters">
                    <div class="col-12 col-sm-6 col-md-8">
                        <h3 class="card-title">List clients</h3>
                    </div>
                    <div class="col-6 col-md-4">
                        @if (auth()->user()->hasPermission('create_clients'))
                        <a type="" class="btn btn-success btn float-right" style=""
                            href="{{ route('client.create') }}"><i class="fas fa-user-plus"></i>
                            add new client</a>
                        @else
                        <a type="" class="btn btn-success disabled btn float-right" href="#"><i
                                class="fas fa-user-plus"></i>
                            add
                            new
                            client</a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        <!-- /.card-header -->
        <div class="card-body">
            <div id="client_table_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="client_table" class="table table-bordered table-striped table-hover  dataTable"
                            role="grid" aria-describedby="client_table_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="client_table" rowspan="1"
                                        colspan="1" aria-sort="ascending"
                                        aria-label="Rendering engine: activate to sort column descending"
                                        style="width: 283px;">No</th>
                                    <th class="sorting" tabindex="0" aria-controls="client_table" rowspan="1"
                                        colspan="1" aria-label="Browser: activate to sort column ascending"
                                        style="width: 359px;">client
                                        name</th>
                                    <th class="sorting" tabindex="0" aria-controls="client_table" rowspan="1"
                                        colspan="1" aria-label="Platform(s): activate to sort column ascending"
                                        style="width: 250px;">phone</th>
                                    <th class="sorting" tabindex="0" aria-controls="client_table" rowspan="1"
                                        colspan="1" aria-label="Platform(s): activate to sort column ascending"
                                        style="width: 250px;">Address</th>
                                    <th class="sorting" tabindex="0" aria-controls="client_table" rowspan="1"
                                        colspan="1" aria-label="Platform(s): activate to sort column ascending"
                                        style="width: 250px;">No: RC</th>
                                    <th class="sorting" tabindex="0" aria-controls="client_table" rowspan="1"
                                        colspan="1" aria-label="Platform(s): activate to sort column ascending"
                                        style="width: 250px;">No: Article</th>
                                    <th class="sorting" tabindex="0" aria-controls="client_table" rowspan="1"
                                        colspan="1" aria-label="Platform(s): activate to sort column ascending"
                                        style="width: 250px;">NIF</th>
                                    <th class="sorting" tabindex="0" aria-controls="client_table" rowspan="1"
                                        colspan="1" aria-label="Platform(s): activate to sort column ascending"
                                        style="width: 250px;">NIS</th>
                                    <th class="sorting" tabindex="0" aria-controls="client_table" rowspan="1"
                                        colspan="1" aria-label="Engine version: activate to sort column ascending"
                                        style="width: 243px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($clients as $index => $client)

                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $client -> client_name }}</td>
                                    <td>{{ $client -> phone }}</td>
                                    <td>{{ $client -> address }}</td>
                                    <td>{{ $client -> rc }}</td>
                                    <td>{{ $client -> article }}</td>
                                    <td>{{ $client -> nif }}</td>
                                    <td>{{ $client -> nis }}</td>
                                    <td>
                                        @if (auth()->user()->hasPermission('update_clients'))
                                        <a class="btn btn-warning btn-sm"
                                            href="{{ route('client.edit', $client->id) }}"><i class="fas fa-edit"></i>
                                            update</a>
                                        @else
                                        <a class="btn btn-warning btn-sm disabled"
                                            href="{{ route('client.edit', $client->id) }}"><i class="fas fa-edit"></i>
                                            update</a>
                                        @endif
                                        @if (auth()->user()->hasPermission('delete_clients'))
                                        <button id="delete" onclick="deletemoderator({{ $client->id }})"
                                            class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>
                                            delete</button>
                                        <form id="form-delete-{{ $client->id }}"
                                            action="{{ route('client.destroy', $client->id) }}" method="post"
                                            style="display:inline-block;">
                                            {{ csrf_field() }}
                                            {{ method_field('delete') }}
                                        </form>
                                        @else
                                        <button type="submit" class="btn btn-danger btn-sm disabled"><i
                                                class="fas fa-trash"></i>
                                            delete</button>
                                        @endif

                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th rowspan="1" colspan="1">No</th>
                                    <th rowspan="1" colspan="1">client name</th>
                                    <th rowspan="1" colspan="1">Phone</th>
                                    <th rowspan="1" colspan="1">Address</th>
                                    <th rowspan="1" colspan="1">No: RC</th>
                                    <th rowspan="1" colspan="1">No: article</th>
                                    <th rowspan="1" colspan="1">NIF</th>
                                    <th rowspan="1" colspan="1">NIS</th>
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
