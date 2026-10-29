@extends('errors.layout')

@section('code', '408')
@section('title', 'Request Timeout')
@section('category', 'Client Error')
@section('accent_color', '#f97316')
@section('description', "The server timed out waiting for the browser's request.")

@section('icon')
<svg class="w-8 h-8 text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
</svg>
@endsection
