@extends("admin.layouts.master")
@section("title", "add product")
@section("content")
    <div class="card">
        <div class="card-header text-center font-weight-bold">
            Add Product
        </div>
        <div class="card-body">
            <form name="add-category-form" id="add-category-form" method="post"
                  action="{{route('admin.product.insert-product')}}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label>Product Image</label>
                    <input type="file" name="image" class="form-control"/>
                </div>
                <div class="mb-3">
                    <label>Product Name</label>
                    <input type="text" name="name" class="form-control"/>
                </div>
                <div class="form-group">
                    <label>Select parent category:</label>
                    <select name="parentCategory" class="form-control">
                        <option value="">None</option>
                        @if($sub_categories)
                            @foreach($sub_categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="mb-3">
                    <label>Product Price</label>
                    <input type="number" name="price" class="form-control"/>
                </div>
                <div class="mb-3 mt-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
