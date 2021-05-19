@extends('base.web')
@section('seo::title', 'Dashboard')

@section('app')
    Benvenuto {{ Auth::user()->name }}. Non sei tu? <a href="{{ route('logout') }}">sloggati</a>
    <div class="dash">
        <fieldset>
            <legend>Sputi</legend>
            @if (count($approvingQuotes) == 0)
                Nessuno sputo da approvare
            @endif
            @foreach ($approvingQuotes as $quote)
                {{ $quote->message }}
                <a href="{{ route('quotes::approve', $quote->id) }}">Approva</a>
                <a href="{{ route('quotes::remove', $quote->id) }}">Rimuovi</a>
                <br>
            @endforeach
        </fieldset>
        <fieldset>
            <legend>Utenti</legend>
            <a href="{{ route('users::new') }}">Crea</a>
            <br>
            @foreach ($users as $user)
                {{ $user->name }}
                <a href="{{ route('users::edit', $user->id) }}">Modifica</a>
                <br>
            @endforeach
        </fieldset>
        <fieldset>
            <legend>Articoli</legend>
            <a href="{{ route('posts::new') }}">Nuovo</a><br>
            @foreach ($posts as $post)
                {{ $post ->title }} <br>
            @endforeach
        </fieldset>
    </div>

    @section('script')
        <script>
            @if (session()->has('approved_quote'))
                toastr.success('Lo sputo è stato approvato correttamente', 'Approvato!');
            @elseif (session()->has('removed_quote'))
                toastr.success('Lo sputo è stato rimosso correttamente', 'Rimosso!');
            @endif
        </script>
    @endsection
@endsection