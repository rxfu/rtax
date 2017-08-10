@extends('layouts.app')

@section('title', '新增税率')

@section('content')
<form method="post" action="{{ route('rate.save') }}" class="form-horizontal form-label-left">
	{{ csrf_field() }}

	<div class="form-group">
		<label for="category" class="control-label col-md-3 col-sm-3 col-xs-12">税种 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12" id="category" name="category" placeholder="税种" value="{{ old('category') }}" required>
		</div>
	</div>
	<div class="form-group">
		<label for="flag" class="control-label col-md-3 col-sm-3 col-xs-12">资源税改革标记 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<select id="flag" name="flag" class="form-control col-md-7 col-xs-12">
				<option value="前" selected>前</option>
				<option value="后">后</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="name" class="control-label col-md-3 col-sm-3 col-xs-12">税目 <span class="required">*</label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12" id="name" name="name" value="{{ old('name') }}"  placeholder="税目" required>
		</div>
	</div>
	<div class="form-group">
		<label for="unit" class="control-label col-md-3 col-sm-3 col-xs-12">计量单位 <span class="required">*</label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12" id="unit" name="unit" value="{{ old('unit') }}"  placeholder="计量单位" required>
		</div>
	</div>
	<div class="form-group">
		<label for="rate" class="control-label col-md-3 col-sm-3 col-xs-12">税率 <span class="required">*</label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12" id="rate" name="rate" value="{{ old('rate') }}"  placeholder="税率" required>
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