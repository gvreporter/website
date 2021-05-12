@extends('base.web')
@section('seo::title', 'Home')

@section('app')
    

    <span id="title">Gobetti Volta Reporter</span>


    {{ $lastPost->title }}
    <br><br>
    @foreach ($posts as $post)
        {{ $post->title }}
    @endforeach
@endsection