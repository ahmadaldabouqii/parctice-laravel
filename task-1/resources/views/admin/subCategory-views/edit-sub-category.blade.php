@extends("admin.layouts.master")
@section("title", "edit sub category")
@section("content")
    <div class="card">
        <div class="card-header text-center font-weight-bold">
            Edit Sub Category
        </div>
        <div class="card-body">
            <form method="post" enctype="multipart/form-data"
                  action="{{route('admin.subCategory.update-sub-category', $subCategory->id)}}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Sub Category Name:</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{$subCategory->name}}"/>
                </div>
                <div class="form-group">
                    <label>Select parent category:</label>
                    <select name="category_id" class="form-control">
                        <option value="">None</option>
                        @if($categories)
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" @if($subCategory->category_id === $category->id) selected @endif>{{$category->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div>
                    <label class="mr-3">Is Active</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="is_active" id="radio" value="1" @if($subCategory->is_active) checked @endif/>
                        <label class="form-check-label" for="is_active"> Yes </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="is_active" id="radio" value="0" @if(!$subCategory->is_active) checked @endif/>
                        <label class="form-check-label" for="is_active"> No </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary float-right">update sub category</button>
            </form>
        </div>
    </div>
@endsection
