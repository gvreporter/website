@if (Auth::check())
    <div class="commentbox">
        @include('partials.profilepic', ['url' => Auth::user()->pic_url ])
        <div class="commentbox_form">
            <form action="{{ route('posts::comment', $post->slug) }}" method="POST">
                @csrf
                <input title="Commenta il post" id="commentbox" autocomplete="off" placeholder="Facci sapere la tua opinione" class="commentbox_input" name="comment" required>
                <button class="commentbox_btn commentbox_btn-hidden elevation_1" type="submit"><i data-feather="send"></i></button>
            </form>
        </div>
    </div>
@else
    <a href="{{ route('oauth::login') }}">Loggati</a> per poter commentare i post.
@endif