@extends('layouts.block')

@section('title', '评估项目')

@section('content')
<!-- Tax table -->
<div class="row">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>应纳资源税</h2>

                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <table id="tax-table" class="table table-striped">
					<thead>
						<tr>
							<th>ID</th>
							<th>项目名称</th>
							<th>标段名称</th>
							<th>标段类型</th>
							<th>税种</th>
							<th>税目</th>
							<th>课税单价</th>
							<th>课税数量</th>
							<th>应纳税额</th>
							<th>编辑</th>
							<th>删除</th>
						</tr>
					</thead>

					<tbody>
						@foreach ($taxes as $tax)
							<tr>
								<td>{{ $tax->id }}</td>
								<td>{{ $tax->project_name }}</td>
								<td>{{ $tax->lot_name }}</td>
								<td>{{ $tax->lot_type }}</td>
								<td>{{ $tax->specification_name }}</td>
								<td>{{ $tax->tax_name }}</td>
								<td>{{ $tax->unit_price }}</td>
								<td>{{ $tax->total_amount }}</td>
								<td>{{ $tax->total }}</td>
								<td>
									<p data-placement="top" data-toggle="tooltip" title="编辑">
										<a href="{{ route('tax.edit', $tax->id) }}" class="btn btn-primary btn-xs" role="button">
											<span class="fa fa-pencil"></span>
										</a>
									</p>
								</td>
								<td>
									<p data-placement="top" data-toggle="tooltip" title="删除">
										<a href="#" class="btn btn-danger btn-xs" role="button" onclick="confirm('你确定要删除这条记录？') ? document.getElementById('delete-tax{{ $tax->id }}-form').submit() : false">
											<span class="fa fa-trash"></span>
										</a>
										<form id="delete-tax{{ $tax->id }}-form" method="post" action="{{ route('tax.delete', $tax->id) }}" style="display: none">
											{{ method_field('delete') }}
											{{ csrf_field() }}
										</form>
									</p>
								</td>
							</tr>
						@endforeach
					</tbody>

					<tfoot>
						<tr>
							<td colspan="10">
								<a href="{{ route('tax.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> 新增</a>
								<a href="{{ route('tax.excel') }}" class="btn btn-info"><i class="fa fa-upload"></i> 导入</a>
							</td>
						</tr>
					</tfoot>
				</table>
            </div>
        </div>
    </div>
</div>
<!-- /Tax table -->

<!-- Paid table -->
<div class="row">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>可抵资源税</h2>

                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <table id="paid-table" class="table table-striped">
					<thead>
						<tr>
							<th>ID</th>
							<th>项目名称</th>
							<th>标段名称</th>
							<th>标段类型</th>
							<th>税目</th>
							<th>数量</th>
							<th>金额</th>
							<th>证明材料</th>
							<th>编辑</th>
							<th>删除</th>
						</tr>
					</thead>

					<tbody>
						@foreach ($paids as $paid)
							<tr>
								<td>{{ $paid->id }}</td>
								<td>{{ $paid->project->project_name }}</td>
								<td>{{ $paid->project->lot_name }}</td>
								<td>{{ $paid->project->lot_type }}</td>
								<td>{{ $paid->tax_name }}</td>
								<td>{{ $paid->amount }}</td>
								<td>{{ $paid->total }}</td>
								<td>
									<a href="{{ asset('storage/' . $paid->pathname) }}" title="{{ $paid->name }}">{{ $paid->name }}</a>
								</td>
								<td>
									<p data-placement="top" data-toggle="tooltip" title="编辑">
										<a href="{{ route('paid.edit', $paid->id) }}" class="btn btn-primary btn-xs" role="button">
											<span class="fa fa-pencil"></span>
										</a>
									</p>
								</td>
								<td>
									<p data-placement="top" data-toggle="tooltip" title="删除">
										<a href="#" class="btn btn-danger btn-xs" role="button" onclick="confirm('你确定要删除这条记录？') ? document.getElementById('delete-paid{{ $paid->id }}-form').submit() : false">
											<span class="fa fa-trash"></span>
										</a>
										<form id="delete-paid{{ $paid->id }}-form" method="post" action="{{ route('paid.delete', $paid->id) }}" style="display: none">
											{{ method_field('delete') }}
											{{ csrf_field() }}
										</form>
									</p>
								</td>
							</tr>
						@endforeach
					</tbody>

					<tfoot>
						<tr>
							<td colspan="9">
								<a href="{{ route('paid.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> 新增</a>
							</td>
						</tr>
					</tfoot>
				</table>
            </div>
        </div>
    </div>
</div>
<!-- /Paid table -->

<!-- Declaration table -->
<div class="row">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>自行申报资源税</h2>

                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <table id="declaration-table" class="table table-striped">
					<thead>
						<tr>
							<th>ID</th>
							<th>项目名称</th>
							<th>标段名称</th>
							<th>标段类型</th>
							<th>税目</th>
							<th>金额</th>
							<th>编辑</th>
							<th>删除</th>
						</tr>
					</thead>

					<tbody>
						@foreach ($declarations as $declaration)
							<tr>
								<td>{{ $declaration->id }}</td>
								<td>{{ $declaration->project->project_name }}</td>
								<td>{{ $declaration->project->lot_name }}</td>
								<td>{{ $declaration->project->lot_type }}</td>
								<td>{{ $declaration->tax_name }}</td>
								<td>{{ $declaration->total }}</td>
								<td>
									<p data-placement="top" data-toggle="tooltip" title="编辑">
										<a href="{{ route('declaration.edit', $declaration->id) }}" class="btn btn-primary btn-xs" role="button">
											<span class="fa fa-pencil"></span>
										</a>
									</p>
								</td>
								<td>
									<p data-placement="top" data-toggle="tooltip" title="删除">
										<a href="#" class="btn btn-danger btn-xs" role="button" onclick="confirm('你确定要删除这条记录？') ? document.getElementById('delete-declaration{{ $declaration->id }}-form').submit() : false">
											<span class="fa fa-trash"></span>
										</a>
										<form id="delete-declaration{{ $declaration->id }}-form" method="post" action="{{ route('declaration.delete', $declaration->id) }}" style="display: none">
											{{ method_field('delete') }}
											{{ csrf_field() }}
										</form>
									</p>
								</td>
							</tr>
						@endforeach
					</tbody>

					<tfoot>
						<tr>
							<td colspan="7">
								<a href="{{ route('declaration.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> 新增</a>
							</td>
						</tr>
					</tfoot>
				</table>
            </div>
        </div>
    </div>
</div>
<!-- /Declaration table -->
@stop

@push('styles')
	<link href="{{ asset('css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/icheck/skins/all.css') }}" rel="stylesheet">
@endpush

@push('scripts')
	<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
	<script src="{{ asset('js/icheck.min.js') }}"></script>
	<script>
		$('#tax-table, #paid-table, #declaration-table').dataTable({
			language: {
				url: "{{ asset('js/i18n/Chinese.json') }}"
			}
		});
	</script>
@endpush