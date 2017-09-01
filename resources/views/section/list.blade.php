@extends('layouts.list')

@section('title', '标段列表')

@section('content')
<thead>
	<tr>
		<th>ID</th>
		<th>所属项目</th>
		<th>标段类型</th>
		<th>标段名称</th>
		<th>建设方</th>
		<th>施工方</th>
		<th>投资额</th>
		<th>里程数</th>
		<th>工程地址</th>
		<th>开工时间</th>
		<th>完工时间</th>
		<th>主管税务机关</th>
		<th>主管税务分局</th>
		<th>财务负责人</th>
		<th>财务负责人联系电话</th>
		<th>开户银行</th>
		<th>开户行名称</th>
		<th>开户行账号</th>
		<th>编辑</th>
		<th>删除</th>
	</tr>
</thead>

<tbody>
	@foreach ($sections as $section)
		<tr>
			<td>{{ $section->id }}</td>
			<td>{{ $section->project->name }}</td>
			<td>{{ $section->type->name }}</td>
			<td>{{ $section->name }}</td>
			<td>{{ $section->building }}</td>
			<td>{{ $section->constructor }}</td>
			<td>{{ $section->investment }}</td>
			<td>{{ $section->kilometre }}</td>
			<td>{{ $section->address }}</td>
			<td>{{ $section->begtime }}</td>
			<td>{{ $section->endtime }}</td>
			<td>{{ $section->authority }}</td>
			<td>{{ $section->bureau }}</td>
			<td>{{ $section->finance }}</td>
			<td>{{ $section->finance_phone }}</td>
			<td>{{ $section->bank }}</td>
			<td>{{ $section->bank_name }}</td>
			<td>{{ $section->bank_account }}</td>
			<td>
				<p data-placement="top" data-toggle="tooltip" title="编辑">
					<a href="{{ route('section.edit', $section->id) }}" class="btn btn-primary btn-xs" role="button">
						<span class="fa fa-pencil"></span>
					</a>
				</p>
			</td>
			<td>
				<p data-placement="top" data-toggle="tooltip" title="删除">
					<a href="#" class="btn btn-danger btn-xs" role="button" onclick="confirm('你确定要删除这条记录？') ? document.getElementById('delete-{{ $section->id }}-form').submit() : false">
						<span class="fa fa-trash"></span>
					</a>
					<form id="delete-{{ $section->id }}-form" method="post" action="{{ route('section.delete', $section->id) }}" style="display: none">
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
		<td colspan="18">
			<a href="{{ route('section.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> 新增</a>
		</td>
	</tr>
</tfoot>
@stop
