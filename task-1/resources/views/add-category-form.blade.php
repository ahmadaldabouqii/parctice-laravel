@extends("layouts.master")
@section("title", "add category")
@section("content")
    <div class="card">
        <div class="card-header text-center font-weight-bold">
            Add Category
        </div>
        <div class="card-body">
            <form name="add-category-form" id="add-category-form" method="post"
                  action="{{route('category.insert-category')}}" enctype="multipart/form-data">
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
@endsection
