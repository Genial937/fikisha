@extends('layouts.app')

@section('content')
    <users-component save-url="{{ route('users.store') }}" fetch-url="{{ route('users.fetch') }}"></users-component>
@endsection
