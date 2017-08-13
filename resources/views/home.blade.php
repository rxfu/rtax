@extends('layouts.app')

@section('title', '政策文件')

@section('content')
<ul class="list-group">
	@php
		$i = 0
	@endphp
	@foreach ($policies as $policy)
		<li class="list-group-item">
			<span class="badge">{{ $policy->created_at->format('Y-m-d') }}</span>
			{{ ++$i }}.
			<a href="{{ asset('storage/' . $policy->pathname) }}" title="{{ $policy->name }}">{{ $policy->name }}</a> <i class="fa fa-download"></i>
		</li>
	@endforeach
</ul>
@stop