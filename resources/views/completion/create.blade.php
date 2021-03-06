@extends('layouts.app')

@section('title', '新增完工比例')

@section('content')
<form method="post" action="{{ route('completion.save') }}" class="form-horizontal form-label-left">
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
		<label for="before" class="control-label col-md-3 col-sm-3 col-xs-12">改革前完工比例 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<div class="input-group">
				<input type="text" class="form-control col-md-7 col-xs-12" id="before" name="before" value="{{ old('before') }}"  placeholder="改革前完工比例" required>
				<span class="input-group-addon">%</span>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label for="after" class="control-label col-md-3 col-sm-3 col-xs-12">改革后完工比例 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<div class="input-group">
				<input type="text" class="form-control col-md-7 col-xs-12" id="after" name="after" value="{{ old('after') }}"  placeholder="改革后完工比例" required>
				<span class="input-group-addon">%</span>
			</div>
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