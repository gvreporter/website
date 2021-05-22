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
        @include('partials.comment-box')

        @if ($comments)
            <div class="comments-list">
                @foreach ($comments as $comment)
                    @include('partials.comment')
                @endforeach
            </div>
        @endif
    </div>
@endsection