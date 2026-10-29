@extends('errors.layout')

@section('code', '429')
@section('title', 'Too Many Requests')
@section('category', 'Client Error')
@section('accent_color', '#eab308')
@section('description', 'The user has sent too many requests in a given amount of time (rate-limited).')

@section('icon')
<svg class="w-8 h-8 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
</svg>
@endsection
