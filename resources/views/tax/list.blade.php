@extends('layouts.list')

@section('title', '税项列表')

@section('content')
<thead>
	<tr>
		<th>ID</th>
		<th>项目名称</th>
		<th>标段名称</th>
		<th>标段类型</th>
		<th>税目</th>
		<th>课税单位</th>
		<th>课税数量</th>
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
			<td>{{ $tax->tax_name }}</td>
			<td>{{ $tax->unit }}</td>
			<td>{{ $tax->total_amount }}</td>
			<td>
				<p data-placement="top" data-toggle="tooltip" title="编辑">
					<a href="{{ route('tax.edit', $tax->id) }}" class="btn btn-primary btn-xs" role="button">
						<span class="fa fa-pencil"></span>
					</a>
				</p>
			</td>
			<td>
				<p data-placement="top" data-toggle="tooltip" title="删除">
					<a href="#" class="btn btn-danger btn-xs" role="button" onclick="confirm('你确定要删除这条记录？') ? document.getElementById('delete-{{ $tax->id }}-form').submit() : false">
						<span class="fa fa-trash"></span>
					</a>
					<form id="delete-{{ $tax->id }}-form" method="post" action="{{ route('tax.delete', $tax->id) }}" style="display: none">
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
			<a href="{{ route('tax.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> 新增</a>
		</td>
	</tr>
</tfoot>
@stop
