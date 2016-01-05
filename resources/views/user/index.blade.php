@extends('layouts.master')
@section('title','Manage Users')
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="panel-title">
					User Accounts
				</div>
			</div>
			<div class="panel-body">
			
				<div class="pull-right">
					<button class="btn btn-default" type="button" onClick="newUser();">New User</button>
				</div>
			</div>
			<table class="portalTable" id="userTable">
				<thead>
					<tr>
						<th>id</th>
						<th>Name</th>
						<th>Username</th>
						<th>SIP Login</th>
						<th>SIP Secret</th>
						<th>BLF/Hint</th>
						<th>Mailbox</th>
					</tr>
				</thead>
				<tbody>
					@foreach(Auth::user()->Customer->Users as $User)
					<tr>
						<td>{{$User->id}}</td>
						<td>{{$User->fullname}}</td>
						<td>{{$User->username}}</td>
						<td>{{$User->SIPPeer->name}}</td>
						<td>{{$User->SIPPeer->secret}}</td>
						<td>{{$User->SIPPeer->getHint()}}</td>
						<td>{{$User->SIPPeer->VoicemailBox->mailbox}}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@stop
@section('bottom')
<script type="text/javascript" src="/assets/js/user/index.js"></script>
@stop