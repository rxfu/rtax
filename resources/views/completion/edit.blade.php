@extends('layouts.app')

@section('title', '编辑完工比例')

@section('content')
<form method="post" action="{{ route('completion.update', $completion->id) }}" class="form-horizontal form-label-left">
	{{ method_field('put') }}
	{{ csrf_field() }}

	<div class="form-group">
		<label for="project" class="control-label col-md-3 col-sm-3 col-xs-12">项目名称 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<select id="project" name="project" class="form-control col-md-7 col-xs-12">
				@foreach ($projects as $project)
					<option value="project-{{ $project->id }}"{{ $project->id === $completion->section->project->id ? ' selected' : ''}}>{{ $project->name }}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="type" class="control-label col-md-3 col-sm-3 col-xs-12">标段类型 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<select id="type" name="type" class="form-control col-md-7 col-xs-12">
				@foreach ($types as $type)
					<option value="type-{{ $type->id }}"{{ $type->id === $completion->section->type->id ? ' selected' : ''}}>{{ $type->name }}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="section_id" class="control-label col-md-3 col-sm-3 col-xs-12">标段名称 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<select id="section_id" name="section_id" class="form-control col-md-7 col-xs-12">
				@foreach ($sections as $section)
					<option value="{{ $section->id }}" data-chained="project-{{ $section->project_id }}+type-{{ $section->type_id }}"{{ $section->id === $completion->section_id ? ' selected' : ''}}>{{ $section->name }}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="completion_before" class="control-label col-md-3 col-sm-3 col-xs-12">改革前完工比例 <span class="required">*</label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<div class="input-group">
				<input type="text" class="form-control col-md-7 col-xs-12" id="completion_before" name="completion_before" value="{{ $completion->completion_before }}"  placeholder="改革前完工比例" required>
				<span class="input-group-addon">%</span>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label for="completion_after" class="control-label col-md-3 col-sm-3 col-xs-12">改革后完工比例 <span class="required">*</label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<div class="input-group">
				<input type="text" class="form-control col-md-7 col-xs-12" id="completion_after" name="completion_after" value="{{ $completion->completion_after }}"  placeholder="改革后完工比例" required>
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