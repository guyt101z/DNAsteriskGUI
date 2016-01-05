@extends('layouts.master')
@section('title','DID Manager')
@section('content')
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="panel-title">
						{{$DID->display_formatted}}
					</div>
				</div>
				<div class="panel-body">
					
				</div>
			</div>
		</div>
	</div>
@stop