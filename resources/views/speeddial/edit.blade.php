@extends('layouts.master')
@section('title','New Speed Dial')
@section('content')
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="panel-title">
					Edit Speed Dial
				</div>
			</div>
			<div class="panel-body">
				{!! Form::open(['class' => 'form-horizontal']) !!}
					<div class="form-group">
						<label class="control-label col-sm-4">Speed Dial</label>
						<div class="col-sm-5">
							{!! Form::text('sd_extension',$SpeedDial->sd_exten,['class' => 'form-control'])!!}
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4">Destination</label>
						<div class="col-sm-5">
							{!! Form::select('destination_type',['forward' => 'Forward','extension' => 'Dial Extension','ivr' => 'Auto Attendant','ringgroup' => 'Ring Group','schedule' => 'Scheduler','confbridge' => 'Conference Bridge','voicemail' => 'Voicemail','queue' => 'Call Queue','busy' => 'Busy','hangup' => 'Hangup',],$SpeedDial->sd_dest_type,['class' => 'form-control','id' => 'destination_type']) !!}
						</div>
					</div>
					<div class="form-group" id="forward">
						<label class="control-label col-sm-4">Forward To</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="forward" />
						</div>
					</div>
					<div class="form-group" id="extension">
						<label class="control-label col-sm-4">Extension</label>
						<div class="col-sm-5">
							{!! Form::select('extension',[],null,['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="form-group" id="ivr">
						<label class="control-label col-sm-4">Auto Attendant</label>
						<div class="col-sm-5">
							{!! Form::select('ivr',[],null,['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="form-group" id="ringgroup">
						<label class="control-label col-sm-4">Ring Group</label>
						<div class="col-sm-5">
							{!! Form::select('ringgroup',[],null,['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="form-group" id="schedule">
						<label class="control-label col-sm-4">Schedule</label>
						<div class="col-sm-5">
							{!! Form::select('schedule',[],null,['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="form-group" id="confbridge">
						<label class="control-label col-sm-4">Conference Bridge</label>
						<div class="col-sm-5">
							{!! Form::select('confbridge',[],null,['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="form-group" id="voicemail">
						<label class="control-label col-sm-4">Voicemail</label>
						<div class="col-sm-5">
							{!! Form::select('voicemail',[],null,['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="form-group" id="queue">
						<label class="control-label col-sm-4">Queue</label>
						<div class="col-sm-5">
							{!! Form::select('queue',[],null,['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-5 col-sm-offset-4">
							{!! Form::input('checkbox','delete')!!}
							<label class="control-label">Delete Queue</label>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-5 col-sm-offset-4">
							<button class="btn btn-default" type="submit">Update Speed Dial</button>
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
<script type="text/javascript" src="/assets/js/speeddial/create.js"></script>
@stop