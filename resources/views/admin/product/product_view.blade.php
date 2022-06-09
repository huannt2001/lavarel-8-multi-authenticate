@extends('admin.admin_master')
@section('admin_content')
    <div class="sl-mainpanel">

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Product Table</h5>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">
                    Product list
                    <a href="{{ route('add.product') }}" class="btn btn-sm btn-warning" style="float: right">Add New</a>
                </h6>

                <div class="table-wrapper">

                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                            <tr>
                                <th class="wd-15p">Product Code</th>
                                <th class="wd-15p">Product Name</th>
                                <th class="wd-15p">Image</th>
                                <th class="wd-15p">Category</th>
                                <th class="wd-15p">Brand</th>
                                <th class="wd-15p">Quantity</th>
                                <th class="wd-15p">Status</th>
                                <th class="wd-20p">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $key => $item)
                                <tr>
                                    <td>{{ $item->product_code }}</td>
                                    <td>{{ $item->product_name }}</td>
                                    <td>
                                        <img src="{{ asset($item->image_one) }}" alt="" style="width:50px;height:50px">
                                    </td>
                                    <td>{{ $item->category->category_name }}</td>
                                    <td>{{ $item->brand->brand_name }}</td>
                                    <td>{{ $item->product_quantity }}</td>
                                    <td>
                                        @if ($item->status == 1)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('edit.product', $item->id) }}" class="btn btn-sm btn-info"
                                            title="Edit"><i class="fa fa-edit"></i></a>
                                        <a href="{{ route('product.delete', $item->id) }}" class="btn btn-sm btn-danger"
                                            id="delete" title="Delete"><i class="fa fa-trash"></i></a>
                                        <a href="{{ route('admin.view.product', $item->id) }}"
                                            class="btn btn-sm btn-warning" title="Show"><i class="fa fa-eye"></i></a>

                                        @if ($item->status == 1)
                                            <a href="{{ route('inactive.product', $item->id) }}"
                                                class="btn btn-sm btn-danger" title="Inactive"><i
                                                    class="fa fa-thumbs-down"></i></a>
                                        @else
                                            <a href="{{ route('active.product', $item->id) }}"
                                                class="btn btn-sm btn-info" title="Active"><i
                                                    class="fa fa-thumbs-up"></i></a>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
