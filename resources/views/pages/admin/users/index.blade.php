@extends('base.web')
@section('seo::title', 'Utenti')

@section('app')
    @if (session()->has('users_edit'))
        L'utente è stato aggiornato con successo!
    @elseif (session()->has('users_store'))
        L'utente è stato creato con successo!
    @endif
    <a href="{{route('users::new')}}"><button type="button" class="login_form_submit elevation_1 elevation_anim elevation_anim_2">Crea utente</button></a>
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Nome</th>
            <th>Ruolo</th>
            <th>Azioni</th>
        </tr>
        @foreach ($users as $user)
            <tr>
                <th>{{$user->id}}</th>
                <th>{{$user->username}}</th>
                <th>{{$user->name}}</th>
                <th>{{$user->role}}</th>
                <th><a href="{{route('users::edit', $user->id)}}">Modifica</a></th>
            </tr>
        @endforeach
    </table>
@endsection