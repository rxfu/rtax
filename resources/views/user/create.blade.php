@extends('layouts.app')

@section('title', '新增用户')

@section('content')
<form method="post" action="{{ route('user.save') }}" class="form-horizontal form-label-left">
	{{ csrf_field() }}

	<div class="form-group">
		<label for="username" class="control-label col-md-3 col-sm-3 col-xs-12">用户名 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12" id="username" name="username" placeholder="用户名" value="{{ old('username') }}" required>
		</div>
	</div>
	<div class="form-group">
		<label for="password" class="control-label col-md-3 col-sm-3 col-xs-12">密码 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="password" class="form-control col-md-7 col-xs-12" id="password" name="password" placeholder="密码" required>
		</div>
	</div>
	<div class="form-group">
		<label for="department_id" class="control-label col-md-3 col-sm-3 col-xs-12">单位 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<select id="department_id" name="department_id" class="form-control col-md-7 col-xs-12">
				@foreach ($departments as $department)
					<option value="{{ $department->id }}">{{ $department->name }}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="name" class="control-label col-md-3 col-sm-3 col-xs-12">姓名</label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12" id="name" name="name" value="{{ old('name') }}"  placeholder="姓名">
		</div>
	</div>
	<div class="form-group">
		<label for="phone" class="control-label col-md-3 col-sm-3 col-xs-12">联系电话</label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12" id="phone" name="phone" value="{{ old('phone') }}"  placeholder="联系电话">
		</div>
	</div>
	<div class="form-group">
		<label for="is_admin" class="control-label col-md-3 col-sm-3 col-xs-12">是否系统管理员 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<div id="is_admin" class="btn-group" data-toggle="buttons">
				<label for="is_admin" class="btn btn-default">
					<input type="radio" name="is_admin" value='1' autocomplete="off">是</input>
				</label>
				<label for="is_admin" class="btn btn-primary">
					<input type="radio" name="is_admin" value='0' autocomplete="off" checked>否</input>
				</label>
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
<script>
$('.btn-group > .btn').click(function() {
	$('.btn-group > .btn').removeClass('btn-primary').addClass('btn-default');
	$(this).removeClass('btn-default').addClass('btn-primary');
});
</script>
@endpush