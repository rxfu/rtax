@extends('layouts.list')

@section('title', '标段列表')

@section('content')
<thead>
	<tr>
		<th>ID</th>
		<th>项目名称</th>
		<th>标段名称</th>
		<th>标段类型</th>
		<th>编辑</th>
		<th>删除</th>
	</tr>
</thead>

<tbody>
	@foreach ($projects as $project)
		<tr>
			<td>{{ $project->id }}</td>
			<td>{{ $project->project_name }}</td>
			<td>{{ $project->lot_name }}</td>
			<td>{{ $project->lot_type }}</td>
			<td>
				<p data-placement="top" data-toggle="tooltip" title="编辑">
					<a href="{{ route('project.edit', $project->id) }}" class="btn btn-primary btn-xs" role="button">
						<span class="fa fa-pencil"></span>
					</a>
				</p>
			</td>
			<td>
				<p data-placement="top" data-toggle="tooltip" title="删除">
					<a href="#" class="btn btn-danger btn-xs" role="button" onclick="confirm('你确定要删除这条记录？') ? document.getElementById('delete-{{ $project->id }}-form').submit() : false">
						<span class="fa fa-trash"></span>
					</a>
					<form id="delete-{{ $project->id }}-form" method="post" action="{{ route('project.delete', $project->id) }}" style="display: none">
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
		<td colspan="6">
			<a href="{{ route('project.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> 新增</a>
		</td>
	</tr>
</tfoot>
@stop
