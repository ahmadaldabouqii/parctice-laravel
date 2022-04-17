@extends("admin.layouts.master")
@section("title", "add sub category")
@section("content")
   <div class="card">
       <div class="card-header text-center font-weight-bold">
           Add Sub Category
       </div>
       <div class="card-body">
               <form method="post" name="insert-sub-category" action="{{route('admin.subCategory.insert-sub-category')}}">
               @csrf
               @method('post')
               <div class="mb-3">
                   <label>Sub category name:</label>
                   <input type="text" name="name" class="form-control"/>
               </div>
               <div class="form-group">
                   <label>Select parent category:</label>
                   <select name="category_id" class="form-control">
                       <option value="">None</option>
                       @if($categories)
                           @foreach($categories as $category)
                               <option value="{{$category->id}}">{{$category->name}}</option>
                           @endforeach
                       @endif
                   </select>
               </div>
               <div>
                   <label class="mr-3">Is active</label>
                   <div class="form-check">
                       <input class="form-check-input" type="radio" name="is_active" id="radio" value="1"/>
                       <label class="form-check-label" for="is_active"> Yes </label>
                   </div>
                   <div class="form-check">
                       <input class="form-check-input" type="radio" name="is_active" id="radio" value="0"/>
                       <label class="form-check-label" for="is_active"> No </label>
                   </div>
               </div>
               <div class="mb-3 mt-3">
                   <button type="submit" class="btn btn-primary">Submit</button>
               </div>
           </form>
       </div>
   </div>
@endsection
