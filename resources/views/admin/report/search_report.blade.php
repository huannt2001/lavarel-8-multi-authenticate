@extends('admin.admin_master')
@section('admin_content')
    <div class="sl-mainpanel">

        <div class="sl-pagebody">

            <div class="card pd-20 pd-sm-20">
                <h6 class="card-body-title">Search Report</h6>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="card pd-20 pd-sm-20 mt-3">
                        <div class="table-wrapper">
                            <form method="post" action="">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="">Search By Date</label>
                                    <input type="date" class="form-control" id="exampleInputEmail1" name="date" value="">
                                    @error('brand_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-info pd-x-20">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card pd-20 pd-sm-20 mt-3">
                        <div class="table-wrapper">
                            <form method="post" action="">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="">Search By Month</label>
                                    <select name="month" id="" class="form-control">
                                        <option value="January">January</option>
                                        <option value="February">February</option>
                                        <option value="March">March</option>
                                        <option value="April">April</option>
                                        <option value="May">May</option>
                                        <option value="June">June</option>
                                        <option value="July">July</option>
                                        <option value="August">August</option>
                                        <option value="September">September</option>
                                        <option value="October">October</option>
                                        <option value="November">November</option>
                                        <option value="December">December</option>
                                    </select>
                                    @error('brand_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-info pd-x-20">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card pd-20 pd-sm-20 mt-3">
                        <div class="table-wrapper">
                            <form method="post" action="">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="">Search By Year</label>
                                    <select name="year" id="" class="form-control">
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                    </select>
                                    @error('brand_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-info pd-x-20">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
