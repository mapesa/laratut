@extends("layout")
@section("content")
<div>
	<ol class="breadcrumb">
	  <li><a href="{{{URL::route('user.home')}}}">{{trans('messages.home')}}</a></li>
	  <li><a href="{{ URL::route('instrument.index') }}">{{Lang::choice('messages.instrument',1)}}</a></li>
	  <li class="active">{{trans('messages.edit-instrument')}}</li>
	</ol>
</div>
<div class="panel panel-primary">
	<div class="panel-heading ">
		<span class="glyphicon glyphicon-edit"></span>
		{{trans('messages.edit-instrument')}}
	</div>
	{{ Form::model($instrument, array(
			'route' => array('instrument.update', $instrument->id), 'method' => 'PUT',
			'id' => 'form-edit-instrument'
		)) }}
		<div class="panel-body">
			@if($errors->all())
				<div class="alert alert-danger">
					{{ HTML::ul($errors->all()) }}
				</div>
			@endif

			<div class="form-group">
				{{ Form::label('name', Lang::choice('messages.name',1)) }}
				{{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
			</div>
			<div class="form-group">
				{{ Form::label('description', trans('messages.description')) }}
				{{ Form::textarea('description', Input::old('description'), 
					array('class' => 'form-control', 'rows' => '2' )) }}
			</div>
			<div class="form-group">
				{{ Form::label('ip', trans('messages.ip')) }}
				{{ Form::text('ip', Input::old('ip'), array('class' => 'form-control')) }}
			</div>
			<div class="form-group">
				{{ Form::label('hostname', trans('messages.host-name')) }}
				{{ Form::text('hostname', Input::old('hostname'), array('class' => 'form-control')) }}
			</div>
			<div class="form-group">
				{{ Form::label('interfacing_class', trans('messages.interfacing-class')) }}
				{{ Form::text('interfacing_class', Input::old('interfacing_class'), array('class' => 'form-control')) }}
			</div>
			<div class="form-group">
				{{ Form::label('test_types', trans('messages.select-test-types')) }}
				<div class="form-pane panel panel-default">
					<div class="container-fluid">
						<?php 
							$cnt = 0;
							$zebra = "";
						?>
					@foreach($testtypes as $key=>$value)
						{{ ($cnt%4==0)?"<div class='row $zebra'>":"" }}
						<?php
							$cnt++;
							$zebra = (((int)$cnt/4)%2==1?"row-striped":"");
						?>
						<div class="col-md-3">
							<label  class="checkbox">
								<input type="checkbox" name="testtypes[]" value="{{ $value->id}}" 
									{{ in_array($value->id, $instrument->testTypes->lists('id'))?"checked":"" }} />
									{{$value->name }}
							</label>
						</div>
						{{ ($cnt%4==0)?"</div>":"" }}
					@endforeach
					</div>
				</div>
			</div>
		</div>
		<div class="panel-footer">
			<div class="form-group actions-row">
				{{ Form::button('<span class="glyphicon glyphicon-save"></span> '.trans('messages.save'), 
					['class' => 'btn btn-primary', 'onclick' => 'submit()']
				) }}
				{{ Form::button(trans('messages.cancel'), 
					['class' => 'btn btn-default', 'onclick' => 'javascript:history.go(-1)']
				) }}
			</div>
		</div>
	{{ Form::close() }}
</div>
@stop