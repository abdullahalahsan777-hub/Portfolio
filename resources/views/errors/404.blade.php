@extends('errors.layout')

@section('code', '404')
@section('title', 'Not Found')
@section('category', 'Client Error')
@section('accent_color', '#0090e7')
@section('description', 'The server cannot find the requested page or URL.')

@section('icon')
<svg class="w-8 h-8 text-[#0090e7]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
</svg>
@endsection
