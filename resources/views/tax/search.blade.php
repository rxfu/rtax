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
						<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
							<div class="input-group">
								<input type="text" class="form-control" id="keywords" name="keywords" placeholder="查询项目名称...">
								<span class="input-group-btn">
									<button type="submit" class="btn btn-default">查询</button>
								</span>
							</div>
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
									<strong>合计</strong>&nbsp;&nbsp;
									应纳资源税：{{ $results->sum('total') }}&nbsp;&nbsp;
									已缴资源税：{{ $paid }}&nbsp;&nbsp;
									自行申报缴纳资源税：{{ $declaration }}&nbsp;&nbsp;
									应补资源税：{{ $payable - $paid - $declaration }}
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
			type: 'horizontalBar',
			data: {
				labels: lot_names,
				datasets: bardata
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
			labels: tax_names,
			datasets: piedata
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