@extends("layouts.master")
@section("title","welcome")
@section("content")
    @include("layouts.users-content")
    @include("layouts.categories-content")
    @include("layouts.sub-categories-content")
@stop
