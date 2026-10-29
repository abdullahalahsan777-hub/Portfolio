@extends('errors.layout')

@section('code', '405')
@section('title', 'Method Not Allowed')
@section('category', 'Client Error')
@section('accent_color', '#a855f7')
@section('description', 'The HTTP method used (such as GET or POST) is not supported for that resource.')

@section('icon')
<svg class="w-8 h-8 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
</svg>
@endsection
