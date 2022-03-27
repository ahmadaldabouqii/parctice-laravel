@section('title')
    <title> Your Page Title Here  </title>
@endsection
@include('layouts.table-head')
<table class="table table-hover">
    <thead>
        <th>Username</th>
        <th>email</th>
        <th>phone number</th>
        <th></th>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->phone_number}}</td>
            <td>
                <a href="{{ url('edit-user/' . $user->id) }}" class="btn btn-primary btn-sm">Edit</a>
                <form action="{{route('deleteUser', $user->id)}}" method="post" style="display: inline-block;">
                    @method('post')
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach

    </tbody>

</table>
@if(!$users)
    <h4 class="text-center mt-3 mb-3">There is no user registered yet!</h4>
@endif
<div>
    <a class="btn btn-success float-right" href="/add-user-form">Add User</a>
</div>
</div>
</div>
</body>
</html>
