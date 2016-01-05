@extends('layouts.master')
@section('title','New Sound File')
@section('content')
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="panel-title">
					Create Conference Bridge
				</div>
			</div>
			<div class="panel-body">
				{!! Form::open(['class' => 'form-horizontal']) !!}
					<div class="form-group">
						<label class="control-label col-sm-4">Conference Name</label>
						<div class="col-sm-5">
							{!! Form::text('conf_name',null,['class' => 'form-control'])!!}
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4">Authentication PIN (optional 3-6 digits)</label>
						<div class="col-sm-5">
							{!! Form::text('conf_auth',null,['class' => 'form-control','placeholder' => 'Leave blank for no authentication'])!!}
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4">Assign Extension (optional)</label>
						<div class="col-sm-5">
							{!! Form::text('conf_extension',null,['class' => 'form-control'])!!}
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-5 col-sm-offset-4">
							<button class="btn btn-default" type="submit">Create Conference Bridge</button>
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