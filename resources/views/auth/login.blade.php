@extends('layouts.auth')

@section('content')
    <login-component login-url="{{ route('login.store') }}" home-url="{{ route('index') }}"></login-component>
@endsection
