@extends('errors.layout')

@section('code', '403')
@section('title', 'Forbidden')
@section('category', 'Client Error')
@section('accent_color', '#f43f5e')
@section('description', 'The server refuses to give the content because the user lacks permission.')

@section('icon')
<svg class="w-8 h-8 text-rose-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
</svg>
@endsection
