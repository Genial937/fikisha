@extends('layouts.app')

@section('content')
    <roles-component save-url="{{ route('roles.store') }}" fetch-url="{{ route('roles.fetch') }}"></roles-component>
@endsection
