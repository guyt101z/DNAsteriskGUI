@extends('layouts.master')
@section('title','Edit User');
@section('content')
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="panel-title">
					Edit User
				</div>
			</div>
			<div class="panel-body">
				{!! Form::open(['class' => 'form-horizontal']) !!}
					<input type="hidden" name="_token" value="{{csrf_token()}}" />
					<div class="form-group">
						<div class="col-sm-5 col-sm-offset-4">
							<h4 class="center">User Settings</h4>
							<hr>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4">Full Name</label>
						<div class="col-sm-5">
							{!! Form::text('fullname',$User->fullname,['class' => 'form-control'])!!}
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4">Email</label>
						<div class="col-sm-5">
							{!! Form::text('email',$User->email,['class' => 'form-control'])!!}
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4">Permission Level</label>
						<div class="col-sm-5">
							{!! Form::select('permlevel',['1' => 'Administrator','2' => 'End User'],$User->permlevel,['class' => 'form-control']) !!}
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
							{!! Form::text('vmpassword',$User->SIPPeer->VoicemailBox->password,['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4">Enable Voicemail to Email</label>
						<div class="col-sm-5">
							{!! Form::select('enable_email',['no' => 'No','yes' => 'Yes'],$User->SIPPeer->VoicemailBox->attach,['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-5 col-sm-offset-4">
							<h4 class="center">Follow Me Settings</h4>
							<hr>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4">Enable Follow Me</label>
						<div class="col-sm-5">
							{!! Form::select('enable_followme',['0' => 'No','1' => 'Yes'],$User->UserSettings->follow_enabled,['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4">Ring Time Before Follow</label>
						<div class="col-sm-5">
							{!! Form::text('follow_time_1',$User->UserSettings->follow_time_1,['class' => 'form-control'])!!}
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4">Follow</label>
						<div class="col-sm-5">
							{!! Form::text('follow_number',$User->UserSettings->follow_number,['class' => 'form-control'])!!}
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4">Ring Time For Follow</label>
						<div class="col-sm-5">
							{!! Form::text('follow_time_2',$User->UserSettings->follow_time_2,['class' => 'form-control'])!!}
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-5 col-sm-offset-4">
							<h4 class="center">Forward Settings</h4>
							<hr>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4">Enable Forwarding</label>
						<div class="col-sm-5">
							{!! Form::select('enable_forward',['0' => 'No','1' => 'Yes'],$User->UserSettings->forward_enabled,['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4">Forward To</label>
						<div class="col-sm-5">
							{!! Form::text('foroward_to',$User->UserSettings->forward_number,['class' => 'form-control'])!!}
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-5 col-sm-offset-4">
							<button class="btn btn-default" type="submit">Save User</button>
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
<script type="text/javascript" src="/assets/js/user/edit.js"></script>
@stop