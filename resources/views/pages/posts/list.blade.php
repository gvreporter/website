@extends('base.web')
@section('seo::title', 'Articoli')

@section('app')
    @foreach ($posts as $post)
        <a href="{{ route('posts::show', $post->slug) }}">{{ $post->title }}</a><br>
    @endforeach 
@endsection