@extends("admin.layouts.inc.head")
    <div class="d-flex" id="wrapper">
        <div class="bg-light border-right" id="sidebar-wrapper">
            <div class="sidebar-heading">Task-1</div>
            <div class="list-group list-group-flush">
                <a href="{{route('admin.user.add_user_form')}}" class="list-group-item list-group-item-action bg-light">Add User</a>
                <a href="{{route('admin.category.add-category')}}" class="list-group-item list-group-item-action bg-light">Add Category</a>
                <a href="{{route('admin.subCategory.add-sub-category')}}" class="list-group-item list-group-item-action bg-light">Add Sub Category</a>
                <a href="{{route('admin.user.users')}}" class="list-group-item list-group-item-action bg-light">Users</a>
                <a href="{{route('admin.category.categories')}}" class="list-group-item list-group-item-action bg-light">Categories</a>
                <a href="{{route('admin.subCategory.sub-categories')}}" class="list-group-item list-group-item-action bg-light">Sub Categories</a>
            </div>
        </div>
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <button class="btn btn-secondary" id="menu-toggle"><i class="fa-solid fa-bars"></i></button>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                        <li class="nav-item active">
                            <form id="logout-form" action="{{ route('admin.logout') }}" method="post">
                                @csrf
                                <button class="dropdown-item" type="submit">logout</button>
                            </form>
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
@extends("admin.layouts.inc.bottom")
