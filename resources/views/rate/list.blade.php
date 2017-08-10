@extends('layouts.list')

@section('title', '税率列表')

@section('content')
<thead>
	<tr>
		<th>ID</th>
		<th>税种</th>
		<th>资源税改革标记</th>
		<th>税目</th>
		<th>计量单位</th>
		<th>税率</th>
		<th>编辑</th>
		<th>删除</th>
	</tr>
</thead>

<tbody>
	@foreach ($rates as $rate)
		<tr>
			<td>{{ $rate->id }}</td>
			<td>{{ $rate->category }}</td>
			<td>{{ $rate->flag }}</td>
			<td>{{ $rate->name }}</td>
			<td>{{ $rate->unit }}</td>
			<td>{{ $rate->rate }}</td>
			<td>
				<p data-placement="top" data-toggle="tooltip" title="编辑">
					<a href="{{ route('rate.edit', $rate->id) }}" class="btn btn-primary btn-xs" role="button">
						<span class="fa fa-pencil"></span>
					</a>
				</p>
			</td>
			<td>
				<p data-placement="top" data-toggle="tooltip" title="删除">
					<a href="#" class="btn btn-danger btn-xs" role="button" onclick="confirm('你确定要删除这条记录？') ? document.getElementById('delete-{{ $rate->id }}-form').submit() : false">
						<span class="fa fa-trash"></span>
					</a>
					<form id="delete-{{ $rate->id }}-form" method="post" action="{{ route('rate.delete', $rate->id) }}" style="display: none">
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
		<td colspan="7">
			<a href="{{ route('rate.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> 新增</a>
		</td>
	</tr>
</tfoot>
@stop
