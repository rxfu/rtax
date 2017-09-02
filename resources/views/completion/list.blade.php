@extends('layouts.list')

@section('title', '完工比例列表')

@section('content')
<thead>
	<tr>
		<th>ID</th>
		<th>项目名称</th>
		<th>标段类型</th>
		<th>标段名称</th>
		<th>改革前完工比例</th>
		<th>改革后完工比例</th>
		<th>创建者</th>
		<th>编辑</th>
		<th>删除</th>
	</tr>
</thead>

<tbody>
	@foreach ($completions as $completion)
		<tr>
			<td>{{ $completion->id }}</td>
			<td>{{ $completion->section->project->name }}</td>
			<td>{{ $completion->section->type->name }}</td>
			<td>{{ $completion->section->name }}</td>
			<td>{{ $completion->completion_before }}%</td>
			<td>{{ $completion->completion_after }}%</td>
			<td>{{ $completion->user->username }}({{ $completion->user->name }})</td>
			<td>
				<p data-placement="top" data-toggle="tooltip" title="编辑">
					<a href="{{ route('completion.edit', $completion->id) }}" class="btn btn-primary btn-xs" role="button">
						<span class="fa fa-pencil"></span>
					</a>
				</p>
			</td>
			<td>
				<p data-placement="top" data-toggle="tooltip" title="删除">
					<a href="#" class="btn btn-danger btn-xs" role="button" onclick="confirm('你确定要删除这条记录？') ? document.getElementById('delete-{{ $completion->id }}-form').submit() : false">
						<span class="fa fa-trash"></span>
					</a>
					<form id="delete-{{ $completion->id }}-form" method="post" action="{{ route('completion.delete', $completion->id) }}" style="display: none">
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
			<a href="{{ route('completion.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> 新增</a>
		</td>
	</tr>
</tfoot>
@stop
