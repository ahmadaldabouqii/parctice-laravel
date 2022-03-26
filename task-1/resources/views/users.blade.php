@include('layouts.table-head')
<table class="table table-hover">
    <thead>
        <th>Username</th>
        <th>email</th>
        <th>phone number</th>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->phone_number}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<div>
    <a class="btn btn-success float-right" href="/add-user-form">Add User</a>
</div>
</div>
</div>
</body>
</html>
