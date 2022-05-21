<div class="card mb-4">
    <table class="table table-hover ">
        <div class="form-group" style="display: inline-flex">
            <form method="post" action="{{route('admin.product.filterProducts')}}">
                @csrf
                @method("post")
                <select class="form-control mr-3 col-md-4" name="filterProducts" id="filterProducts">
                    <option value="sort">Sort...</option>
                    <option value="descending">High to low</option>
                    <option value="ascending">Low to high</option>
                </select>
                <input class="btn btn-success mb-2 mr-2" type="submit" value="Change"/>
            </form>
        </div>
        <thead>
            <th>Product Image</th>
            <th> {{__("global.product_name")  }}</th>
            <th>Parent Category</th>
            <th>Product Price</th>
            <th></th>
        </thead>
        <tbody>
        @foreach($products as $category)
            <tr>
                <td>
                    <img style="max-width:17%" alt="{{$category->name}}"
                         src="{{ asset('storage/uploads/' . $category->image) }}"
                    />
                </td>
                <td>{{$category->name}}</td>
                <td>{{$category->parent_category}}</td>
                <td>{{$category->price}}</td>
                <td>
                    <a href="{{ route('admin.product.edit-product', $category->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <form action="{{route('admin.product.delete-product', $category->id)}}" method="post" style="display: inline-block;" >
                        @csrf
                        <button type="submit" data-name="product" class="show-alert-delete-box btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @if(!$products)
        <h3 class="text-center mt-3 mb-3">There is no product yet!</h3>
    @endif
    <div>
        <a class="btn btn-success float-right mb-2 mr-2" href="{{route('admin.product.add-product')}}">Add new product</a>
    </div>
</div>
