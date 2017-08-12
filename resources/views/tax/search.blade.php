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
					<td>{{ $result->project_name }}</td>
					<td>{{ $result->lot_name }}</td>
					<td>{{ $result->lot_type}}</td>
					<td>{{ $result->specification_name }}</td>
					<td>{{ $result->tax_name }}</td>
					<td>{{ $result->total }}</td>
				@endforeach
			</tbody>

			<tfoot>
				<tr>
					<td colspan="6">
						<strong>合计</strong>
						应纳资源税：
						已缴资源税：
						自行申报缴纳资源税：
						应补资源税：
					</td>
				</tr>
			</tfoot>
		</table>
	@endif
@stop

@push('scripts')
	<script src="{{ asset('js/Chart.min.js') }}"></script>
@endpush