@extends('layouts.app')

@section('title', '导入项目')

@section('content')
<form method="post" action="{{ route('tax.import') }}" class="form-horizontal form-label-left" enctype="multipart/form-data">
	{{ csrf_field() }}

	<div class="form-group">
		<label for="file" class="control-label col-md-3 col-sm-3 col-xs-12">上传文件</label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="file" class="form-control col-md-7 col-xs-12" id="file" name="file" placeholder="上传文件">
		</div>
		<p class="help-block">文件扩展名为.xls或.xlsx</p>
	</div>
	<div class="ln_solid"></div>
	<div class="form-group">
		<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
			<button type="submit" class="btn btn-success">导入</button>
		</div>
	</div>
</form>
@stop