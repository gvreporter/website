@extends('base.web')
@section('seo::title', $post->title)

@section('app')
    <article class="post-content">
        @markdown($post->contents())
    </article>
    <h2>Commenti</h2>
    <div class="comments">
        @if (session()->has('comment_status'))
            Il tuo commento è stato pubblicato correttamente!
        @endif
        @if (Auth::check())
            <form action="{{ route('posts::comment', $post->slug) }}" method="post">
                @csrf
                <input type="text" name="comment" required>
                <input type="submit" value="COMMENTA">
            </form>
        @else
            <a href="{{ route('oauth::login') }}">Loggati</a> per poter commentare i post.
        @endif
        @if ($comments)
            @foreach ($comments as $comment)
                {{ $comment->content }} <br>
            @endforeach
        @endif
    </div>
@endsection