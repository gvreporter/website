<article class="post">
    <div class="post_img" style="background-image: url({{ $post->cover_url }})"></div>
    <div class="post_info">
        <span class="post_title">{{ $post->title }}</span>
        <span class="post_author">Articolo di {{ $post->author->name }}</span>
        <span class="post_publishedat">Pubblicato il {{ $post->localized_date }}</span>
    </div>
</article>  