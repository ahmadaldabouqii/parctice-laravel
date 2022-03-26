@include('layouts.table-head')
<table class="table table-hover">
    <thead>
    <th>Sub Category Name</th>
    <th>Is Active</th>
    </thead>
    <tbody>
        @foreach($sub_categories as $subCategory)
            <tr>
                <td>{{$subCategory->name}}</td>
                <td>{{$subCategory->is_active}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<div>
    <a class="btn btn-success float-right" href="/add-sub-category">Add new sub category</a>
</div>
</div>
</div>
</body>
</html>
