@extends('base.web')
@section('seo::title', $post->title)

@section('app')
    @markdown($post->contents())
@endsection