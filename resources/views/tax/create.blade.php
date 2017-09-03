@extends('layouts.app')

@section('title', '新增评估项目')

@section('content')
<form method="post" action="{{ route('tax.save') }}" class="form-horizontal form-label-left">
	{{ csrf_field() }}

	<div class="form-group">
		<label for="project" class="control-label col-md-3 col-sm-3 col-xs-12">项目名称 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<select id="project" name="project" class="form-control col-md-7 col-xs-12">
				@foreach ($projects as $project)
					<option value="project-{{ $project->id }}">{{ $project->name }}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="type" class="control-label col-md-3 col-sm-3 col-xs-12">标段类型 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<select id="type" name="type" class="form-control col-md-7 col-xs-12">
				@foreach ($types as $type)
					<option value="type-{{ $type->id }}">{{ $type->name }}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="section_id" class="control-label col-md-3 col-sm-3 col-xs-12">标段名称 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<select id="section_id" name="section_id" class="form-control col-md-7 col-xs-12">
				@foreach ($sections as $section)
					<option value="{{ $section->id }}" data-chained="project-{{ $section->project_id }}+type-{{ $section->type_id }}">{{ $section->name }}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="specification_name" class="control-label col-md-3 col-sm-3 col-xs-12">规格名称 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12" id="specification_name" name="specification_name" placeholder="规格名称" value="{{ old('specification_name') }}" required>
		</div>
	</div>
	<div class="form-group">
		<label for="tax_name" class="control-label col-md-3 col-sm-3 col-xs-12">税目 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<select id="tax_name" name="tax_name" class="form-control col-md-7 col-xs-12">
				@foreach ($rates as $rate)
					<option value="{{ $rate->name }}">{{ $rate->name }}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="unit" class="control-label col-md-3 col-sm-3 col-xs-12">单位 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<select id="unit" name="unit" class="form-control col-md-7 col-xs-12">
				@foreach ($units as $unit)
					<option value="{{ $unit->unit }}">{{ $unit->unit }}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="unit_price" class="control-label col-md-3 col-sm-3 col-xs-12">单价 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12" id="unit_price" name="unit_price" value="{{ old('unit_price') }}"  placeholder="单价" required>
		</div>
	</div>
	<div class="form-group">
		<label for="total_amount" class="control-label col-md-3 col-sm-3 col-xs-12">数量 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12" id="total_amount" name="total_amount" value="{{ old('total_amount') }}"  placeholder="数量" required>
		</div>
	</div>
	<div class="form-group">
		<label for="flag" class="control-label col-md-3 col-sm-3 col-xs-12">资源税改革标记 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<select id="flag" name="flag" class="form-control col-md-7 col-xs-12">
				<option value="前" selected>前</option>
				<option value="后">后</option>
				<option value="跨">跨</option>
			</select>
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

@push('scripts')
<script src="{{ asset('js/jquery.chained.js') }}"></script>
<script>
	$('#section_id').chained('#project, #type');
</script>
@endpush