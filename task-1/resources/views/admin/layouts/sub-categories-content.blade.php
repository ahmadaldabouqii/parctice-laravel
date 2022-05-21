<div class="card">
    <table class="table table-hover">
        <div class="form-group" style="display: inline-flex ">
            <select class="form-control mr-3 col-md-4" name="is_active"
                    onchange="window.location.href=this.value">
               <option
                   value="{{route('admin.subCategory.sub-categories')}}"
                   @if(!request()->has("is_active")) selected  @endif>
                   All...
               </option>
               <option
                   value="{{route('admin.subCategory.sub-categories', ['is_active' => 1])}}"
                   @if(request()->has("is_active") && request()->is_active === 1) selected @endif>
                   active sub category
               </option>
               <option
                   value="{{route('admin.subCategory.sub-categories', ['is_active'  => 0])}}"
                   @if(request()->has("is_active") && request()->is_active === 0) selected @endif>
                   Inactive sub category
               </option>
            </select>
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
