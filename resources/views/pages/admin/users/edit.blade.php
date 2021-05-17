@extends('base.web')
@section('seo::title', 'Modifica @'.$user->username)

@section('app')
    <form action="{{route('users::edit', $user->id)}}" method="post">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                {{$error}}
            @endforeach
        @endif
        @csrf
        <label for="id">ID</label>
        <input type="text" name="id" id="id" autocomplete="off" disabled value="{{$user->id}}"><br>
        <label for="name">Nome</label>
        <input type="text" name="name" id="name" autocomplete="off" value="{{$user->name}}"><br>
        <label for="username">Nome utente</label>
        <input type="text" name="username" id="username" autocomplete="off" value="{{$user->username}}"><br>
        <label for="role">Ruolo</label>
        <select name="role" id="role">
            <option {{$user->role == 'admin' ? 'selected' : ''}} value="admin">Admin</option>
            <option {{$user->role == 'writer' ? 'selected' : ''}} value="writer">Scrittore</option>
            <option {{$user->role == 'user' ? 'selected' : ''}} value="user">Utente</option>
        </select><br>
        <label for="googleid">Google ID</label>
        <input type="text" name="googleid" id="googleid" autocomplete="off" value="{{$user->google_id}}"><br>
        <label for="profilepic">URL foto profilo</label>
        <input type="text" name="profilepic" id="profilepic" autocomplete="off" value="{{$user->profile_pic_url}}"><br>
        <input type="submit" value="SALVA">
    </form>
@endsection