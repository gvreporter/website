@extends('base.web')
@section('seo::title', 'Home')

@section('nav')
    @include('navigation.big-nav')
@endsection

@section('app')
    @include('partials.post-tile', ['post' => $lastPost, 'primary' => true])
    <div class="list">
        @foreach ($posts as $post)
            @include('partials.post-tile')
        @endforeach
    </div>
@endsection