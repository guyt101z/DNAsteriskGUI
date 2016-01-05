@extends('layouts.master')
@section('title','New Sound File')
@section('content')
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="panel-title">
					Edit Sound File
				</div>
			</div>
			<div class="panel-body">
				{!! Form::open(['class' => 'form-horizontal']) !!}
					<input type="hidden" name="_token" value="{{csrf_token()}}" />
					<div class="form-group">
						<label class="control-label col-sm-4">File Name</label>
						<div class="col-sm-5">
							{!! Form::text('filename',$Sound->recording_name,['class' => 'form-control'])!!}
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-5 col-sm-offset-4">
							{!! Form::input('checkbox','delete')!!}
							<label class="control-label">Delete File</label>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-5 col-sm-offset-4">
							<button class="btn btn-default" type="submit">Update Sound File</button>
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
<script type="text/javascript" src="/assets/js/user/create.js"></script>