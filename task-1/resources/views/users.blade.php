<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Users</title>
</head>
<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }
    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }
    tr:nth-child(even) {
        background-color: #dddddd;
    }
</style>
<body>
<div class="container mt-4">
    <div class="card">
        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
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
