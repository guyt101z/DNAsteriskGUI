@extends('layouts.master')
@section('title','Ring Groups')
@section('content')
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="panel-title">
					Ring Groups
				</div>
			</div>
			<div class="panel-body">
			
				<div class="pull-right">
					<button class="btn btn-default" type="button" onClick="newRG();">New Ring Group</button>
				</div>
			</div>
			<table class="portalTable" id="rgTable">
				<thead>
					<tr>
						<th>id</th>
						<th>Name</th>
						<th>Type</th>
					</tr>
				</thead>
				<tbody>
					@foreach(Auth::user()->Customer->RingGroups as $RingGroup)
					<tr>
						<td>{{$RingGroup->id}}</td>
						<td>{{$RingGroup->rg_name}}</td>
						<td>{{$RingGroup->getType()}}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@stop
@section('bottom')
<script type="text/javascript" src="/assets/js/ringgroups/index.js"></script>
@stop