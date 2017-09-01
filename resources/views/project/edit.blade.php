@extends('layouts.app')

@section('title', '编辑项目')

@section('content')
<form method="post" action="{{ route('project.update', $project->id) }}" class="form-horizontal form-label-left">
	{{ method_field('put') }}
	{{ csrf_field() }}

	<div class="form-group">
		<label for="name" class="control-label col-md-3 col-sm-3 col-xs-12">项目名称 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12" id="name" name="name" placeholder="项目名称" value="{{ $project->name }}" required>
		</div>
	</div>
	<div class="form-group">
		<label for="building" class="control-label col-md-3 col-sm-3 col-xs-12">建设方 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12" id="building" name="building" placeholder="建设方" value="{{ $project->building }}" required>
		</div>
	</div>
	<div class="form-group">
		<label for="building_number" class="control-label col-md-3 col-sm-3 col-xs-12">建设方纳税人识别号 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12" id="building_number" name="building_number" placeholder="建设方纳税人识别号" value="{{ $project->building_number }}" required>
		</div>
	</div>
	<div class="form-group">
		<label for="roadbed_amount" class="control-label col-md-3 col-sm-3 col-xs-12">路基标数量 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12" id="roadbed_amount" name="roadbed_amount" placeholder="路基标数量" value="{{ $project->roadbed_amount }}" required>
		</div>
	</div>
	<div class="form-group">
		<label for="road_amount" class="control-label col-md-3 col-sm-3 col-xs-12">路面标数量 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12" id="road_amount" name="road_amount" placeholder="路面标数量" value="{{ $project->road_amount }}" required>
		</div>
	</div>
	<div class="form-group">
		<label for="investment" class="control-label col-md-3 col-sm-3 col-xs-12">总投资额 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12" id="investment" name="investment" placeholder="总投资额" value="{{ $project->investment }}" required>
		</div>
	</div>
	<div class="form-group">
		<label for="kilometre" class="control-label col-md-3 col-sm-3 col-xs-12">总里程数 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12" id="kilometre" name="kilometre" placeholder="总里程数" value="{{ $project->kilometre }}" required>
		</div>
	</div>
	<div class="form-group">
		<label for="address" class="control-label col-md-3 col-sm-3 col-xs-12">工程地址 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12" id="address" name="address" placeholder="工程地址" value="{{ $project->address }}" required>
		</div>
	</div>
	<div class="form-group">
		<label for="begtime" class="control-label col-md-3 col-sm-3 col-xs-12">开工时间 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12 has-feedback-left" id="begtime" name="begtime" placeholder="开工时间" value="{{ $project->begtime }}" required>
			<span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
		</div>
	</div>
	<div class="form-group">
		<label for="endtime" class="control-label col-md-3 col-sm-3 col-xs-12">完工时间 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12 has-feedback-left" id="endtime" name="endtime" placeholder="完工时间" value="{{ $project->endtime }}" required>
			<span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
		</div>
	</div>
	<div class="form-group">
		<label for="authority" class="control-label col-md-3 col-sm-3 col-xs-12">主管税务机关 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12" id="authority" name="authority" placeholder="主管税务机关" value="{{ $project->authority }}" required>
		</div>
	</div>
	<div class="form-group">
		<label for="bureau" class="control-label col-md-3 col-sm-3 col-xs-12">主管税务分局 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12" id="bureau" name="bureau" placeholder="主管税务分局" value="{{ $project->bureau }}" required>
		</div>
	</div>
	<div class="form-group">
		<label for="finance" class="control-label col-md-3 col-sm-3 col-xs-12">财务负责人 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12" id="finance" name="finance" placeholder="财务负责人" value="{{ $project->finance }}" required>
		</div>
	</div>
	<div class="form-group">
		<label for="finance_phone" class="control-label col-md-3 col-sm-3 col-xs-12">财务负责人联系电话 <spa联系电话n class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12" id="finance_phone" name="finance_phone" placeholder="财务负责人联系电话" value="{{ $project->finance_phone }}" required>
		</div>
	</div>
	<div class="form-group">
		<label for="note" class="control-label col-md-3 col-sm-3 col-xs-12">备注</label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<textarea class="form-control col-md-7 col-xs-12" rows="5" id="note" name="note" placeholder="备注">{{ $project->note }}</textarea>
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

@push('styles')
	<link href="{{ asset('css/daterangepicker.css') }}" rel="stylesheet">
@endpush

@push('scripts')
	<script src="{{ asset('js/moment.min.js') }}"></script>
	<script src="{{ asset('js/daterangepicker.js') }}"></script>
	<script>
	// DateRangePicker
	$('#begtime, #endtime').daterangepicker({
		singleDatePicker: true,
		singleClasses: 'picker_1',
		locale: {
			format: 'YYYY-MM-DD',
			seperator: '-',
            applyLabel: '确认',
            cancelLabel: '取消',
            fromLabel: '从',
            toLabel: '到',
            weekLabel: 'W',
            customRangeLabel: '自定义',
            daysOfWeek: ['日', '一', '二', '三', '四', '五', '六'],
            monthNames: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
            firstDay: 1
		}
	});
	</script>
@endpush