@extends('layouts.app')

@section('title', '新增政策文件')

@section('content')
<form method="post" action="{{ route('policy.save') }}" class="form-horizontal form-label-left" enctype="multipart/form-data">
	{{ csrf_field() }}

	<div class="form-group">
		<label for="name" class="control-label col-md-3 col-sm-3 col-xs-12">文件名称 <span class="required">*</label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12" id="name" name="name" value="{{ old('name') }}"  placeholder="文件名称" required>
		</div>
	</div>
	<div class="form-group">
		<label for="file" class="control-label col-md-3 col-sm-3 col-xs-12">政策文件 <span class="required">*</label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="file" class="form-control col-md-7 col-xs-12" id="file" name="file" placeholder="政策文件" required>
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