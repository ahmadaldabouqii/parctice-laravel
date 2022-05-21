@extends("admin.layouts.master")
@section("title", "edit product")
@section("content")
    <div class="card">
        <div class="card-header text-center font-weight-bold">
            Edit Product
        </div>
        <div class="card-body">
            <form method="post" enctype="multipart/form-data"
                  action="{{route('admin.product.update-product', $product->id)}}" >
                @csrf
                @method('PUT')
                <img style="max-width:10%" alt="{{$product->name}}" src="{{asset('storage/uploads/' . $product->image)}}">
                <div class="mb-3 mt-3">
                    <label class="font-weight-bold">Product Image</label>
                    <input type="file" name="image" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="name" class="font-weight-bold">Product Name:</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{$product->name}}"/>
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
                    <input type="number" name="price" class="form-control" value="{{$product->price}}"/>
                </div>
                <button type="submit" class="btn btn-primary float-right">update product</button>
            </form>
        </div>
    </div>
@endsection
