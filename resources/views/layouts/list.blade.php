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
			language: {
				url: "{{ asset('js/i18n/Chinese.json') }}"
			}
		});
	</script>
@endpush