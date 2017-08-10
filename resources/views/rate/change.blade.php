@extends('layouts.app')

@section('title', '修改密码')

@section('content')
<form method="post" action="{{ route('user.change') }}" class="form-horizontal form-label-left">
	{{ method_field('put') }}
	{{ csrf_field() }}

	<div class="form-group">
		<label for="old_password" class="control-label col-md-3 col-sm-3 col-xs-12">旧密码 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="password" class="form-control col-md-7 col-xs-12" id="old_password" name="old_password" placeholder="旧密码" required>
		</div>
	</div>
	<div class="form-group">
		<label for="password" class="control-label col-md-3 col-sm-3 col-xs-12">密码 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="password" class="form-control col-md-7 col-xs-12" id="password" name="password" placeholder="密码" required>
		</div>
	</div>
	<div class="form-group">
		<label for="password_confirmation" class="control-label col-md-3 col-sm-3 col-xs-12">确认密码 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="password" class="form-control col-md-7 col-xs-12" id="password_confirmation" name="password_confirmation" placeholder="确认密码" required>
		</div>
	</div>
	<div class="ln_solid"></div>
	<div class="form-group">
		<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
			<button type="submit" class="btn btn-success">修改密码</button>
		</div>
	</div>
</form>
@stop