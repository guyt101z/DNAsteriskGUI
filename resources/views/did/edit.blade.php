@extends('layouts.master')
@section('title','Edit Inbound Number')
@section('content')
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="panel-title">
					Edit Inbound Destination for {{$DID->display_formatted}}
				</div>
			</div>
			<div class="panel-body">
				{!! Form::open(['class' => 'form-horizontal']) !!}
					<input type="hidden" name="_token" value="{{csrf_token()}}" />
					<div class="form-group">
						<label class="control-label col-sm-3">Destination Type</label>
						<div class="col-sm-5">
							{!! Form::select('destination_type',['forward' => 'Forward','extension' => 'Dial Extension','ivr' => 'Auto Attendant','ringgroup' => 'Ring Group','schedule' => 'Scheduler','confbridge' => 'Conference Bridge','voicemail' => 'Voicemail','queue' => 'Call Queue','busy' => 'Busy','hangup' => 'Hangup',],$DID->dest_type,['class' => 'form-control','id' => 'destination_type']) !!}
						</div>
					</div>
					<div class="form-group" id="forward">
						<label class="control-label col-sm-3">Forward To</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="forward" />
						</div>
					</div>
					<div class="form-group" id="extension">
						<label class="control-label col-sm-3">Extension</label>
						<div class="col-sm-5">
							{!! Form::select('extension',[],null,['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="form-group" id="ivr">
						<label class="control-label col-sm-3">Auto Attendant</label>
						<div class="col-sm-5">
							{!! Form::select('ivr',[],null,['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="form-group" id="ringgroup">
						<label class="control-label col-sm-3">Ring Group</label>
						<div class="col-sm-5">
							{!! Form::select('ringgroup',[],null,['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="form-group" id="schedule">
						<label class="control-label col-sm-3">Schedule</label>
						<div class="col-sm-5">
							{!! Form::select('schedule',[],null,['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="form-group" id="confbridge">
						<label class="control-label col-sm-3">Conference Bridge</label>
						<div class="col-sm-5">
							{!! Form::select('confbridge',[],null,['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="form-group" id="voicemail">
						<label class="control-label col-sm-3">Voicemail</label>
						<div class="col-sm-5">
							{!! Form::select('voicemail',[],null,['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="form-group" id="queue">
						<label class="control-label col-sm-3">Queue</label>
						<div class="col-sm-5">
							{!! Form::select('queue',[],null,['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-3 col-sm-offset-3">
							<button class="btn btn-default" type="submit">Save</button>
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
<script type="text/javascript" src="/assets/js/did/edit.js"></script>
@stop