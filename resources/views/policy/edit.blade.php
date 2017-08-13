@extends('layouts.app')

@section('title', '编辑政策文件项目')

@section('content')
<form method="post" action="{{ route('policy.update', $policy->id) }}" class="form-horizontal form-label-left" enctype="multipart/form-data">
	{{ method_field('put') }}
	{{ csrf_field() }}

	<div class="form-group">
		<label for="name" class="control-label col-md-3 col-sm-3 col-xs-12">文件名称 <span class="required">*</label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12" id="name" name="name" value="{{ $policy->name }}"  placeholder="文件名称" required>
		</div>
	</div>
	<div class="form-group">
		<label for="file" class="control-label col-md-3 col-sm-3 col-xs-12">政策文件 <span class="required">*</label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			@if (empty($policy->pathname))
				<input type="file" class="form-control col-md-7 col-xs-12" id="file" name="file" placeholder="政策文件" value="{{ $policy->pathname }}" required>
			@else
				<div class="form-control-static">
					<a href="{{ asset('storage/' . $policy->pathname) }}" title="{{ $policy->name }}">{{ $policy->name }}</a> <i class="fa fa-download"></i>
				</div>
			@endif
		</div>
	</div>
	<div class="ln_solid"></div>
	<div class="form-group">
		<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
			<button type="submit" class="btn btn-success">上传</button>
		</div>
	</div>
</form>
@stop