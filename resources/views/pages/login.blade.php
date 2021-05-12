@extends('base.web')
@section('seo::title', 'Login')

@section('app')
    <form action="{{ route('login') }}" method="post">
        @csrf
        <input type="username" placeholder="Username" name="username" value="{{ old('username') }}" required />
        <input type="password" placeholder="Password" name="password" required />
        @error('password')
            {{ $message }}
        @enderror
        <input type="submit" value="LOGIN">
    </form>
@endsection