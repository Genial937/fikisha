@extends('layouts.app')

@section('content')
    <dashboard-component stats-url="{{ route('fetch.stats') }}" user-role="{{ $role }}"></dashboard-component>
@endsection
