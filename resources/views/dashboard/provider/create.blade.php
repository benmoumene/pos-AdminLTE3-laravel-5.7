@extends('layouts.main')

@section('page')
Create provider
@stop

@section('content')

<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header with-border">
            <h3 class="card-title">Create a New provider</h3>
        </div>

        <!-- /.card-header -->
        <div class="card-body">

            <form action="{{ route('provider.store') }}" method="post">
                {{ csrf_field() }}
                {{ method_field('post') }}
                @include('partials._errors')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>provider name</label>
                            <input type="text" name="provider_name" id="" class="form-control"
                                value="{{ old('provider_name') }}">
                        </div>
                        <div class="form-group">
                            <label>phone</label>
                            <input type="text" name="phone" id="" class="form-control" value="{{ old('phone') }}">
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <textarea type="text" name="address" id=""
                                class="form-control">{{ old('address') }}</textarea>

                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea type="text" name="description" id=""
                                class="form-control">{{ old('description') }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Numero Registre Commerce </label>
                            <input type="text" name="rc" id="" class="form-control" value="{{ old('rc') }}">
                        </div>
                        <div class="form-group">
                            <label>Numero Article</label>
                            <input type="number" name="article" id="" class="form-control" value="{{ old('article') }}">
                        </div>
                        <div class="form-group">
                            <label>NIF</label>
                            <input type="number" name="nif" id="" class="form-control" value="{{ old('nif') }}">
                        </div>
                        <div class="form-group">
                            <label>NIS</label>
                            <input type="number" name="nis" id="" class="form-control" value="{{ old('nis') }}">
                        </div>
                    </div>
                </div>
                <div class="modal-footer form-group">
                    <button type="submit" class="btn btn-primary" href="{{ route('provider.store') }}"><i
                            class="nav-icon fas fa-truck"></i>
                        Add new provider</button>
                </div>
            </form>

        </div>
        <!-- /.card-body -->

    </div>
</div>


@stop
