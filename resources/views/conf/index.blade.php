@extends('layouts.master')
@section('title','Conference Bridges')
@section('content')
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="panel-title">
					Conference Bridges
				</div>
			</div>
			<div class="panel-body">
			
				<div class="pull-right">
					<button class="btn btn-default" type="button" onClick="newConf();">New Conference Bridge</button>
				</div>
			</div>
			<table class="portalTable" id="confTable">
				<thead>
					<tr>
						<th>id</th>
						<th>Name</th>
						<th>Authentication</th>
					</tr>
				</thead>
				<tbody>
					@foreach(Auth::user()->Customer->ConferenceBridges as $Conf)
					<tr>
						<td>{{$Conf->id}}</td>
						<td>{{$Conf->conf_name}}</td>
						<td>{{$Conf->getAuth()}}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@stop
@section('bottom')
<script type="text/javascript" src="/assets/js/conf/index.js"></script>
@stop