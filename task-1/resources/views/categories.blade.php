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
