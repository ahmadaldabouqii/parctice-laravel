@extends("admin.layouts.inc.head")
@section("title", "login")
<div class="wrapper">
    <div class="logo">
        <img src="https://image.pngaaa.com/311/5315311-middle.png" alt="image">
    </div>
    <div class="text-center mt-4 name"> Login </div>
    <form class="mt-3" name="login" method="post" action="{{route('admin.login')}}">
        @csrf
        <div class="mt-4">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul style="padding: 0">
                        @foreach ($errors->all() as $error)
                            <li style="list-style-type: none">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="form-field d-flex align-items-center">
            <span class="far fa-user"></span>
            <input type="email" name="email" id="userName" placeholder="Email">
        </div>
        <div class="form-field d-flex align-items-center">
            <span class="fas fa-key"></span>
            <input type="password" name="password" id="pwd" placeholder="Password">
        </div>
        <button class="btn mt-3">Login</button>
    </form>
    <div class="text-center fs-6">
        <a href="#">Forget password?</a>
        or <a href="#">Sign up</a>
    </div>
</div>
@extends("admin.layouts.inc.bottom")
