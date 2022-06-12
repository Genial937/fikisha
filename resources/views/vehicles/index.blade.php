@extends('layouts.app')

@section('content')
    <vehicles-component save-url="{{ route('vehicles.store') }}" fetch-url="{{ route('vehicles.fetch') }}"
        delete-url="{{ route('vehicles.destroy', 'id') }}" update-url="{{ route('vehicles.update', 'id') }}">
    </vehicles-component>
@endsection
