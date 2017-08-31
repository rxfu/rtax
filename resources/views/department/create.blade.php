@extends('layouts.app')

@section('title', '新增税率')

@section('content')
<form method="post" action="{{ route('department.save') }}" class="form-horizontal form-label-left">
	{{ csrf_field() }}

	<div class="form-group">
		<label for="name" class="control-label col-md-3 col-sm-3 col-xs-12">单位名称 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12" id="name" name="name" placeholder="单位名称" value="{{ old('name') }}" required>
		</div>
	</div>
	<div class="form-group">
		<label for="is_activated" class="control-label col-md-3 col-sm-3 col-xs-12">是否启用 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<div id="is_activated" class="btn-group" data-toggle="buttons">
				<label for="is_activated" class="btn btn-primary">
					<input type="radio" name="is_activated" value='1' autocomplete="off" checked>是</input>
				</label>
				<label for="is_activated" class="btn btn-default">
					<input type="radio" name="is_activated" value='0' autocomplete="off">否</input>
				</label>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label for="description" class="control-label col-md-3 col-sm-3 col-xs-12">备注</label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<textarea class="form-control col-md-7 col-xs-12" id="description" name="description" placeholder="备注">{{ old('description') }}</textarea>
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