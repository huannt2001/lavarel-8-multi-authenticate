@extends('admin.admin_master')
@section('admin_content')
    <div class="sl-mainpanel">

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Category Table</h5>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-20">
                <h6 class="card-body-title">Category Update</h6>
            </div>
            <form method="post" action="{{ route('category.update', $category->id) }}">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1" class="">Category Name</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="category_name"
                        value="{{ $category->category_name }}">
                    @error('category_name')
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
@endsection
