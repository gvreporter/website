@extends('base.web')
@section('seo::title', 'Conferma eliminazione account')

@section('app')
    Per confermare l'eliminazione del tuo account, per favore, scrivi il tuo nome e cognome ({{ Auth::user()->name }}) <br>

    @error('name')
        <span class="error-msg">{{ $message }}</span>
    @enderror


    <form action="{{ route('settings::delete') }}" method="POST">
        @csrf
        <input autocomplete="off" placeholder="Il tuo nome" type="text" name="name" required>
        <input type="submit" value="ELIMINA ACCOUNT">
    </form>
@endsection