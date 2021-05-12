@extends('base.web')
@section('seo::title')
Errore @yield('error::code')
@endsection

@section('app')
    <h1>Errore @yield('error::code')</h1>
    <p>@yield('error::desc')</p>
@endsection