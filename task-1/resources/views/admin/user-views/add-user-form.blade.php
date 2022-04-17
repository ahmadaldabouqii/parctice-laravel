@extends("admin.layouts.master")
@section("title", "add user")
@section("content")
        <div class="card">
            <div class="card-header text-center font-weight-bold">
                Add User
            </div>
            <div class="card-body">
                <form method="post" action="{{route('admin.user.register-form')}}" name="add-blog-post-form" id="add-blog-post-form" >
                    @csrf
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>User role:</label>
                        <select name="role" id="role" class="form-control">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" name="password" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="password">Confirm Password:</label>
                        <input type="password" name="password_confirmation" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Phone number:</label>
                        <input type="tel" name="phone_number" class="form-control"/>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
@endsection
