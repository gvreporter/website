@extends('base.web')
@section('seo::title', 'Nuovo post')

@section('head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
    <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
@endsection

@section('app')
    <form action="{{ route('posts::new') }}" method="post" onsubmit="return postSubmitter()">
        @csrf
        @if($errors->any())
            Si sono verificati degli errori
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <h1 contenteditable="true" data-edited="false" id="post-title">Scrivi qui il titolo</h1>
        <input hidden type="text" name="name">
        <input type="text" name="cover" placeholder="URL copertina" required>
        <textarea name="article" id="editor"></textarea>
        <input type="submit" value="CREA">
    </form>


    @section('script')
        <script>
            const editor = new SimpleMDE({ element: document.getElementById('editor'), placeholder: "Scrivi il tuo articolo qui...", spellChecker: false });    
            const $title = $('#post-title');
            const $name = $('input[name=name]');

            $title.on('click', function () {
                if($title.data('edited') == false) {
                    $title.text('');
                    $title.data('edited', true);
                }
            });

            function postSubmitter() {
                $name.val($title.text());
                return true;
            }
        </script>
    @endsection
@endsection