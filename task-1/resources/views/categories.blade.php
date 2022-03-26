@include('layouts.table-head')
<table class="table table-hover">
    <thead>
    <th>Category Image</th>
    <th>Category Name</th>
    <th>Is Active</th>
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
                <td>{{$category->is_active}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<div>
    <a class="btn btn-success float-right" href="/add-category">Add new category</a>
</div>
</div>
</div>
</body>
</html>
