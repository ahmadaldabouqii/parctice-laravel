@include('sweetalert::alert')
@include('layouts.table-head')
<table class="table table-hover">
    <thead>
        <th>Sub Category Name</th>
        <th>Status</th>
    </thead>
    <tbody>
        @foreach($sub_categories as $subCategory)
            <tr>
                <td>{{$subCategory->name}}</td>
                @if($subCategory->is_active)
                    <td class="status"><span class="active">Active</span></td>
                @else
                    <td class="status"><span class="waiting">offline</span></td>
                @endif
                <td>
                    <a href="{{url('edit-sub-category/' . $subCategory->id)}}" class="btn btn-primary btn-sm">Edit</a>
                    <form method="post" action="{{route('deleteSubCategory', $subCategory->id)}}" style="display: inline-block;">
                        @method('post')
                        @csrf
                        <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@if(!$sub_categories)
    <h3 class="text-center mt-3 mb-3">There is no sub category yet!</h3>
@endif
<div>
    <a class="btn btn-success float-right mb-2 mr-2" href="/add-sub-category">Add new sub category</a>
</div>
</div>
</div>
</body>
</html>
