@include('sweetalert::alert')
@include('layouts.form-header')
        <div class="container mt-4">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li style="list-style-type: none">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header text-center font-weight-bold">
                    Add Category
                </div>
                <div class="card-body">
                    <form name="add-category-form" id="add-category-form" method="post"
                          action="{{url('insert-category')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                                <label>Category Image</label>
                            <input type="file" name="image" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label>Category Name</label>
                            <input type="text" name="name" class="form-control" value="" />
                        </div>
                        <div>
                            <label class="mr-3">Is Active</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_active" id="radio" value="1"/>
                                <label class="form-check-label" for="is_active"> Yes </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_active" id="radio" value="0"/>
                                <label class="form-check-label" for="is_active"> No </label>
                            </div>
                        </div>
                        <div class="mb-3 mt-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
