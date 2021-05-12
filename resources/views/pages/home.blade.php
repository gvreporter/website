@extends('base.web')
@section('seo::title', 'Home')

@section('app')
    

    @include('navigation.big-nav')


    {{ $lastPost->title }}
    <br><br>
    @foreach ($posts as $post)
        {{ $post->title }}
    @endforeach
@endsection