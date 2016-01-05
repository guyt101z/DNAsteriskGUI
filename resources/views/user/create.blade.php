@extends('layouts.master')
@section('title','New User')
@section('content')
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="panel-title">
					Create User
				</div>
			</div>
			<div class="panel-body">
				{!! Form::open(['class' => 'form-horizontal']) !!}
					<input type="hidden" name="_token" value="{{csrf_token()}}" />
					<div class="form-group">
						<label class="control-label col-sm-4">Full Name</label>
						<div class="col-sm-5">
							{!! Form::text('fullname',null,['class' => 'form-control'])!!}
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4">Username</label>
						<div class="col-sm-5">
							{!! Form::text('username',null,['class' => 'form-control'])!!}
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4">Email</label>
						<div class="col-sm-5">
							{!! Form::text('email',null,['class' => 'form-control'])!!}
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4">Password</label>
						<div class="col-sm-5">
							{!! Form::password('password',['class' => 'form-control'])!!}
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4">Retype Password</label>
						<div class="col-sm-5">
							{!! Form::password('password_confirmation',['class' => 'form-control'])!!}
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4">Permission Level</label>
						<div class="col-sm-5">
							{!! Form::select('permlevel',['1' => 'Administrator','2' => 'End User'],null,['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4">Enable Voicemail</label>
						<div class="col-sm-5">
							{!! Form::select('enable_voicemail',['0' => 'No','1' => 'Yes'],'1',['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4">Voicemail Password</label>
						<div class="col-sm-5">
							{!! Form::text('vmpassword',null,['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4">Enable Voicemail to Email</label>
						<div class="col-sm-5">
							{!! Form::select('enable_email',['no' => 'No','yes' => 'Yes'],null,['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-5 col-sm-offset-4">
							<button class="btn btn-default" type="submit">Create User</button>
						</div>
					</div>
				{!! Form::close() !!}
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

@section('bottom')
<script type="text/javascript" src="/assets/js/user/create.js"></script>