@extends('layouts.block')

@section('title', '成果查询')

@section('content')
<!-- Result table -->
<div class="row">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>查询结果</h2>

                <div class="clearfix"></div>
            </div>

            <div class="x_content">
				<form method="get" action="{{ route('tax.search') }}" class="form-horizontal form-label-left">
					<input type="hidden" name="flag" value="true">

					<div class="form-group">
						<label for="project_name" class="control-label col-md-3 col-sm-3 col-xs-12">项目名称</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" class="form-control col-md-7 col-xs-12" id="project_name" name="project_name" placeholder="项目名称" value="{{ old('project_name') }}">
						</div>
					</div>
					<div class="form-group">
						<label for="lot_name" class="control-label col-md-3 col-sm-3 col-xs-12">标段名称</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" class="form-control col-md-7 col-xs-12" id="lot_name" name="lot_name" placeholder="标段名称" value="{{ old('lot_name') }}">
						</div>
					</div>
					<div class="form-group">
						<label for="lot_type" class="control-label col-md-3 col-sm-3 col-xs-12">标段类型</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" class="form-control col-md-7 col-xs-12" id="lot_type" name="lot_type" placeholder="标段类型" value="{{ old('lot_type') }}">
						</div>
					</div>
					<div class="form-group">
						<label for="specification_name" class="control-label col-md-3 col-sm-3 col-xs-12">规格名称</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" class="form-control col-md-7 col-xs-12" id="specification_name" name="specification_name" placeholder="规格名称" value="{{ old('specification_name') }}">
						</div>
					</div>
					<div class="form-group">
						<label for="tax_name" class="control-label col-md-3 col-sm-3 col-xs-12">税目</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" class="form-control col-md-7 col-xs-12" id="tax_name" name="tax_name" placeholder="税目" value="{{ old('tax_name') }}">
						</div>
					</div>
					<div class="form-group">
						<label for="flag" class="control-label col-md-3 col-sm-3 col-xs-12">资源税改革标记</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<select id="flag" name="flag" class="form-control col-md-7 col-xs-12">
								<option value="all" selected>全部</option>
								<option value="前">前</option>
								<option value="后">后</option>
								<option value="跨">跨</option>
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
					<table id="search-result" class="table table-striped">
						<thead>
							<tr>
								<th><i>#</i></th>
								<th>项目名称</th>
								<th>标段名称</th>
								<th>标段类型</th>
								<th>规格名称</th>
								<th>税目</th>
								<th>应纳资源税</th>
							</tr>
						</thead>

						<tbody>
							@php
								$i = 0
							@endphp
							@foreach ($results as $result)
							<tr>
								<td><i>{{ ++$i }}</i></td>
								<td>{{ $result->project_name }}</td>
								<td>{{ $result->lot_name }}</td>
								<td>{{ $result->lot_type}}</td>
								<td>{{ $result->specification_name }}</td>
								<td>{{ $result->tax_name }}</td>
								<td>{{ $result->total }}</td>
							</tr>
							@endforeach
						</tbody>

						<tfoot>
							<tr>
								<td colspan="6">
									<strong>合计</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									应纳资源税：{{ $results->sum('total') }} 元&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									已缴资源税：{{ $paid }} 元&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									自行申报缴纳资源税：{{ $declaration }} 元&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									应补资源税：{{ $payable - $paid - $declaration }} 元
								</td>
							</tr>
						</tfoot>
					</table>
				@endif
            </div>
        </div>
    </div>
</div>
<!-- /Result table -->

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
@stop

@push('styles')
	@if ($searched)
	<link href="{{ asset('css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
	@endif
@endpush

@push('scripts')
	@if ($searched)
	<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
	<script src="{{ asset('js/Chart.min.js') }}"></script>

	<script>
	// Datatables
	$('#search-result').dataTable({
		language: {
			url: "{{ asset('js/i18n/Chinese.json') }}"
		}
	});

	// Bar chart
	if ($('#bar-chart').length) {
		var ctx = document.getElementById("bar-chart");
		var mybarChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: [
					'应纳资源税',
					'应补资源税',
					'已缴资源税',
					'自行申报缴纳资源税'
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
				'已缴资源税',
				'自行申报缴纳资源税'
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