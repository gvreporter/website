<div class="comment">
    <div class="comment_author">
        @include('partials.profilepic', ['url' => $comment->author->pic_url ])
        <span class="comment_author_name">{{ $comment->author->name }}</span>

        {{-- Badges --}}
        @if ($comment->author->can('role', 'admin'))
            <span class="comment_author_badge" title="Admin del sito">ADMIN</span>
        @elseif ($comment->author->can('role', 'writer'))
            <span class="comment_author_badge" title="Scrittore di articoli">SCRITTORE</span>
        @endif
        @if ($comment->author->id == $post->user_id)
            <span class="comment_author_badge" title="Autore del post">OP</span>
        @endif

    </div>
    <div class="comment_content">
        {{ $comment->content }}
    </div>
</div>