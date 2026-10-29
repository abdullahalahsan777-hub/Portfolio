@extends('errors.layout')

@section('code', '504')
@section('title', 'Gateway Timeout')
@section('category', 'Server Error')
@section('accent_color', '#e11d48')
@section('description', 'The server took too long to get a response from an upstream server or database.')

@section('icon')
<svg class="w-8 h-8 text-rose-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
</svg>
@endsection
