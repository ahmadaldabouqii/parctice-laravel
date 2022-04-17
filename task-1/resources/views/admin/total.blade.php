@extends("admin.layouts.master")
@section("title","welcome")
@section("content")
    @include("admin.layouts.users-content")
    @include("admin.layouts.categories-content")
    @include("admin.layouts.sub-categories-content")
@stop
