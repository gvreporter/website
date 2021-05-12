@extends('base.web')
@section('seo::title', 'Home')

@section('app')
    

    @include('navigation.big-nav')


    {{ $lastPost->title }}
    <br><br>
    @foreach ($posts as $post)
        @include('partials.post-tile')
    @endforeach
@endsection