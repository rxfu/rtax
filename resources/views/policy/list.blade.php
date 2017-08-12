@extends('layouts.list')

@section('title', '政策文件列表')

@section('content')
<thead>
	<tr>
		<th>ID</th>
		<th>政策文件</th>
		<th>编辑</th>
		<th>删除</th>
	</tr>
</thead>

<tbody>
	@foreach ($policies as $policy)
		<tr>
			<td>{{ $policy->id }}</td>
			<td>
				<a href="{{ asset('storage/' . $policy->pathname) }}" title="{{ $policy->name }}">{{ $policy->name }}</a> <i class="fa fa-download"></i>
			</td>
			<td>
				<p data-placement="top" data-toggle="tooltip" title="编辑">
					<a href="{{ route('policy.edit', $policy->id) }}" class="btn btn-primary btn-xs" role="button">
						<span class="fa fa-pencil"></span>
					</a>
				</p>
			</td>
			<td>
				<p data-placement="top" data-toggle="tooltip" title="删除">
					<a href="#" class="btn btn-danger btn-xs" role="button" onclick="confirm('你确定要删除这条记录？') ? document.getElementById('delete-{{ $policy->id }}-form').submit() : false">
						<span class="fa fa-trash"></span>
					</a>
					<form id="delete-{{ $policy->id }}-form" method="post" action="{{ route('policy.delete', $policy->id) }}" style="display: none">
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
		<td colspan="4">
			<a href="{{ route('policy.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> 新增</a>
		</td>
	</tr>
</tfoot>
@stop
