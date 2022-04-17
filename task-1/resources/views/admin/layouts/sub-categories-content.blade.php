<div class="card">
    <table class="table table-hover">
        <div class="form-group" style="display: inline-flex ">
            <form method="post" action="{{route("admin.subCategory.filterSubCategory")}}">
                @csrf
                @method("post")
                <select class="form-control mr-3 col-md-4" name="filter" id="filter">
                    <option value="">Sort...</option>
                    <option value="active">active sub category</option>
                    <option value="Inactive">Inactive sub category</option>
                    @foreach($categories as $category)
                        <option value="{{$category->name}}">{{$category->name}} category</option>
                    @endforeach
                </select>
                <input class="btn btn-success mb-2 mr-2" type="submit" value="Change"/>
            </form>
        </div>
        <thead>
            <th>Sub Category Name</th>
            <th>Parent Category</th>
            <th>Status</th>
            <th></th>
        </thead>
        <tbody>
        @if($sub_categories)
            @foreach($sub_categories as $subCategory)
                <tr>
                    <td>{{$subCategory->name}}</td>
                    @foreach($categories as $category)
                        @if($subCategory->category_id === $category->id)
                            <td> {{$category->name}}</td>
                        @endif
                    @endforeach
                    @if($subCategory->is_active)
                        <td class="status"><span class="active">Active</span></td>
                    @else
                        <td class="status"><span class="waiting">offline</span></td>
                    @endif
                    <td>
                        <a href="{{route('admin.subCategory.editSubCategory', $subCategory->id)}}" class="btn btn-primary btn-sm">Edit</a>
                        <form method="post" action="{{route('admin.subCategory.deleteSubCategory', $subCategory->id)}}"
                              style="display: inline-block;">
                            @method('post')
                            @csrf
                            <button class="show-alert-delete-box btn btn-danger btn-sm" data-name="Sub category"
                                    type="submit">Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <h3 class="text-center mt-3 mb-3">There is no sub category yet!</h3>
    @endif
    <div>
        <a class="btn btn-success float-right mb-2 mr-2" href="{{route('admin.subCategory.add-sub-category')}}">
            Add new sub category
        </a>
    </div>
</div>
