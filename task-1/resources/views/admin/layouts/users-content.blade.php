<div class="card mb-4">
    <table class="table table-hover">
        <div class="form-group" style="display: inline-flex ">
            <form method="post" action="{{route("admin.user.filterUsers")}}">
                @csrf
                @method("post")
                <select class="form-control mr-3 col-md-4" name="filterUsers" id="filterUsers">
                    <option value="sort">Sort...</option>
                    <option value="user">Users</option>
                    <option value="admin">Admins</option>
                </select>
                <input class="btn btn-success mb-2 mr-2" type="submit" value="Change"/>
            </form>
        </div>
        <thead>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Phone number</th>
            <th></th>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->role}}</td>
                <td>{{$user->phone_number}}</td>
                <td>
                    <a href="{{route('admin.user.edit-user', $user->id)}}" class="btn btn-primary btn-sm">Edit</a>
                    <form action="{{route('admin.user.deleteUser', $user->id)}}" method="post" style="display: inline-block;">
                        @method('post')
                        @csrf
                        <button type="submit" data-name="User" class="show-alert-delete-box btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @if(!$users)
        <h3 class="text-center mt-3 mb-3">There is no user registered yet!</h3>
    @endif
    <div>
        <a class="btn btn-success float-right mb-2 mr-2" href="{{route("admin.user.add_user_form")}}">Add User</a>
    </div>
</div>
