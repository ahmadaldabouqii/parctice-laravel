<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Register</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
              crossorigin="anonymous"
        />
    </head>
    <body>
    <div class="container mt-4">
        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li style="list-style-type: none">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card">
            <div class="card-header text-center font-weight-bold">
                Register as a user
            </div>
            <div class="card-body">
                <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="{{url('register-form')}}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" class="form-control" required="">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" class="form-control" required=""/>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" name="password" class="form-control" required=""/>
                    </div>
                    <div class="form-group">
                        <label for="password">Confirm Password:</label>
                        <input type="password" name="password_confirmation" class="form-control" required=""/>
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Phone number:</label>
                        <input type="tel" name="phone_number" class="form-control" required=""/>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
    </body>
</html>
