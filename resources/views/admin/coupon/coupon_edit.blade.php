@extends('admin.admin_master')
@section('admin_content')
    <div class="sl-mainpanel">

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Coupon Table</h5>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-20">
                <h6 class="card-body-title">Coupon Update</h6>
            </div>
            <form method="post" action="{{ route('coupon.update', $coupon->id) }}">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1" class="">Coupon Code</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="coupon"
                        value="{{ $coupon->coupon }}">
                    @error('coupon')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" class="">Coupon Discount (%)</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="discount"
                        value="{{ $coupon->discount }}">
                    @error('discount')
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
