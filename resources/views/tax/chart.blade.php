@extends('layouts.app')

@section('title', '统计分析')

@section('content')
<!-- Chart -->
<form method="get" action="{{ route('tax.chart') }}" class="form-horizontal form-label-left">
	<input type="hidden" name="flag" value="true">

	<div class="form-group">
		<label for="project" class="control-label col-md-3 col-sm-3 col-xs-12">项目名称 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<select id="project" name="project" class="form-control col-md-7 col-xs-12">
				@foreach ($projects as $project)
					<option value="{{ $project->name }}">{{ $project->name }}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="type" class="control-label col-md-3 col-sm-3 col-xs-12">标段类型 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<select id="type" name="type" class="form-control col-md-7 col-xs-12">
				<option value="全部">== 全部 ==</option>
				@foreach ($types as $type)
					<option value="{{ $type->name }}">{{ $type->name }}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="section" class="control-label col-md-3 col-sm-3 col-xs-12">标段名称 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<select id="section" name="section" class="form-control col-md-7 col-xs-12">
				<option value="全部" data-chained="全部 {{ $types->implode('name', ' ') }}">== 全部 ==</option>
				@foreach ($sections as $section)
					<option value="{{ $section->name }}" data-chained="{{ $section->type->name }}">{{ $section->name }}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="tax_name" class="control-label col-md-3 col-sm-3 col-xs-12">税目 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<select id="tax_name" name="tax_name" class="form-control col-md-7 col-xs-12">
				<option value="全部">== 全部 ==</option>
				@foreach ($rates as $rate)
					<option value="{{ $rate->name }}">{{ $rate->name }}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="ln_solid"></div>
	<div class="form-group">
		<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
			<button type="submit" class="btn btn-success">查询</button>
		</div>
	</div>
</form>

@if ($searched)
<div class="clearfix"></div>
<div class="row">

	<!-- Pie chart -->
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>饼图</h2>

                <div class="clearfix"></div>
            </div>

            <div class="x_content">
				<canvas id="pie-chart"></canvas>
            </div>
        </div>
    </div>
	<!-- /Pie chart -->

	<!-- Bar chart -->
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>柱状图</h2>

                <div class="clearfix"></div>
            </div>

            <div class="x_content">
				<canvas id="bar-chart"></canvas>
            </div>
        </div>
    </div>
	<!-- /Bar chart -->
</div>
@endif
<!-- /Chart -->
@stop

@push('scripts')
	<script src="{{ asset('js/jquery.chained.js') }}"></script>
	<script>
		// jQuery Chained
		$('#section').chained('#type');
	</script>
	@if ($searched)
	<script src="{{ asset('js/Chart.min.js') }}"></script>

	<script>
	// Bar chart
	if ($('#bar-chart').length) {
		var ctx = document.getElementById("bar-chart");
		var mybarChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: [
					'应纳资源税',
					'应补资源税',
					'可抵资源税',
					'自行申报资源税'
				],
				datasets: [{
					label: '资源税',
					data: [
						{{ $payable }},
						{{ $payable - $paid - $declaration }},
						{{ $paid }},
						{{ $declaration }}
					],
					backgroundColor: [
						'#3498DB',
						'#455C73',
						'#26B99A',
						'#9B59B6'
					]
				}]
			},

			options: {
				scales: {
					yAxes: [{
						 ticks: {
						 	beginAtZero: true
						 }
					}]
				}
			}
		});
	}

	// Pie chart
	if ($('#pie-chart').length ){
		var ctx = document.getElementById("pie-chart");
		var data = {
			labels: [
				'应补资源税',
				'可抵资源税',
				'自行申报资源税'
			],
			datasets: [{
				data: [
					{{ $payable - $paid - $declaration }},
					{{ $paid }},
					{{ $declaration }}
				],
				backgroundColor: [
					'#455C73',
					'#26B99A',
					'#9B59B6'
				]
			}]
		};

		var pieChart = new Chart(ctx, {
			data: data,
			type: 'pie',
			otpions: {
				legend: false
			}
		});
	}
	</script>
	@endif
@endpush