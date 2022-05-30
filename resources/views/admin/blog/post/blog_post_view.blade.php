@extends('admin.admin_master')
@section('admin_content')
    <div class="sl-mainpanel">

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Blog Post Table</h5>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">
                    Blog Post list
                    <a href="{{ route('add.blogpost') }}" class="btn btn-sm btn-warning" style="float: right">Add New
                        Post</a>
                </h6>

                <div class="table-wrapper">

                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                            <tr>
                                <th class="wd-15p">Post Title</th>
                                <th class="wd-15p">Post Category</th>
                                <th class="wd-15p">Image</th>
                                <th class="wd-20p">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $key => $item)
                                <tr>
                                    <td>{{ $item->post_title_en }}</td>
                                    <td>{{ $item->postCategory->category_name_en }}</td>
                                    <td>
                                        @if ($item->post_image)
                                            <img src="{{ asset($item->post_image) }}" alt=""
                                                style="width:50px;height:50px">
                                        @else
                                            <span>No data</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('edit.blogpost', $item->id) }}"
                                            class="btn btn-sm btn-info">Edit</a>
                                        <a href="{{ route('delete.blogpost', $item->id) }}" class="btn btn-sm btn-danger"
                                            id="delete">Delete</a>
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
