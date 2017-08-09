@extends('layouts.app')

@section('content')
<table id="datagrid" class="table table-striped bulk_action">
	<thead>
		<tr>
			<th>
				<input type="checkbox" id="check-all" name="checkall" class="flat">
			</th>
			@yield('thead')
		</tr>
	</thead>

	<tbody>
		@yield('tbody')
	</tbody>
</table>
@stop

@push('styles')
	<link href="{{ asset('css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/buttons.bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/icheck/skins/all.css') }}" rel="stylesheet">
@endpush

@push('scripts')
	<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
	<script src="{{ asset('js/dataTables.buttons.min.js') }}"></script>
	<script src="{{ asset('js/buttons.bootstrap.min.js') }}"></script>
	<script src="{{ asset('js/buttons.flash.min.js') }}"></script>
	<script src="{{ asset('js/buttons.html5.min.js') }}"></script>
	<script src="{{ asset('js/buttons.print.min.js') }}"></script>
	<script src="{{ asset('js/icheck.min.js') }}"></script>
	<script>
		$('#datagrid').dataTable({
			dom: 'Bfrtip',
			buttons: [{
				text: '新增',
				action: function(e, dt, node, config) {
					dt.ajax('add');
				}
			}]
			language: {
				url: "{{ asset('js/i18n/Chinese.json') }}"
			}
		});
	</script>
@endpush