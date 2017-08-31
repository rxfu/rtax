@extends('layouts.list')

@section('title', '用户列表')

@section('content')
<thead>
	<tr>
		<th>ID</th>
		<th>用户名</th>
		<th>所在单位</th>
		<th>真实姓名</th>
		<th>联系电话</th>
		<th>身份</th>
		<th>创建时间</th>
		<th>编辑</th>
		<th>删除</th>
		<th>重置密码</th>
	</tr>
</thead>

<tbody>
	@foreach ($users as $user)
		<tr>
			<td>{{ $user->id }}</td>
			<td>{{ $user->username }}</td>
			<td>{{ $user->department->name }}</td>
			<td>{{ $user->name }}</td>
			<td>{{ $user->phone }}</td>
			<td>{{ $user->is_admin ? '系统管理员' : '普通用户' }}</td>
			<td>{{ $user->created_at }}</td>
			<td>
				<p data-placement="top" data-toggle="tooltip" title="编辑">
					<a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary btn-xs" role="button">
						<span class="fa fa-pencil"></span>
					</a>
				</p>
			</td>
			<td>
				<p data-placement="top" data-toggle="tooltip" title="删除">
					<a href="#" class="btn btn-danger btn-xs" role="button" onclick="confirm('你确定要删除这条记录？') ? document.getElementById('delete-{{ $user->id }}-form').submit() : false">
						<span class="fa fa-trash"></span>
					</a>
					<form id="delete-{{ $user->id }}-form" method="post" action="{{ route('user.delete', $user->id) }}" style="display: none">
						{{ method_field('delete') }}
						{{ csrf_field() }}
					</form>
				</p>
			</td>
			<td>
				<p data-placement="top" data-toggle="tooltip" title="重置密码">
					<a href="{{ route('user.rstpwd', $user->id) }}" class="btn btn-warning btn-xs" role="button">
						<span class="fa fa-unlock-alt"></span>
					</a>
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
