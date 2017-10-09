@extends('layouts.app')

@section('content')
<table id="datagrid" class="table table-striped">
	@yield('content')
</table>
@overwrite

@push('styles')
	<link href="{{ asset('css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/icheck/skins/all.css') }}" rel="stylesheet">
@endpush

@push('scripts')
	<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
	<script src="{{ asset('js/icheck.min.js') }}"></script>
	<script>
		$('#datagrid').dataTable({
			iDisplayLength: -1,
			lengthMenu: [
				[10, 25, 50, -1],
				[10, 25, 50, '全部']
			],
			language: {
				url: "{{ asset('js/i18n/Chinese.json') }}"
			}
		});
	</script>
@endpush