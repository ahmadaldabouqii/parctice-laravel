@extends("layouts.master")
@section("title", "edit user")
@section("content")
    <div class="card">
        <div class="card-header text-center font-weight-bold">
            Edit user
        </div>
        <div class="card-body">
            <form name="update-user" id="update-user" method="post" action="{{route('user.update-user', $user->id)}}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{$user->name}}" />
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" class="form-control" value="{{$user->email}}" />
                </div>
                <div class="form-group">
                    <label for="phone_number">Phone number:</label>
                    <input type="tel" name="phone_number" class="form-control"  value="{{$user->phone_number}}" />
                </div>
                <button type="submit" class="btn btn-primary">update user</button>
            </form>
        </div>
    </div>
@endsection
