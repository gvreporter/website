@extends('base.web')
@section('seo::title', 'Nuovo utente')

@section('app')
<form action="{{route('users::new')}}" method="post">
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            {{$error}}
        @endforeach
    @endif
    @csrf
    <label for="name">Nome</label>
    <input type="text" name="name" id="name" autocomplete="off"><br>
    <label for="username">Nome utente</label>
    <input type="text" name="username" id="username" autocomplete="off"><br>
    <label for="role">Ruolo</label>
    <select name="role" id="role">
        <option value="admin">Admin</option>
        <option value="writer">Scrittore</option>
        <option value="user" selected>Utente</option>
    </select><br>
    <label for="googleid">Google ID</label>
    <input type="text" name="googleid" id="googleid" autocomplete="off"><br>
    <label for="profilepic">URL foto profilo</label>
    <input type="text" name="profilepic" id="profilepic" autocomplete="off"><br>
    <label for="password">Password</label>
    <input type="password" name="password" id="password" autocomplete="off"><br>
    <input type="submit" value="SALVA">
</form>
@endsection