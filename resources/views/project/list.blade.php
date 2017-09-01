@extends('layouts.list')

@section('title', '项目列表')

@section('content')
<thead>
	<tr>
		<th>ID</th>
		<th>项目名称</th>
		<th>建设方</th>
		<th>建设方纳税人识别号</th>
		<th>路基标数量</th>
		<th>路面标数量</th>
		<th>总投资额</th>
		<th>总里程数</th>
		<th>工程地址</th>
		<th>开工时间</th>
		<th>完工时间</th>
		<th>主管税务机关</th>
		<th>主管税务分局</th>
		<th>财务负责人</th>
		<th>财务负责人联系电话</th>
		<th>编辑</th>
		<th>删除</th>
	</tr>
</thead>

<tbody>
	@foreach ($projects as $project)
		<tr>
			<td>{{ $project->id }}</td>
			<td>{{ $project->name }}</td>
			<td>{{ $project->building }}</td>
			<td>{{ $project->building_number }}</td>
			<td>{{ $project->roadbed_amount }}</td>
			<td>{{ $project->road_amount }}</td>
			<td>{{ $project->investment }}</td>
			<td>{{ $project->kilometre }}</td>
			<td>{{ $project->address }}</td>
			<td>{{ $project->begtime }}</td>
			<td>{{ $project->endtime }}</td>
			<td>{{ $project->authority }}</td>
			<td>{{ $project->bureau }}</td>
			<td>{{ $project->finance }}</td>
			<td>{{ $project->finance_phone }}</td>
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
		<td colspan="17">
			<a href="{{ route('project.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> 新增</a>
		</td>
	</tr>
</tfoot>
@stop
