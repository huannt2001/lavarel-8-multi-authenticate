@extends('admin.admin_master')
@section('admin_content')
    <div class="sl-mainpanel">

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Blog Category Table</h5>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-20">
                <h6 class="card-body-title"> Blog Category Update</h6>
            </div>
            <form method="post" action="{{ route('update.blog.category', $blogcate->id) }}" class="pd-y-20">
                @csrf
                <div class="form-group ">
                    <label for="exampleInputEmail1" class="">Category Name English</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="category_name_en"
                        value="{{ $blogcate->category_name_en }}">
                    @error('category_name_en')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" class="">Category Name VietNam</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="category_name_vn"
                        value="{{ $blogcate->category_name_vn }}">
                    @error('category_name_vn')
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
