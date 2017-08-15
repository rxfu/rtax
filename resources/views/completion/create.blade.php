@extends('layouts.app')

@section('title', '新增完工进度')

@section('content')
<form method="post" action="{{ route('completion.save') }}" class="form-horizontal form-label-left">
	{{ csrf_field() }}

	<div class="form-group">
		<label for="project_name" class="control-label col-md-3 col-sm-3 col-xs-12">项目名称 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<select id="project_name" name="project_name" class="form-control col-md-7 col-xs-12">
				@foreach ($projects->pluck('project_name')->unique() as $project_name)
					<option value="{{ $project_name }}">{{ $project_name }}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="lot_name" class="control-label col-md-3 col-sm-3 col-xs-12">标段名称 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<select id="lot_name" name="lot_name" class="form-control col-md-7 col-xs-12">
				@foreach ($projects->pluck('lot_name')->unique() as $lot_name)
					<option value="{{ $lot_name }}">{{ $lot_name }}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="completion_before" class="control-label col-md-3 col-sm-3 col-xs-12">改革前完工比例 <span class="required">*</label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<div class="input-group">
				<input type="text" class="form-control col-md-7 col-xs-12" id="completion_before" name="completion_before" value="{{ old('completion_before') }}"  placeholder="改革前完工比例" required>
				<span class="input-group-addon">%</span>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label for="completion_after" class="control-label col-md-3 col-sm-3 col-xs-12">改革后完工比例 <span class="required">*</label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<div class="input-group">
				<input type="text" class="form-control col-md-7 col-xs-12" id="completion_after" name="completion_after" value="{{ old('completion_after') }}"  placeholder="改革后完工比例" required>
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