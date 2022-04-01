<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>dashboard - @yield("title")</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        jQuery(document).ready(function($){
            $("#menu-toggle").click(function(e) {
                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
            });
        })
    </script>
</head>
<body>
@include('sweetalert::alert')
    <div class="d-flex" id="wrapper">
        <div class="bg-light border-right" id="sidebar-wrapper">
            <div class="sidebar-heading">Task-1</div>
            <div class="list-group list-group-flush">
                <a href="{{route('user.add_user_form')}}" class="list-group-item list-group-item-action bg-light">Add User</a>
                <a href="{{route('category.add-category')}}" class="list-group-item list-group-item-action bg-light">Add Category</a>
                <a href="{{route('subCategory.add-sub-category')}}" class="list-group-item list-group-item-action bg-light">Add Sub Category</a>
                <a href="{{route('user.users')}}" class="list-group-item list-group-item-action bg-light">Users</a>
                <a href="{{route('category.categories')}}" class="list-group-item list-group-item-action bg-light">Categories</a>
                <a href="{{route('subCategory.sub-categories')}}" class="list-group-item list-group-item-action bg-light">Sub Categories</a>
            </div>
        </div>
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <button class="btn btn-primary" id="menu-toggle">Toggle Menu</button>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                        <li class="nav-item active">
                            <a class="nav-link" href="/">Home<span class="sr-only">(current)</span></a>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="container mt-4">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li style="list-style-type: none">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @yield("content")
            </div>
        </div>
    </div>
</body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('js/dangerAlert.js') }}"></script>
</html>
