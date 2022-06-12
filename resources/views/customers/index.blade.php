@extends('layouts.app')

@section('content')
    <customers-component fetch-url="{{ route('customers.fetch') }}"></customers-component>
@endsection
