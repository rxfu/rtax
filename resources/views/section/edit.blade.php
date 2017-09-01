@extends('layouts.app')

@section('title', '编辑标段')

@section('content')
<form method="post" action="{{ route('section.update', $section->id) }}" class="form-horizontal form-label-left">
	{{ method_field('put') }}
	{{ csrf_field() }}

	<div class="form-group">
		<label for="project_id" class="control-label col-md-3 col-sm-3 col-xs-12">所属项目 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<select id="project_id" name="project_id" class="form-control col-md-7 col-xs-12">
				@foreach ($projects as $project)
					<option value="{{ $project->id }}"{{ $project->id === $section->project_id ? ' selected' : ''}}>{{ $project->name }}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="type_id" class="control-label col-md-3 col-sm-3 col-xs-12">标段类型 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<select id="type_id" name="type_id" class="form-control col-md-7 col-xs-12">
				@foreach ($types as $type)
					<option value="{{ $type->id }}"{{ $type->id === $section->type_id ? ' selected' : ''}}>{{ $type->name }}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="name" class="control-label col-md-3 col-sm-3 col-xs-12">标段名称 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12" id="name" name="name" placeholder="标段名称" value="{{ $section->name }}" required>
		</div>
	</div>
	<div class="form-group">
		<label for="building" class="control-label col-md-3 col-sm-3 col-xs-12">建设方 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12" id="building" name="building" placeholder="建设方" value="{{ $section->building }}" required>
		</div>
	</div>
	<div class="form-group">
		<label for="constructor" class="control-label col-md-3 col-sm-3 col-xs-12">施工方 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12" id="constructor" name="constructor" placeholder="施工方" value="{{ $section->constructor }}" required>
		</div>
	</div>
	<div class="form-group">
		<label for="investment" class="control-label col-md-3 col-sm-3 col-xs-12">投资额 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12" id="investment" name="investment" placeholder="投资额" value="{{ $section->investment }}" required>
		</div>
	</div>
	<div class="form-group">
		<label for="kilometre" class="control-label col-md-3 col-sm-3 col-xs-12">里程数 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12" id="kilometre" name="kilometre" placeholder="里程数" value="{{ $section->kilometre }}" required>
		</div>
	</div>
	<div class="form-group">
		<label for="address" class="control-label col-md-3 col-sm-3 col-xs-12">工程地址 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12" id="address" name="address" placeholder="工程地址" value="{{ $section->address }}" required>
		</div>
	</div>
	<div class="form-group">
		<label for="begtime" class="control-label col-md-3 col-sm-3 col-xs-12">开工时间 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12 has-feedback-left" id="begtime" name="begtime" placeholder="开工时间" value="{{ $section->begtime }}" required>
			<span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
		</div>
	</div>
	<div class="form-group">
		<label for="endtime" class="control-label col-md-3 col-sm-3 col-xs-12">完工时间 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12 has-feedback-left" id="endtime" name="endtime" placeholder="完工时间" value="{{ $section->endtime }}" required>
			<span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
		</div>
	</div>
	<div class="form-group">
		<label for="authority" class="control-label col-md-3 col-sm-3 col-xs-12">主管税务机关 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12" id="authority" name="authority" placeholder="主管税务机关" value="{{ $section->authority }}" required>
		</div>
	</div>
	<div class="form-group">
		<label for="bureau" class="control-label col-md-3 col-sm-3 col-xs-12">主管税务分局 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12" id="bureau" name="bureau" placeholder="主管税务分局" value="{{ $section->bureau }}" required>
		</div>
	</div>
	<div class="form-group">
		<label for="finance" class="control-label col-md-3 col-sm-3 col-xs-12">财务负责人 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12" id="finance" name="finance" placeholder="财务负责人" value="{{ $section->finance }}" required>
		</div>
	</div>
	<div class="form-group">
		<label for="finance_phone" class="control-label col-md-3 col-sm-3 col-xs-12">财务负责人联系电话 <spa联系电话n class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12" id="finance_phone" name="finance_phone" placeholder="财务负责人联系电话" value="{{ $section->finance_phone }}" required>
		</div>
	</div>
	<div class="form-group">
		<label for="bank" class="control-label col-md-3 col-sm-3 col-xs-12">开户银行 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12" id="bank" name="bank" placeholder="开户银行" value="{{ $section->bank }}" required>
		</div>
	</div>
	<div class="form-group">
		<label for="bank_name" class="control-label col-md-3 col-sm-3 col-xs-12">开户行名称 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12" id="bank_name" name="bank_name" placeholder="开户行名称" value="{{ $section->bank_name }}" required>
		</div>
	</div>
	<div class="form-group">
		<label for="bank_account" class="control-label col-md-3 col-sm-3 col-xs-12">开户行账号 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12" id="bank_account" name="bank_account" placeholder="开户行账号" value="{{ $section->bank_account }}" required>
		</div>
	</div>
	<div class="form-group">
		<label for="note" class="control-label col-md-3 col-sm-3 col-xs-12">备注</label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<textarea class="form-control col-md-7 col-xs-12" rows="5" id="note" name="note" placeholder="备注">{{ $section->note }}</textarea>
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