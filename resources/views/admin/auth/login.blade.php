@extends('layouts.admin')

@section('title', __('admin.auth.meta_title'))

@section('content')
    <div id="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <br/>
                    <br/>
                    <br/>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            {!! BootForm::vertical(['url' => route('admin.login')]) !!}
                            {!! BootForm::email('email', __('admin.auth.email')) !!}
                            {!! BootForm::password('password', __('admin.auth.password')) !!}
                            {!! BootForm::submit(__('admin.auth.login')) !!}
                            {!! BootForm::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection