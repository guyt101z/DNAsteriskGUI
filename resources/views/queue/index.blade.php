@extends('layouts.master')
@section('title','Manage Queues');
@section('content')
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="panel-title">
					Queues
				</div>
			</div>
			<div class="panel-body">
			
				<div class="pull-right">
					<button class="btn btn-default" type="button" onClick="newQueue();">New Queue</button>
				</div>
			</div>
			<table class="portalTable" id="queueTable">
				<thead>
					<tr>
						<th>id</th>
						<th>Name</th>
					</tr>
				</thead>
				<tbody>
					@foreach(Auth::user()->Customer->Queues as $Queue)
					<tr>
						<td>{{$Queue->id}}</td>
						<td>{{$Queue->q_name}}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@stop
@section('bottom')
<script type="text/javascript" src="/assets/js/queue/index.js"></script>
@stop