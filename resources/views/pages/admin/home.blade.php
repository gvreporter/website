@extends('base.web')
@section('seo::title', 'Dashboard')

@section('app')
    Benvenuto {{ Auth::user()->name }}
@endsection