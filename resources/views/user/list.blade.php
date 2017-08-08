@section('title', '用户列表')

@component('pages.list', ['items' => $users])
	@slot('head')
		<th>ID</th>
		<th>用户名</th>
		<th>Email</th>
		<th>真实姓名</th>
		<th>创建时间</th>
		<th>编辑</th>
		<th>删除</th>
	@endslot
@endcomponent

@section('item')
	<td>{{ $item->id }}</td>
@stop