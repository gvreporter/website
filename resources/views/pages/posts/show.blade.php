@extends('base.web')
@section('seo::title', $post->title)

@section('app')
    <h1>{{ $post->title }}</h1>
    <div>Articolo di {{ $post->author->name }}</div>
    <span>Pubblicato il {{ $post->localized_date }}</span>
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
            <div class="comments-list">
                @foreach ($comments as $comment)
                    @include('partials.comment')
                @endforeach
            </div>
        @endif
    </div>
@endsection