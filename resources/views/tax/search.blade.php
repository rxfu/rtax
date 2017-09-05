@extends('layouts.app')

@section('title', '成果查询')

@section('content')
<!-- Result table -->
<form method="get" action="{{ route('tax.search') }}" class="form-horizontal form-label-left">
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
	<p>查询条件：{!! $condition !!}</p>
	<table id="search-result" class="table table-striped">
		<thead>
			<tr>
				<th><i>#</i></th>
				<th>项目名称</th>
				<th>标段类型</th>
				<th>标段名称</th>
				<th>规格名称</th>
				<th>税目</th>
				<th>改革前完工</th>
				<th>改革后完工</th>
				<th>应纳资源税</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($results as $result)
			<tr>
				<td><i>{{ $loop->index + 1 }}</i></td>
				<td>{{ $result->section->project->name }}</td>
				<td>{{ $result->section->type->name }}</td>
				<td>{{ $result->section->name }}</td>
				<td>{{ $result->specification_name }}</td>
				<td>{{ $result->tax_name }}</td>
				<td>{{ $result->completion->before }}%</td>
				<td>{{ $result->completion->after }}%</td>
				<td>{{ $result->total }}</td>
			</tr>
			@endforeach
		</tbody>

		<tfoot>
			<tr>
				<td colspan="9" style="font-size: larger">
					<strong>合计</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					应纳资源税：{{ $results->sum('total') }} 元&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					可抵资源税：{{ $paid }} 元&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					自行申报税：{{ $declaration }} 元&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					应补资源税：{{ $payable - $paid - $declaration }} 元
				</td>
			</tr>
		</tfoot>
	</table>
@endif
<!-- /Result table -->
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
	<script>
	// Datatables
	$('#search-result').dataTable({
		language: {
			url: "{{ asset('js/i18n/Chinese.json') }}"
		}
	});
	</script>
	@endif
@endpush