@extends('base.web')
@section('seo::title', 'Impostazioni account')

@section('app')
    Impostazioni
    <a href="{{ route('settings::delete') }}">Elimina accout</a>
@endsection