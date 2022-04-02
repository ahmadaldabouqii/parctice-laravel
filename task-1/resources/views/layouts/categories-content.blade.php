<div class="card mb-4">
    <table class="table table-hover ">
        <thead>
            <th>Category Image</th>
            <th>Category Name</th>
            <th>Status</th>
            <th></th>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td>
                    <img style="max-width:10%" alt="{{$category->name}}"
                         src="{{ asset('storage/uploads/' . $category->image) }}"
                    />
                </td>
                <td>{{$category->name}}</td>
                @if($category->is_active)
                    <td class="status"><span class="active">Active</span></td>
                @else
                    <td class="status"><span class="waiting">offline</span></td>
                @endif
                <td>
                    <a href="{{ route('category.edit-category', $category->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <form action="{{route('category.deleteCategory', $category->id)}}" method="post" style="display: inline-block;" >
                        @method('delete')
                        @csrf
                        <button type="submit" data-name="category" class="show-alert-delete-box btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @if(!$categories)
        <h3 class="text-center mt-3 mb-3">There is no category yet!</h3>
    @endif
    <div>
        <a class="btn btn-success float-right mb-2 mr-2" href="{{route('category.add-category')}}">Add new category</a>
    </div>
</div>
