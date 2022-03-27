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
