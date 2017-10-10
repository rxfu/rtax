@extends('layouts.app')

@section('title', '统计分析')

@section('content')
<form method="get" action="{{ route('tax.result') }}" class="form-horizontal form-label-left">
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
			<button type="submit" class="btn btn-success">统计分析</button>
		</div>
	</div>
</form>

@if ($searched)
<p>统计条件：{!! $condition !!}</p>
<!-- Results -->
<table id="result-table" class="table table-striped table-bordered">
	<thead>
		<tr>
			<th><i>#</i></th>
			<th>标段名称</th>
			<th>税目</th>
			<th>应纳资源税</th>
			<th>可抵资源税</th>
			<th>自行申报税</th>
			<th>应补资源税</th>
		</tr>
	</thead>

	<tbody>
		@foreach ($results as $result)
		<tr data-type="{{ $result->section->type->name }}">
			<td><i>{{ $loop->index + 1 }}</i></td>
			<td>{{ $result->section->name }}</td>
			<td>{{ $result->tax_name }}</td>
			<td>{{ $payable = $result->total_tax }}</td>
			<td>{{ $paid = App\Paid::whereSectionId($result->section_id)->whereTaxName($result->tax_name)->sum('total') }}</td>
			<td>{{ $declaration = App\Declaration::whereSectionId($result->section_id)->whereTaxName($result->tax_name)->sum('total') }}</td>
			<td>{{ $payable - $paid - $declaration }}</td>
		</tr>
		@endforeach
	</tbody>
</table>
<!-- /Results -->
<div class="clearfix"></div>

<div class="row">
	<div class="col-md-4 col-sm-4 col-xs-12 col-md-offset-4">
		<form id="chartForm" method="get" class="form-inline">
			<div class="radio-inline">
				<label for="type">
					<input type="radio" id="type" name="options" value="type" checked> 标段类型
				</label>
			</div>
			<div class="radio-inline">
				<label for="section">
					<input type="radio" id="section" name="options" value="section"> 标段名称
				</label>
			</div>
			<div class="radio-inline">
				<label for="tax_name">
					<input type="radio" id="tax_name" name="options" value="tax_name"> 税目
				</label>
			</div>
			<button type="submit" class="btn btn-info">生成图表</button>
		</form>
	</div>
</div>
@endif

<div id="chart" class="row" style="display: none;">

	<!-- Pie and bar chart -->
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>图表分析</h2>

                <div class="clearfix"></div>
            </div>

            <div class="x_content">
				<div id="pie-chart"></div>
				<br>
				<div id="bar-chart"></div>
            </div>
        </div>
    </div>
	<!-- /Pie and bar hart -->

	<!-- Table -->
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>表格分析</h2>

                <div class="clearfix"></div>
            </div>

            <div class="x_content">
				<table id="chart-result" class="table table-striped">
					<!--
					<thead>
						<tr>
							<th><i>#</i></th>
							<th></th>
							<th>税款金额</th>
						</tr>
					</thead>

					<tbody>
					</tbody>
				-->
				</table>
            </div>
        </div>
    </div>
	<!-- /Table -->
</div>
@stop

@push('scripts')
	<script src="{{ asset('js/jquery.chained.js') }}"></script>
	<script src="{{ asset('js/highcharts.js') }}"></script>
	<script>
		// jQuery Chained
		$('#section').chained('#type');

		// Generate charts
		$('#chartForm').submit(function(e) {
			e.preventDefault();

			$('#chart').show();

			var option = $('input:radio[name="options"]:checked').val();

			// Pie chart
			var chart = {
		        plotBackgroundColor: null,
		        plotBorderWidth: null,
		        plotShadow: false,
		        type: 'pie'
		    };

		    var title = {
		        text: '标段类型饼图'
		    };

		    var tooltip = {
		        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
		    };

		    var plotOptions = {
		        pie: {
		            allowPointSelect: true,
		            cursor: 'pointer',
		            dataLabels: {
		                enabled: false,
		                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
		                style: {
		                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
		                }
		            },
		            showInLegend: true
		        }
		    };

		    if ('type' == option) {
		    	var props = ['type'];
		    	var objs = new Array();

		    	$('#result-table tbody tr').each(function() {
		    		var obj = new Object();
		    		var money = $(this).find('td').eq(3).text()

		    		obj[$(this).attr('data-type')] += Number(money);
		    	});
		    }

		    var series = [{
		        name: '标段类型',
		        colorByPoint: true,
		        data: data
		    }];

		    Highcharts.chart('pie-chart', {
		    	chart: chart,
		    	title: title,
		    	tooltip: tooltip,
		    	plotOptions: plotOptions,
		    	series: series
		    });
		});
	</script>
	<!--
	@if ($searched)
	<script src="{{ asset('js/highcharts.js') }}"></script>

	<script>
	// Pie chart
	Highcharts.chart('pie-chart', {
	    chart: {
	        plotBackgroundColor: null,
	        plotBorderWidth: null,
	        plotShadow: false,
	        type: 'pie'
	    },
	    title: {
	        text: '{{ $chtname }}饼图'
	    },
	    tooltip: {
	        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
	    },
	    plotOptions: {
	        pie: {
	            allowPointSelect: true,
	            cursor: 'pointer',
	            dataLabels: {
	                enabled: false,
	                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
	                style: {
	                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
	                }
	            },
	            showInLegend: true
	        }
	    },
	    series: [{
	        name: '{{ $chtname }}数据分析',
	        colorByPoint: true,
	        data: {!! $data !!}
	    }]
	});

	// Bar chart
	Highcharts.chart('bar-chart', {
	    chart: {
	        type: 'column'
	    },
	    title: {
	        text: '{{ $chtname }}柱状图'
	    },
	    xAxis: {
	        type: 'category'
	    },
	    yAxis: {
	        min: 0,
	        title: {
	            text: '税款金额'
	        }
	    },
	    tooltip: {
	        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
	        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b><br/>'
	    },
	    plotOptions: {
	        series: {
	            borderWidth: 0,
	            dataLabels: {
	                enabled: true,
	                format: '{point.y:.2f}'
	            }
	        }
	    },
	    series: [{
	    	name: '{{ $chtname }}数据分析',
	    	colorByPoint: true,
	    	data: {!! $data !!}
	    }]
	});
	</script>
	@endif
	 -->
@endpush