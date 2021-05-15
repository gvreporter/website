@php
    $url = route('posts::show', $post->slug);
    $primary = $primary ?? false;
@endphp

<article class="post{{ $primary ? " post-primary" : "" }}">
    <a href="{{ $url }}" title="Vai all'articolo">
        <div class="post_img" style="background-image: url({{ $post->cover_url }})"></div>
    </a>
    <div class="post_info">
        <a href="{{ $url }}" title="Vai all'articolo"><span class="post_title">{{ $post->title }}</span></a>
        @if(Auth::check() && Auth::user()->can('role', 'writer'))
            <span class="post_author">{{ $post->views }} views</span>
        @endif
        <span class="post_author">Articolo di {{ $post->author->name }}</span>
        <span class="post_publishedat">Pubblicato il {{ $post->localized_date }}</span>
    </div>
</article>  