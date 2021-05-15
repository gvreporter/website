@extends('base.web')
@section('seo::title', 'Login')

@section('app')
    <div class="login">
        <div class="login_container">
            <h3 class="login_title">Accedi</h3>
            <div class="login_subtitle">Inserisci le tue credenziali da staff</div>
            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="login_form">
                    <input
                        class="login_form_field"
                        type="text"
                        name="username"
                        required="true"
                        autofocus="true"
                        autocomplete="username"
                        placeholder="Username"
                        value="{{ old('username') }}"
                    />
                    <input
                        class="login_form_field"
                        type="password"
                        name="password"
                        required="true"
                        placeholder="Password"
                        autocomplete="current-password"
                    />
                    <button type="submit" class="login_form_submit elevation_1 elevation_anim elevation_anim_2">Login</button>
                </div>

                @error('password')
                    {{ $message }}
                @enderror
            </form>
            <span>Non fai parte dello staff? Clicca <a href="{{ route('oauth::login') }}">qui</a>.</span>
        </div>
    </div>
@endsection