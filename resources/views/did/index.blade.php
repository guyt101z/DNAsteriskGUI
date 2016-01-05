@extends('layouts.master')
@section('title','DID Manager')
@section('content')
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="panel-title">
						Inbound Numbers
					</div>
				</div>
				<table class="portalTable" id="didTable">
				<thead>
					<tr>
						<th>id</th>
						<th>DID</th>
						<th>Destination</th>
					</tr>
				</thead>
				<tbody>
					@foreach(Auth::user()->Customer->DIDs as $DID)
					<tr>
						<td>{{$DID->id}}</td>
						<td>{{$DID->did_did}}</td>
						<td>{{$DID->formatted_desttype}}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			</div>
		</div>
	</div>
@stop
@section('bottom')
<script type="text/javascript" src="/assets/js/did/index.js"></script>
@stop