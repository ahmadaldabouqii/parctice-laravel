@extends("layouts.master")
@section("title","welcome")

@section("content")
    @foreach(
            [
               'user-views.users',
               'category-views.categories',
               'subCategory-views.sub-categories'
            ] as $view)
        @include($view)
    @endforeach
@endsection
