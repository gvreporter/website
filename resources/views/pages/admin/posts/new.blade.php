@extends('base.web')
@section('seo::title', 'Nuovo post')

@section('head')
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
    <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script> --}}
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.48.4/codemirror.min.css"
  />
  <!-- Editor's Style -->
  <link rel="stylesheet" href="https://uicdn.toast.com/editor/latest/toastui-editor.min.css" />
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
        <input hidden type="text" name="name">

        <h1 contenteditable="true" data-edited="false" id="post-title">Scrivi qui il titolo</h1>
        <label for="post-cover">Copertina</label>
        <input type="file" name="cover" accept="image/png, image/jpeg" id="post-cover" required>
        <div id="editor"></div>
        <input type="submit" value="CREA">
    </form>

    <input type="file" style="display: none" id="file-chooser">


    @section('script')
        <script>
            /* const editor = new SimpleMDE({
                element: document.getElementById('editor'),
                placeholder: "Scrivi il tuo articolo qui...",
                spellChecker: false,
                toolbar: [
                    "bold", "italic", "heading", "|", "quote", "unordered-list", "ordered-list", "|", "link", "image",
                    {
                        name: "custom",
                        action: (editor) => {
                            
                        },
                        className: "fa fa-upload",
                        title: "Carica un immagine",
                    },
                    "|", "preview", "side-by-side", "fullscreen", "|", "guide",
                ]
            });     */
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