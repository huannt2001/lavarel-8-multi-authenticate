@extends('admin.admin_master')
@section('admin_content')
    <div class="sl-mainpanel">

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Brand Table</h5>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-20">
                <h6 class="card-body-title">Brand Update</h6>
            </div>
            <form method="post" action="{{ route('brand.update', $brand->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1" class="">Brand Name</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="brand_name"
                        value="{{ $brand->brand_name }}">
                    @error('brand_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" class="">Brand logo</label>
                    <input type="file" class="form-control" id="exampleInputEmail1" name="brand_logo">
                    @error('brand_logo')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" class="">Old Brand Logo</label><br>
                    <img src="{{ asset($brand->brand_logo) }}" alt="" style="width:100px; height:100px;">
                    <input type="hidden" name="old_logo" value="{{ $brand->brand_logo }}">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info pd-x-20">Update</button>
                    <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
@endsection
