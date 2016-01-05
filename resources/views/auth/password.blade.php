@extends('layouts.master')

@section('title','Change Password')
@section('content')
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">
                    Change Password
                </div>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" method="POST" action="/password/change">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />
                    <div class="form-group">
                        <label class="control-label col-sm-4">Old Password</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" name="old_password" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">New Password</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" name="new_password" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Retype New Password</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" name="new_password_confirmation" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-4">
                            <button class="btn btn-default" type="submit">Set Password</button>
                        </div>
                    </div>
                </form>
                @if ($errors->any())
                    <ul class="portal-form-errors">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</div>
@stop