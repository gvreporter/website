@extends('base.web')
@section('seo::title', 'Dashboard')

@section('app')
    Benvenuto {{ Auth::user()->name }}. Non sei tu? <a href="{{ route('logout') }}">sloggati</a>
    <br>
    @if (session()->has('approved_quote'))
        Lo sputo è stato approvato!
    @elseif (session()->has('removed_quote'))
        Lo sputo è stato rimosso!
    @endif
    @foreach ($approvingQuotes as $quote)
        {{ $quote->message }}
        <a href="{{ route('quotes::approve', $quote->id) }}">Approva</a>
        <a href="{{ route('quotes::remove', $quote->id) }}">Rimuovi</a>
        <br>
    @endforeach
@endsection