@extends('base.web')
@section('seo::title', 'Nuovo post')

@section('app')
    <form action="{{ route('posts::new') }}" method="post">
        @csrf
        @if($errors->any())
            Si sono verificati degli errori
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <input type="text" name="name" placeholder="Nome articolo">
        <input type="submit" value="CREA">
    </form>
@endsection