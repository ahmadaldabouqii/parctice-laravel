@include('layouts.form-header')
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
            Edit user
        </div>
        <div class="card-body">
            <form name="update-user" id="update-user" method="post" action="{{url('update-user/' . $user->id)}}">
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
</div>
</body>
</html>
