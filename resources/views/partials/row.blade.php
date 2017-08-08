<tr>
	<td>
		<input type="checkbox" id="check-all" name="checkthis" class="flat">
	</td>
	@yield('item')
	<td>
		<p data-placement="top" data-toggle="tooltip" title="编辑">
			<button class="btn btn-primary btn-xs" data-title="编辑" data-toggle="modal" data-target="#edit">
				<span class="glyphicon glyphicon-pencil"></span>
			</button>
		</p>
	</td>
	<td>
		<p data-placement="top" data-toggle="tooltip" title="删除">
			<button class="btn btn-danger btn-xs" data-title="删除" data-toggle="modal" data-target="#delete">
				<span class="glyphicon glyphicon-trash"></span>
			</button>
		</p>
	</td>
</tr>