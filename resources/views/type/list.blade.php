@extends('layouts.list')

@section('title', '标段类型列表')

@section('content')
<thead>
	<tr>
		<th>ID</th>
		<th>类型名称</th>
		<th>备注</th>
		<th>编辑</th>
		<th>删除</th>
	</tr>
</thead>

<tbody>
	@foreach ($types as $type)
		<tr>
			<td>{{ $type->id }}</td>
			<td>{{ $type->name }}</td>
			<td>{{ $type->note }}</td>
			<td>
				<p data-placement="top" data-toggle="tooltip" title="编辑">
					<a href="{{ route('type.edit', $type->id) }}" class="btn btn-primary btn-xs" role="button">
						<span class="fa fa-pencil"></span>
					</a>
				</p>
			</td>
			<td>
				<p data-placement="top" data-toggle="tooltip" title="删除">
					<a href="#" class="btn btn-danger btn-xs" role="button" onclick="confirm('你确定要删除这条记录？') ? document.getElementById('delete-{{ $type->id }}-form').submit() : false">
						<span class="fa fa-trash"></span>
					</a>
					<form id="delete-{{ $type->id }}-form" method="post" action="{{ route('type.delete', $type->id) }}" style="display: none">
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
		<td colspan="5">
			<a href="{{ route('type.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> 新增</a>
		</td>
	</tr>
</tfoot>
@stop
