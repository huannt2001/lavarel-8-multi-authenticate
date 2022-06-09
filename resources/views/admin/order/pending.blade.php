@extends('admin.admin_master')
@section('admin_content')
    <div class="sl-mainpanel">

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Pending Order</h5>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">
                    Order list
                </h6>

                <div class="table-wrapper">

                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                            <tr>
                                <th class="wd-15p">Payment Type</th>
                                <th class="wd-15p">Transaction ID</th>
                                <th class="wd-15p">Subtotal</th>
                                <th class="wd-20p">Shipping</th>
                                <th class="wd-20p">Discount</th>
                                <th class="wd-20p">Total</th>
                                <th class="wd-20p">Date</th>
                                <th class="wd-20p">Status</th>
                                <th class="wd-20p">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $key => $item)
                                <tr>
                                    <td width="15%">{{ $item->payment_type }}</td>
                                    <td width="15%">{{ Str::limit($item->blnc_transection, 20) }}</td>
                                    <td width="10%">{{ $item->subtotal }}$</td>
                                    <td width="10%">{{ $item->shipping }}$</td>
                                    <td width="10%">{{ $item->discount }}$</td>
                                    <td width="10%">{{ $item->total }}$</td>
                                    <td width="10%">{{ $item->date }}</td>
                                    <td width="10%">
                                        @if ($item->status == 0)
                                            <span class="badge badge-warning">Pending</span>
                                        @elseif ($item->status == 1)
                                            <span class="badge badge-info">Payment Accept</span>
                                        @elseif ($item->status == 2)
                                            <span class="badge badge-primary">Progress</span>
                                        @elseif ($item->status == 3)
                                            <span class="badge badge-success">Delivered</span>
                                        @else
                                            <span class="badge badge-danger">Cancle</span>
                                        @endif
                                    </td>
                                    <td width="10%">
                                        <a href="{{ route('view.order', $item->id) }}"
                                            class="btn btn-sm btn-info">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- card -->

            </div>
        </div>
    </div>
@endsection
