@extends('layouts.app')

@section('content')
    <products-component save-url="{{ route('products.store') }}" fetch-url="{{ route('products.fetch') }}"
        cart-url="{{ route('cart.add') }}" user-role="{{ $role }}">
    </products-component>
@endsection
