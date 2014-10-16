@extends("layout")
@section("content")
<div>
	<ol class="breadcrumb">
	  <li><a href="{{{URL::route('user.home')}}}">{{ trans('messages.home') }}</a></li>
	  <li class="active">{{ trans('messages.reports') }}</li>
	  <li class="active">{{ trans('messages.prevalence-rates-report') }}</li>
	</ol>
</div>
@if (Session::has('message'))
	<div class="alert alert-info">{{ trans(Session::get('message')) }}</div>
@endif
<div class="panel panel-primary">
	<div class="panel-heading ">
		<span class="glyphicon glyphicon-user"></span>
		{{ trans('messages.prevalence-rates-report') }}
	</div>
	<div class="panel-body">
	<!-- if there are search errors, they will show here -->
	@if($errors->all())
		<div class="alert alert-danger">
			{{ HTML::ul($errors->all()) }}
		</div>
	@endif
	<div class="table-responsive">
		{{ Form::open(array('url' => 'prevalence/filter', 'id' => 'prevalence_rates', 'method' => 'post')) }}
		  <table class="table">
		    <thead>
		    <tr>
		        <td>{{ Form::label('name', trans("messages.from")) }}</td>
		        <td>{{ Form::text('from', Input::old('from'), array('class' => 'form-control', 'id' => 'from', 'data-format' => 'YYYY-MM-DD')) }}</td>
		        <td>{{ Form::label('name', trans("messages.to")) }}</td>
		        <td>{{ Form::text('to', Input::old('to'), array('class' => 'form-control', 'id' => 'to', 'data-format' => 'YYYY-MM-DD')) }}</td>
		        <td>{{ Form::button("<span class='glyphicon glyphicon-eye-open'></span> ".trans('messages.toggle-graph'), 
					        array('class' => 'btn btn-info', 'id' => 'toggle')) }}</td>
		        <td>{{ Form::button("<span class='glyphicon glyphicon-filter'></span> ".trans('messages.view'), 
					        array('class' => 'btn btn-primary', 'style' => 'width:125px', 'id' => 'filter', 'type' => 'submit')) }}</td>
		  		<td>{{ Form::button("<span class='glyphicon glyphicon-remove'></span> ".trans('messages.close'), 
					        array('class' => 'btn btn-warning', 'style' => 'width:125px', 'id' => 'close')) }}</td>
		    </tr>
		</thead>
		<tbody>
			
		</tbody>
		  </table>
	  {{ Form::close() }}
		  <div id="chartContainer"></div>
		  <div id="grid">
		  	<div class="table-responsive">
			  <table class="table table-striped">
			    <tbody id="tableBody">
				    <tr>
				    	<th>{{trans('messages.test-type')}}</th>
				    	<th>{{trans('messages.total-specimen')}}</th>
				    	<th>{{trans('messages.positive')}}</th>
				    	<th>{{trans('messages.negative')}}</th>
				    	<th>{{trans('messages.prevalence-rate')}}</th>
				    </tr>
				    @forelse($data as $datum)
				    <tr>
				    	<td>{{$datum->test}}</td>
		  				<td>{{$datum->total}}</td>
		  				<td>{{$datum->positive}}</td>
		  				<td>{{$datum->negative}}</td>
		  				<td>{{$datum->rate}}</td>
				    </tr>
				    @empty
				    <tr>
				    	<td colspan="5">{{trans('messages.no-records-found')}}</td>
				    </tr>
				    @endforelse
			    </tbody>
			  </table>
			</div>
		  </div>
		</div>
		</div>
	</div>

</div>

<!-- Begin FusionCharts scripts -->
{{ HTML::script('fusioncharts/js/fusioncharts.js') }}
{{ HTML::script('fusioncharts/js/themes/fusioncharts.theme.ocean.js') }}
<!-- End fusioncharts scripts -->
<script type="text/javascript">
	$(document).ready(function(){
		reports();
	});

	FusionCharts.ready(function(){
	  var prevalenceChart = '';
	  prevalenceChart.render("chartContainer");
	}); 

   $('#toggle').click(function(){
   		$('#chartContainer').toggle('show');
   });
</script>
@stop