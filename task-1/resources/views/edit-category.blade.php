@include('sweetalert::alert')
@include('layouts.form-header')
<div class="container mt-4">
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
            Edit Category
        </div>
        <div class="card-body">
            <form name="update-user" id="update-user" method="post"
                  action="{{url('update-category/' . $category->id)}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label>Category Image</label>
                    <input type="file" name="image" class="form-control" value="{{$category->image}}"/>
                </div>
                <div class="form-group">
                    <label for="name">Category Name:</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{$category->name}}"/>
                </div>
                <div>
                    <label class="mr-3">Is Active</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="is_active" id="radio" value="1" @if($category->is_active) checked @endif/>
                        <label class="form-check-label" for="is_active"> Yes </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="is_active" id="radio" value="0" @if(!$category->is_active) checked @endif/>
                        <label class="form-check-label" for="is_active"> No </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary float-right">update category</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
