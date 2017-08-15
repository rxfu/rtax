@extends('layouts.app')

@section('title', '编辑可抵资源税项目')

@section('content')
<form method="post" action="{{ route('paid.update', $paid->id) }}" class="form-horizontal form-label-left" enctype="multipart/form-data">
	{{ method_field('put') }}
	{{ csrf_field() }}

	<div class="form-group">
		<label for="project_name" class="control-label col-md-3 col-sm-3 col-xs-12">项目名称 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<select id="project_name" name="project_name" class="form-control col-md-7 col-xs-12">
				@foreach ($projects->pluck('project_name')->unique() as $project_name)
					<option value="{{ $project_name }}"{{ $project_name === $paid->project_name ? ' selected' : ''}}>{{ $project_name }}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="lot_name" class="control-label col-md-3 col-sm-3 col-xs-12">标段名称 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<select id="lot_name" name="lot_name" class="form-control col-md-7 col-xs-12">
				@foreach ($projects->pluck('lot_name')->unique() as $lot_name)
					<option value="{{ $lot_name }}"{{ $lot_name === $paid->lot_name ? ' selected' : ''}}>{{ $lot_name }}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="tax_name" class="control-label col-md-3 col-sm-3 col-xs-12">税目 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<select id="tax_name" name="tax_name" class="form-control col-md-7 col-xs-12">
				@foreach ($rates as $rate)
					<option value="{{ $rate->name }}"{{ $rate->name === $tax->tax_name ? ' selected' : ''}}>{{ $rate->name }}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="unit" class="control-label col-md-3 col-sm-3 col-xs-12">单位 <span class="required">*</label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12" id="unit" name="unit" value="立方米"  placeholder="单位" required>
		</div>
	</div>
	<div class="form-group">
		<label for="amount" class="control-label col-md-3 col-sm-3 col-xs-12">数量 <span class="required">*</label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12" id="amount" name="amount" value="{{ $paid->amount }}"  placeholder="数量" required>
		</div>
	</div>
	<div class="form-group">
		<label for="total" class="control-label col-md-3 col-sm-3 col-xs-12">金额 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12" id="total" name="total" value="{{ $paid->total }}"  placeholder="金额" required>
		</div>
	</div>
	<div class="form-group">
		<label for="file" class="control-label col-md-3 col-sm-3 col-xs-12">证明材料</label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			@if (empty($paid->pathname))
				<input type="file" class="form-control col-md-7 col-xs-12" id="file" name="file" placeholder="证明材料" value="{{ $paid->pathname }}">
			@else
				<div class="form-control-static">
					<a href="{{ asset('storage/' . $paid->pathname) }}" title="{{ $paid->name }}">{{ $paid->name }}</a> <i class="fa fa-download"></i>
				</div>
			@endif
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