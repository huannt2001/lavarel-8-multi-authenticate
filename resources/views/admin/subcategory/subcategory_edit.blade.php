@extends('admin.admin_master')
@section('admin_content')
    <div class="sl-mainpanel">

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Sub Category Table</h5>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-20">
                <h6 class="card-body-title pd-y-20">Sub Category Update</h6>
                <form method="post" action="{{ route('subcategory.update', $subcategory->id) }}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="">Sub Category Name</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="subcategory_name"
                            value="{{ $subcategory->subcategory_name }}">
                        @error('subcategory_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">New Category Name</label>
                        <select name="category_id" class="form-control">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $category->id == $subcategory->category_id ? 'selected' : '' }}>
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info pd-x-20">Update</button>
                        <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
