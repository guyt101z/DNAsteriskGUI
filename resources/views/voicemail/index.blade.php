@extends('layouts.master')
@section('title','Manage Voicemail Boxes');
@section('content')
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="panel-title">
					Voicemail Boxes
				</div>
			</div>
			<div class="panel-body">
			
				<div class="pull-right">
					<button class="btn btn-default" type="button" onClick="newVMBox();">New Mailbox</button>
				</div>
			</div>
			<table class="portalTable" id="vmTable">
				<thead>
					<tr>
						<th>id</th>
						<th>Mailbox</th>
					</tr>
				</thead>
				<tbody>
					@foreach(Auth::user()->Customer->VoicemailBoxes as $Mailbox)
					<tr>
						<td>{{$Mailbox->uniqueid}}</td>
						<td>{{$Mailbox->mailbox}} : {{$Mailbox->related_user}}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@stop
@section('bottom')
<script type="text/javascript" src="/assets/js/voicemail/index.js"></script>
@stop