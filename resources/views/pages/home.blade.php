@extends('base.web')
@section('seo::title', 'Home')

@section('app')
    GV Reporter
    {{ $lastPost->title }}
    <br><br>
    @foreach ($posts as $post)
        {{ $post->title }}
    @endforeach
@endsection