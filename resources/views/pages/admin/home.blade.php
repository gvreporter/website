@extends('base.web')
@section('seo::title', 'Dashboard')

@section('app')
    Benvenuto {{ Auth::user()->name }}. Non sei tu? <a href="{{ route('logout') }}">sloggati</a>
@endsection