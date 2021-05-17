@extends('base.web')
@section('seo::title', 'Utenti')

@section('app')
    @if (session()->has('users_edit'))
        L'utente è stato aggiornato con successo!
    @endif
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