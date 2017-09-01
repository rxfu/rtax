@extends('layouts.app')

@section('title', '编辑标段类型')

@section('content')
<form method="post" action="{{ route('type.update', $type->id) }}" class="form-horizontal form-label-left">
	{{ method_field('put') }}
	{{ csrf_field() }}

	<div class="form-group">
		<label for="name" class="control-label col-md-3 col-sm-3 col-xs-12">类型名称 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12" id="name" name="name" placeholder="类型名称" value="{{ $type->name }}" required>
		</div>
	</div>
	<div class="form-group">
		<label for="note" class="control-label col-md-3 col-sm-3 col-xs-12">备注</label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<textarea class="form-control col-md-7 col-xs-12" rows="5" id="note" name="note" placeholder="备注">{{ $type->note }}</textarea>
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