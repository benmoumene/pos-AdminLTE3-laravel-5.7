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

            <form action="{{ route('moderator.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('post') }}
                @include('partials._errors')
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>first name</label>
                            <input type="text" name="first_name" id="" class="form-control"
                                value="{{ old('first_name') }}" required>
                        </div>
                        <div class="form-group">
                            <label>last name</label>
                            <input type="text" name="last_name" id="" class="form-control"
                                value="{{ old('last_name') }}" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" id="" class="form-control" value="{{ old('email') }}"
                                required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" id="" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Password Confirmation</label>
                            <input type="password" name="password_confirmation" id="" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="card">
                                <div class="card-header d-flex p-0">
                                    <h3 class="card-title p-3">Moderator Permission</h3>
                                    @php
                                    $models =
                                    ['users','categories','products','clients','providers','sales','purchases'];
                                    $maps = ['create', 'read', 'update', 'delete'];
                                    @endphp
                                    <ul class="nav nav-pills ml-auto p-2">
                                        @foreach ($models as $index=>$model)
                                        <li class="nav-item {{ $index == 0 ? 'active' :'' }}"><a
                                                class="nav-link {{ $index == 0 ? 'active' :'' }}" href="#{{ $model }}"
                                                data-toggle="tab">{{ $model }}</a></li>
                                        @endforeach
                                    </ul>
                                </div><!-- /.card-header -->
                                <div class="card-body">
                                    <div class="tab-content">
                                        <!-- /.tab-pane -->
                                        @foreach ($models as $index=>$model)
                                        <div class="tab-pane  {{ $index == 0 ? 'active' :'' }}" id="{{ $model }}">
                                            @foreach ($maps as $map)
                                            <label><input type="checkbox" name="permissions[]"
                                                    value="{{ $map .'_'. $model }}">
                                                {{
                                                $map }}</label>
                                            @endforeach
                                        </div>
                                        @endforeach

                                    </div>
                                    <!-- /.tab-content -->
                                </div><!-- /.card-body -->
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" name="image" class="form-control image custom-file-input"
                                    id="customFile">
                                <label class="custom-file-label" for="customFile">Choose Moderator Photo</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <img src="{{ asset('uploads/moderator_images/default.png') }}" style="width:200px;"
                                class="img-circle img-thumbnail img-preview" alt="" srcset="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer form-group">
                    <button type="submit" class="btn btn-success" href="{{ route('moderator.store') }}"><i
                            class="fas fa-user-plus"></i>
                        Add new moderator</button>
                </div>
            </form>

        </div>
        <!-- /.card-body -->

    </div>
</div>


@stop
