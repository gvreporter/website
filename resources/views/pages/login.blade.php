@extends('base.web')
@section('seo::title', 'Login')

@section('app')
    <div class="login">
        <div class="login_container">
            <h3>Accedi</h3>
            <span>Inserisci le tue credenziali da staff</span>
            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="login_form">
                    <input 
                        class="login_form_field"
                        type="text"
                        autocomplete="username"
                        placeholder="Username"
                        name="username"
                        value="{{ old('username') }}"
                        required
                    />
                    <input
                        class="login_form_field"
                        type="password"
                        autocomplete="current-password"
                        placeholder="Password"
                        name="password"
                        required
                    />
                </div>
                @error('password')
                    {{ $message }}
                @enderror
                <input type="submit" value="LOGIN">
            </form>
            <span>Non fai parte dello staff? Loggati <a href="{{ route('oauth::login') }}">qui</a> con il tuo account istituzionale</span>
        </div>
    </div>
@endsection