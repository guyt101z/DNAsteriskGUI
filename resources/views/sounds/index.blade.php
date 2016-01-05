@extends('layouts.master')
@section('title','Sound File Manager')
@section('content')
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<div class="panel panel-info">
			<div class="panel-heading">
				<div class="panel-title">
					Instructions
				</div>
			</div>
			<div class="panel-body">
				<p>
					To listen to or change a recording, please call {{ env('RECORDING_NUMBER') }} and enter the ID number of the sound file from the table below and follow the instructions on the menu.
				</p>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="panel-title">
					Sound Files
				</div>
			</div>
			<div class="panel-body">
			
				<div class="pull-right">
					<button class="btn btn-default" type="button" onClick="newFile();">New Sound File</button>
				</div>
			</div>
			<table class="portalTable" id="soundsTable">
				<thead>
					<tr>
						<th>ID #</th>
						<th>Name</th>
					</tr>
				</thead>
				<tbody>
					@foreach(Auth::user()->Customer->Sounds as $Sound)
					<tr>
						<td>{{$Sound->id}}</td>
						<td>{{$Sound->recording_name}}</td>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@stop
@section('bottom')
<script type="text/javascript" src="/assets/js/sounds/index.js"></script>
@stop