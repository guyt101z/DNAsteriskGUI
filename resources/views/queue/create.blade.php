@extends('layouts.master')
@section('title','New Queue')
@section('content')
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="panel-title">
					Create Queue
				</div>
			</div>
			<div class="panel-body">
				{!! Form::open(['class' => 'form-horizontal']) !!}
					<div class="form-group">
						<label class="control-label col-sm-4">Queue Name</label>
						<div class="col-sm-5">
							{!! Form::text('queue_name',null,['class' => 'form-control'])!!}
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4">Ring Strategy</label>
						<div class="col-sm-5">
							{!! Form::select('queue_strategy',['ringall' => 'Ring All','leastrecent' => 'Least Recent','fewestcalls' => 'Fewest Calls','random' => 'Random','rrmemory' => 'Round Robin'],NULL,['class' => 'form-control'])!!}
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4">Timeout</label>
						<div class="col-sm-5">
							{!! Form::text('queue_timeout',30,['class' => 'form-control'])!!}
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4">Retry</label>
						<div class="col-sm-5">
							{!! Form::text('queue_retry',5,['class' => 'form-control'])!!}
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4">Members</label>
						<div class="col-sm-5">
							{!! Form::select('queue_members[]',Auth::user()->Customer->Users->lists('fullname','id'),NULL,['class' => 'form-control','multiple' => 'multiple','size' => '10','id' => 'members'])!!}
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-5 col-sm-offset-4">
							<button class="btn btn-default" type="submit">Create Queue</button>
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
<script type="text/javascript" src="/assets/js/queue/create.js"></script>