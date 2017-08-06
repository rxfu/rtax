@extends('layouts.app')

@section('title', '用户列表')

@section('content')
<table id="list" class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>ID</th>
			<th>用户名</th>
			<th>Email</th>
			<th>真实姓名</th>
			<th>创建时间</th>
		</tr>
	</thead>

	<tbody>
		@foreach ($users as $user)
		<tr>
			<td>{{ $user->id }}</td>
			<td>{{ $user->username }}</td>
			<td>{{ $user->email }}</td>
			<td>{{ $user->name }}</td>
			<td>{{ $user->created_at }}</td>
		</tr>
		@endforeach
	</tbody>
</table>
@stop

@push('styles')
	<link href="{{ asset('css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
@endpush

@push('scripts')
	<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
	<script>
		$('#list').dataTable({
			"language": {
				"url": "{{ asset('js/i18n/Chinese.json') }}"
			}
		});
	</script>
@endpush