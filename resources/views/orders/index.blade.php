@extends('layouts.app')

@section('content')
    <orders-component fetch-url="{{ route('orders.fetch') }}" vehicles-url="{{ route('vehicles.fetch') }}"
        update-url="{{ route('orders.update', 'id') }}" details-url="{{ route('order.details', 'id') }}">
    </orders-component>
@endsection
