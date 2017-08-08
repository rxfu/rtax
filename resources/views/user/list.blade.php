@extends('pages.list')

@section('title', '用户列表')

@section('thead')
	<th>ID</th>
	<th>用户名</th>
	<th>Email</th>
	<th>真实姓名</th>
	<th>创建时间</th>
	<th>编辑</th>
	<th>删除</th>
@stop

@section('tbody')
	@foreach ($users as $item)
		<tr>
			<td>
				<input type="checkbox" id="checkthis" name="checkthis" class="flat">
			</td>
			<td>{{ $item->id }}</td>
			<td>{{ $item->username }}</td>
			<td>{{ $item->email }}</td>
			<td>{{ $item->name }}</td>
			<td>{{ $item->created_at }}</td>
			<td>
				<p data-placement="top" data-toggle="tooltip" title="编辑">
					<button class="btn btn-primary btn-xs" data-title="编辑" data-toggle="modal" data-target="#edit">
						<span class="fa fa-pencil"></span>
					</button>
				</p>
			</td>
			<td>
				<p data-placement="top" data-toggle="tooltip" title="删除">
					<button class="btn btn-danger btn-xs" data-title="删除" data-toggle="modal" data-target="#delete">
						<span class="fa fa-trash"></span>
					</button>
				</p>
			</td>
		</tr>
	@endforeach
@stop
