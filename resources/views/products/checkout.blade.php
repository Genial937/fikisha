@extends('layouts.app')

@section('content')
    <checkout-component save-url="{{ route('checkout.store') }}"></checkout-component>
@endsection
