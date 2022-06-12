@extends('layouts.app')

@section('content')
    <cart-component cart-url="{{ route('cart.fetch') }}" shop-url="{{ route('products.index') }}"
        checkout-url="{{ route('checkout.index') }}"></cart-component>
@endsection
