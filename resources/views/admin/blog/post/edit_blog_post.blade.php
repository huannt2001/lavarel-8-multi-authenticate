@extends('admin.admin_master')

@section('admin_content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="index.html">Starlight</a>
            <span class="breadcrumb-item active">Blog Section</span>
        </nav>

        <div class="sl-pagebody">

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Blog Post Update
                    <a href="{{ route('all.blogpost') }}" class="btn btn-success btn-sm pull-right">All Post</a>

                </h6>

                <form action="{{ route('update.blogpost', $post->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-layout">
                        <div class="row mg-b-25">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Post Title (ENGLISH): <span
                                            class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="post_title_en"
                                        value="{{ $post->post_title_en }}">
                                    @error('post_title_en')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Post Title (VIETNAM): <span
                                            class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="post_title_vn"
                                        value="{{ $post->post_title_vn }}" placeholder="Enter Post Title VietNam">
                                    @error('post_title_vn')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Blog Category: <span
                                            class="tx-danger">*</span></label>
                                    <select class="form-control select2" data-placeholder="Choose category"
                                        name="category_id">
                                        <option label="Choose category"></option>
                                        @if (isset($blogcates) && count($blogcates) > 0)
                                            @foreach ($blogcates as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $post->category_id === $item->id ? 'selected' : '' }}>
                                                    {{ $item->category_name_en }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Product Details (ENGLISH): <span
                                            class="tx-danger">*</span></label>
                                    <textarea name="details_en" id="summernote" class="form-control" cols="30"
                                        rows="10">{!! $post->details_en !!}</textarea>
                                    @error('details_en')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Product Details (VIETNAM): <span
                                            class="tx-danger">*</span></label>
                                    <textarea name="details_vn" id="summernote1" class="form-control" cols="30"
                                        rows="10">{!! $post->details_vn !!}</textarea>
                                    @error('details_vn')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Post Image: <span
                                            class="tx-danger">*</span></label> <br>
                                    <label class="custom-file">
                                        <input type="file" id="file" name="post_image" class="custom-file-input"
                                            onchange="readURL1(this);">
                                        <span class="custom-file-control"></span>
                                    </label> <br>
                                    <img src="#" id="one" alt="">
                                </div>
                            </div><!-- row -->

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Old Post Image:
                                        <span class="tx-danger">*</span>
                                    </label> <br>
                                    <input type="hidden" name="old_image" value="{{ $post->post_image }}">
                                    @if ($post->post_image)
                                        <img src="{{ asset($post->post_image) }}" alt=""
                                            style="width:130px; height:80px">
                                    @else
                                        <span>No Image</span>
                                    @endif
                                </div>
                            </div><!-- row -->


                        </div><!-- form-layout -->
                        <div class="form-layout-footer">
                            <button class="btn btn-info mg-r-5" type="submit">Update Post</button>
                        </div><!-- form-layout-footer -->
                    </div>
                </form>
            </div><!-- card -->

        </div><!-- sl-pagebody -->
    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->


    <script type="text/javascript">
        function readURL1(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#one')
                        .attr('src', e.target.result)
                        .width(80)
                        .height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

@endsection
