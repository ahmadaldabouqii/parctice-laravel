@include('sweetalert::alert')
@include('layouts.table-head')
<table class="table table-hover">
    <thead>
    <th>Category Image</th>
    <th>Category Name</th>
    <th>Status</th>
    </thead>
    <tbody>

        @foreach($categories as $category)
            <tr>
                <td>
                    <img style="max-width:20%" alt="{{$category->name}}"
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
                    <a href="{{ url('edit-category/' . $category->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <form action="{{route('deleteCategory', $category->id)}}" method="post" style="display: inline-block;">
                        @method('post')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
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
    <a class="btn btn-success float-right mb-2 mr-2" href="/add-category">Add new category</a>
</div>
</div>
</div>
</body>
</html>
