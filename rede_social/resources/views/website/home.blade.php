@extends('website.index')

@section('content')

    @foreach($posts as $index => $post)

        @include('components.posts', ['post' => $post])

    @endforeach

@endsection