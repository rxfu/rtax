@extends('layouts.app')

@section('title', '用户列表')

@section('content')
<table id="datagrid" class="table table-striped bulk_action">
	<thead>
		<tr>
			<th>
				<input type="checkbox" id="chec-kall" name="checkall" class="flat">
			</th>
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
		@foreach ($users as $user)
		<tr>
			<td>
				<input type="checkbox" id="check-all" name="checkthis" class="flat">
			</td>
			<td>{{ $user->id }}</td>
			<td>{{ $user->username }}</td>
			<td>{{ $user->email }}</td>
			<td>{{ $user->name }}</td>
			<td>{{ $user->created_at }}</td>
			<td>
				<p data-placement="top" data-toggle="tooltip" title="编辑">
					<button class="btn btn-primary btn-xs" data-title="编辑" data-toggle="modal" data-target="#edit">
						<span class="glyphicon glyphicon-pencil"></span>
					</button>
				</p>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
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
		$('#datagrid').dataTable({
			"language": {
				"url": "{{ asset('js/i18n/Chinese.json') }}"
			}
		});
	</script>
@endpush