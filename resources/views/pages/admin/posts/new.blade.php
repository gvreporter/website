@extends('base.web')
@section('seo::title', 'Nuovo post')

@section('head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
    <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
@endsection

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
        <input type="text" name="name" placeholder="Nome articolo" required>
        <textarea name="article" id="editor"></textarea>
        <input type="submit" value="CREA">
    </form>


    <script>
        const editor = new SimpleMDE({ element: document.getElementById('editor'), placeholder: "Scrivi il tuo articolo qui...", spellChecker: false });
    </script>
@endsection