@extends("app")

@section("content")
<div class="row">
    <div class="col-sm-12">
        <ul class="breadcrumb">
            <li><a href="{!! url('home') !!}"><i class="fa fa-home"></i> {!! trans('menu.home') !!}</a></li>
            <li class="active"><i class="fa fa-chart"></i> {!! trans_choice('menu.report', 2) !!}</li>
            <li class="active"><i class="fa fa-clock-o"></i> {!! trans('menu.aggregate-report') !!}</li>
            <li class="active"> {!! trans('menu.ungrouped-test') !!}</li>
        </ul>
    </div>
</div>
<div class="conter-wrapper">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
				    <i class="fa fa-book"></i> {!! trans('menu.ungrouped-test') !!} 
				    <span>
					    <a class="btn btn-sm btn-carrot" href="#" onclick="window.history.back();return false;" alt="{!! trans('messages.back') !!}" title="{!! trans('messages.back') !!}">
							<i class="fa fa-step-backward"></i>
							{!! trans('action.back') !!}
						</a>				
					</span>
				</div>
			  	<div class="card-block">	  		
					@if (Session::has('message'))
						<div class="alert alert-info">{!! Session::get('message') !!}</div>
					@endif
					@if($errors->all())
		            <div class="alert alert-danger alert-dismissible" role="alert">
		                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">{!! trans('action.close') !!}</span></button>
		                {!! HTML::ul($errors->all(), array('class'=>'list-unstyled')) !!}
		            </div>
		            @endif
			        {!! Form::open(array('route' => array('reports.aggregate.counts'), 'class' => 'form-inline', 'role' => 'form')) !!}
			            <div class='col-md-12'>
			            	<div class='col-md-4'>
			                    {!! Form::label('date_from', trans('general-terms.from').':', array('class' => 'col-sm-3 form-control-label')) !!}
			                    <div class='col-md-9 input-group date datepicker'>
			                        {!! Form::text('from', old('from') ? old('from') : $from, array('class' => 'form-control')) !!}
			                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
			                    </div>
			                </div>
			                <div class='col-md-4'>
			                    {!! Form::label('date_to', trans('general-terms.to').':', array('class' => 'col-sm-2 form-control-label')) !!}
			                    <div class='col-md-10 input-group date datepicker'>
			                        {!! Form::text('to', old('to') ? old('to') : $to, array('class' => 'form-control')) !!}
			                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
			                    </div>
			                </div>
			                <div class='col-md-4'>
								{!! Form::button("<i class='fa fa-filter'></i> ".trans('action.filter'), array('class' => 'btn btn-sm btn-primary', 'type' => 'submit', 'id' => 'filter')) !!}
								{!! Form::button("<i class='fa fa-file-word-o'></i> ".trans('action.export'), array('class' => 'btn btn-sm btn-midnight-blue', 'type' => 'submit', 'id' => 'word', 'value' => 'word', 'name' => 'word')) !!}
			                </div>
		                </div>
		                <div class='col-md-12' style="padding-bottom:5px;">
		                	<div id="radioBtn" class="btn-group">
	                            <a class="btn btn-sm btn-asbestos btn {{($counts==trans('menu.ungrouped-test'))?'active':'notActive'}}" data-toggle="counts" data-title="{!! trans('menu.ungrouped-test') !!}" name="counts">{!! trans('menu.ungrouped-test') !!}</a>
	                            <a class="btn btn-sm btn-asbestos btn {{($counts==trans('menu.grouped-test'))?'active':'notActive'}}" data-toggle="counts" data-title="{!! trans('menu.grouped-test') !!}" name="counts">{!! trans('menu.grouped-test') !!}</a>
	                            <a class="btn btn-sm btn-asbestos btn {{($counts==trans('menu.ungrouped-specimen'))?'active':'notActive'}}" data-toggle="counts" data-title="{!! trans('menu.ungrouped-specimen') !!}" name="counts">{!! trans('menu.ungrouped-specimen') !!}</a>
	                            <a class="btn btn-sm btn-asbestos btn {{($counts==trans('menu.grouped-specimen'))?'active':'notActive'}}" data-toggle="counts" data-title="{!! trans('menu.grouped-specimen') !!}" name="counts">{!! trans('menu.grouped-specimen') !!}</a>
	                        </div>
            				<input type="hidden" name="counts" id="counts">
		                </div>
			        {!! Form::close() !!}
		            <table class="table table-bordered table-sm" style="font-size:13px;">
						<thead>
							<tr>
								<th>{!! trans_choice('menu.test-type', 1) !!}</th>
								<th>{!! trans('menu.complete') !!}</th>
								<th>{!! trans('menu.pending') !!}</th>
							</tr>
						</thead>
						<tbody>
						@forelse($ungroupedTests as $key => $value)
							<tr>
								<td>{!! App\Models\TestType::find($key)->name !!}</td>
						    	<td>{!! $value['complete'] !!}</td>
						    	<td>{!! $value['pending'] !!}</td>
							</tr>
						@empty
						<tr><td colspan="3">{!! trans('general-terms.no-records') !!}</td></tr>
						@endforelse
						</tbody>
					</table>
			  	</div>
			</div>
		</div>
	</div>
	{!! session(['SOURCE_URL' => URL::full()]) !!}
</div>
@endsection