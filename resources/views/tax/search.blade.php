@extends('layouts.app')

@section('title', '成果查询')

@section('content')
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
		<table class="table table-striped">
			<thead>
				<tr>
					<th>项目名称</th>
					<th>标段名称</th>
					<th>标段类型</th>
					<th>规格名称</th>
					<th>税目</th>
					<th>应纳资源税</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($results as $result)
				<tr>
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

		<canvas id="bar-chart"></canvas>
	@endif
@stop

@push('scripts')
	@if ($searched)
	<script src="{{ asset('js/Chart.min.js') }}"></script>

	<script>
	if ($('#bar-chart').length) {
		var ctx = document.getElementById("bar-chart");
		var mybarChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: tax_names,
				datasets: datasets
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
	</script>
	@endif
@endpush