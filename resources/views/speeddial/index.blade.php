@extends('layouts.master')
@section('title','Manage Queues');
@section('content')
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="panel-title">
					Speed Dials
				</div>
			</div>
			<div class="panel-body">
			
				<div class="pull-right">
					<button class="btn btn-default" type="button" onClick="newSpeedDial();">New Speed Dial</button>
				</div>
			</div>
			<table class="portalTable" id="speedDialTable">
				<thead>
					<tr>
						<th>id</th>
						<th>Extension</th>
						<th>Destination</th>
					</tr>
				</thead>
				<tbody>
					@foreach(Auth::user()->Customer->SpeedDials as $SpeedDial)
					<tr>
						<td>{{$SpeedDial->id}}</td>
						<td>{{$SpeedDial->sd_exten}}</td>
						<td></td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@stop
@section('bottom')
<script type="text/javascript" src="/assets/js/speeddial/index.js"></script>
@stop