@extends('base.web')
@section('seo::title', 'Home')

@section('nav')
    @include('navigation.big-nav')

    <div class="quotes-bar">
        <div class="quotes-bar_container">
            <div class="quotes">
                Ultimi sputi: 
                @foreach ($quotes as $quote)
                    <span class="quote">
                        <span class="quote_message">{{ $quote->message }}</span> - {{ $quote->time_ago }}
                    </span>
                    @endforeach
                </div>
                <div class="quotes">
                Ultimi sputi: 
                @foreach ($quotes as $quote)
                    <span class="quote">
                        <span class="quote_message">{{ $quote->message }}</span> - {{ $quote->time_ago }}
                    </span>
                @endforeach
            </div>
        </div>
    </div>

@endsection

@section('app')

    <form action="{{ route('quotes') }}" method="post">
        @csrf
        <input type="text" name="message">
        <input type="submit" value="SPUTA">
    </form>

    @include('partials.post-tile', ['post' => $lastPost, 'primary' => true])
    <div class="list">
        @foreach ($posts as $post)
            @include('partials.post-tile')
        @endforeach
    </div>
@endsection