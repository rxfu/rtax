@extends('layouts.list')

@section('title', '用户列表')

@section('content')
<thead>
	<tr>
		<th>ID</th>
		<th>用户名</th>
		<th>Email</th>
		<th>真实姓名</th>
		<th>创建时间</th>
		<th>编辑</th>
		<th>删除</th>
	</tr>
</thead>

<tbody>
	@foreach ($users as $item)
		<tr>
			<td>{{ $item->id }}</td>
			<td>{{ $item->username }}</td>
			<td>{{ $item->email }}</td>
			<td>{{ $item->name }}</td>
			<td>{{ $item->created_at }}</td>
			<td>
				<p data-placement="top" data-toggle="tooltip" title="编辑">
					<a href="{{ route('user.edit', $item->id) }}" class="btn btn-primary btn-xs" role="button">
						<span class="fa fa-pencil"></span>
					</a>
				</p>
			</td>
			<td>
				<p data-placement="top" data-toggle="tooltip" title="删除">
					<a href="#" class="btn btn-danger btn-xs" role="button" onclick="confirm('你确定要删除这条记录？') ? document.getElementById('delete-{{ $item->id }}-form').submit() : false">
						<span class="fa fa-trash"></span>
					</a>
					<form id="delete-{{ $item->id }}-form" method="post" action="{{ route('user.delete', $item->id) }}" style="display: none">
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
			<a href="{{ route('user.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> 新增</a>
		</td>
	</tr>
</tfoot>
@stop
