@extends('layouts.app')

@section('title', '编辑资源税管理证明')

@section('content')
<form method="post" action="{{ route('paid.update', $paid->id) }}" class="form-horizontal form-label-left" enctype="multipart/form-data">
	{{ method_field('put') }}
	{{ csrf_field() }}

	<div class="form-group">
		<label for="project" class="control-label col-md-3 col-sm-3 col-xs-12">项目名称 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<select id="project" name="project" class="form-control col-md-7 col-xs-12">
				@foreach ($projects as $project)
					<option value="project-{{ $project->id }}"{{ $project->id === $paid->section->project->id ? ' selected' : ''}}>{{ $project->name }}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="type" class="control-label col-md-3 col-sm-3 col-xs-12">标段类型 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<select id="type" name="type" class="form-control col-md-7 col-xs-12">
				@foreach ($types as $type)
					<option value="type-{{ $type->id }}"{{ $type->id === $paid->section->type->id ? ' selected' : ''}}>{{ $type->name }}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="section_id" class="control-label col-md-3 col-sm-3 col-xs-12">标段名称 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<select id="section_id" name="section_id" class="form-control col-md-7 col-xs-12">
				@foreach ($sections as $section)
					<option value="{{ $section->id }}" data-chained="project-{{ $section->project_id }}+type-{{ $section->type_id }}"{{ $section->id === $paid->section_id ? ' selected' : ''}}>{{ $section->name }}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="tax_name" class="control-label col-md-3 col-sm-3 col-xs-12">税目 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<select id="tax_name" name="tax_name" class="form-control col-md-7 col-xs-12">
				@foreach ($rates as $rate)
					<option value="{{ $rate->name }}"{{ $rate->name === $paid->tax_name ? ' selected' : ''}}>{{ $rate->name }}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="unit" class="control-label col-md-3 col-sm-3 col-xs-12">计量单位 <span class="required">*</label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12" id="unit" name="unit" value="{{ $paid->unit }}"  placeholder="计量单位" required>
		</div>
	</div>
	<div class="form-group">
		<label for="amount" class="control-label col-md-3 col-sm-3 col-xs-12">数量 <span class="required">*</label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12" id="amount" name="amount" value="{{ $paid->amount }}"  placeholder="数量" required>
		</div>
	</div>
	<div class="form-group">
		<label for="total" class="control-label col-md-3 col-sm-3 col-xs-12">税款金额 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12" id="total" name="total" value="{{ $paid->total }}"  placeholder="税款金额" required>
		</div>
	</div>
	<div class="form-group">
		<label for="issue_time" class="control-label col-md-3 col-sm-3 col-xs-12">开具时间 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12 has-feedback-left" id="issue_time" name="issue_time" value="{{ $paid->issue_time }}"  placeholder="开具时间" required>
			<span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
		</div>
	</div>
	<div class="form-group">
		<label for="authority" class="control-label col-md-3 col-sm-3 col-xs-12">开具证明税务机关 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12" id="authority" name="authority" value="{{ $paid->authority }}"  placeholder="开具证明税务机关" required>
		</div>
	</div>
	<div class="form-group">
		<label for="sale" class="control-label col-md-3 col-sm-3 col-xs-12">销售单位名称 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12" id="sale" name="sale" value="{{ $paid->sale }}"  placeholder="销售单位名称" required>
		</div>
	</div>
	<div class="form-group">
		<label for="file" class="control-label col-md-3 col-sm-3 col-xs-12">证明材料 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="file" class="form-control col-md-7 col-xs-12" id="file" name="file" placeholder="证明材料" value="{{ $paid->pathname }}">
			<p>
				文件扩展名为：jpg或png
			</p>
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 col-sm-offset-3">
			<a href="{{ asset('storage/' . $paid->pathname) }}" title="{{ $paid->name }}">
				<img src="{{ asset('storage/' . $paid->pathname) }}" alt="{{ $paid->name }}" width="100%">
			</a>
		</div>
	</div>
	<div class="ln_solid"></div>
	<div class="form-group">
		<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
			<button type="submit" class="btn btn-success">保存</button>
		</div>
	</div>
</form>
@stop

@push('styles')
	<link href="{{ asset('css/daterangepicker.css') }}" rel="stylesheet">
@endpush

@push('scripts')
	<script src="{{ asset('js/moment.min.js') }}"></script>
	<script src="{{ asset('js/daterangepicker.js') }}"></script>
	<script>
	// DateRangePicker
	$('#issue_time').daterangepicker({
		singleDatePicker: true,
		singleClasses: 'picker_1',
		locale: {
			format: 'YYYY-MM-DD',
			seperator: '-',
            applyLabel: '确认',
            cancelLabel: '取消',
            fromLabel: '从',
            toLabel: '到',
            weekLabel: 'W',
            customRangeLabel: '自定义',
            daysOfWeek: ['日', '一', '二', '三', '四', '五', '六'],
            monthNames: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
            firstDay: 1
		}
	});
	</script>
@endpush