@extends('admin.admin_master')

@section('admin_content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="index.html">Starlight</a>
            <span class="breadcrumb-item active">Product Section</span>
        </nav>

        <div class="sl-pagebody">

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Update Product
                    <a href="{{ route('all.product') }}" class="btn btn-success btn-sm pull-right">All Product</a>

                </h6>
                <p class="mg-b-20 mg-sm-b-30">Update Product Form</p>

                <form action="{{ route('update.withoutphoto.product', $product->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-layout">
                        <div class="row mg-b-25">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Product Name <span
                                            class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="product_name"
                                        value="{{ $product->product_name }}" placeholder="Enter Product Name">
                                    @error('product_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Product Code: <span
                                            class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="product_code"
                                        value="{{ $product->product_code }}" placeholder="Enter Product Code">
                                    @error('product_code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Quantity: <span
                                            class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="product_quantity"
                                        value="{{ $product->product_quantity }}" placeholder="Enter quantity">
                                    @error('product_quantity')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Category: <span
                                            class="tx-danger">*</span></label>
                                    <select class="form-control select2" data-placeholder="Choose category"
                                        name="category_id">
                                        <option label="Choose category"></option>
                                        @if (isset($categories) && count($categories) > 0)
                                            @foreach ($categories as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $product->category_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->category_name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Sub Category: <span
                                            class="tx-danger">*</span></label>
                                    <select class="form-control select2" data-placeholder="Choose sub category"
                                        name="subcategory_id">
                                        @if (isset($subcategories) && count($subcategories) > 0)
                                            @foreach ($subcategories as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $product->subcategory_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->subcategory_name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Brand: <span class="tx-danger">*</span></label>
                                    <select class="form-control select2" data-placeholder="Choose brand" name="brand_id">
                                        <option label="Choose brand"></option>
                                        @if (isset($brands) && count($brands) > 0)
                                            @foreach ($brands as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $product->brand_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->brand_name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Product Size: <span
                                            class="tx-danger">*</span></label>
                                    <input class="form-control" id="size" type="text" name="product_size"
                                        value="{{ $product->product_size }}" placeholder="Enter Product Size"
                                        data-role="tagsinput">
                                    @error('product_size')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Product Color: <span
                                            class="tx-danger">*</span></label>
                                    <input class="form-control" id="color" type="text" name="product_color"
                                        value="{{ $product->product_color }}" placeholder="Enter Product Color"
                                        data-role="tagsinput">
                                    @error('product_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Selling Price: <span
                                            class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="selling_price"
                                        value="{{ $product->selling_price }}" placeholder="Selling Price">
                                    @error('selling_price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Discount Price: <span
                                            class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="discount_price"
                                        value="{{ $product->discount_price }}" placeholder="Enter Discount Price">
                                    @error('discount_price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Product Details: <span
                                            class="tx-danger">*</span></label>
                                    <textarea name="product_details" id="summernote" class="form-control" cols="30"
                                        rows="10">{{ $product->product_details }}</textarea>
                                    @error('product_details')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Video Link: <span
                                            class="tx-danger">*</span></label>
                                    <input class="form-control" name="video_link" value="{{ $product->video_link }}"
                                        placeholder="Video link">
                                </div>
                            </div><!-- col-4 -->
                        </div><!-- row -->
                        <div class="row  mg-b-25">
                            <div class="col-lg-4">
                                <label class="ckbox">
                                    <input type="checkbox" name="main_slider" value="1"
                                        {{ $product->main_slider == 1 ? 'checked' : '' }}>
                                    <span>Main Slider</span>
                                </label>
                            </div>
                            <div class="col-lg-4">
                                <label class="ckbox">
                                    <input type="checkbox" name="hot_deal" value="1"
                                        {{ $product->hot_deal == 1 ? 'checked' : '' }}>
                                    <span>Hot Deal</span>
                                </label>
                            </div>
                            <div class="col-lg-4">
                                <label class="ckbox">
                                    <input type="checkbox" name="best_rated" value="1"
                                        {{ $product->best_rated == 1 ? 'checked' : '' }}>
                                    <span>Best Rated</span>
                                </label>
                            </div>
                            <div class="col-lg-4">
                                <label class="ckbox">
                                    <input type="checkbox" name="mid_slider" value="1"
                                        {{ $product->mid_slider == 1 ? 'checked' : '' }}>
                                    <span>Mid Slider</span>
                                </label>
                            </div>
                            <div class="col-lg-4">
                                <label class="ckbox">
                                    <input type="checkbox" name="hot_new" value="1"
                                        {{ $product->hot_new == 1 ? 'checked' : '' }}>
                                    <span>Hot New</span>
                                </label>
                            </div>
                            <div class="col-lg-4">
                                <label class="ckbox">
                                    <input type="checkbox" name="trend" value="1"
                                        {{ $product->trend == 1 ? 'checked' : '' }}>
                                    <span>Trend Product</span>
                                </label>
                            </div>
                            <div class="col-lg-4">
                                <label class="ckbox">
                                    <input type="checkbox" name="buyone_getone" value="1"
                                        {{ $product->buyone_getone == 1 ? 'checked' : '' }}>
                                    <span>Buy One Get One</span>
                                </label>
                            </div>
                        </div>
                        <div class="form-layout-footer">
                            <button class="btn btn-info mg-r-5">Update Product</button>
                            <button class="btn btn-secondary">Cancel</button>
                        </div><!-- form-layout-footer -->
                    </div><!-- form-layout -->
                </form>
            </div><!-- card -->
        </div><!-- sl-pagebody -->

        <div class="sl-pagebody">

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Update Image
                </h6>
                <form action="{{ route('update.photo.product', $product->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row mg-b-25">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Image One (Main Thumbnail): <span
                                        class="tx-danger">*</span></label>
                                <label class="custom-file mg-b-25">
                                    <input type="file" id="file" name="image_one" class="custom-file-input"
                                        onchange="readURL1(this);">
                                    <span class="custom-file-control"></span>
                                </label> <br>
                                <input type="hidden" name="old_one" value="{{ $product->image_one }}">
                                <img src="" id="one" alt="">
                                <div>
                                    <img src="{{ asset($product->image_one) }}" id="one" alt=""
                                        style="width:100px; height:100px">
                                </div>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Image Two: <span class="tx-danger">*</span></label>
                                <br>
                                <label class="custom-file mg-b-25">
                                    <input type="file" id="file" name="image_two" class="custom-file-input"
                                        onchange="readURL2(this);">
                                    <span class="custom-file-control"></span>
                                </label> <br>
                                <input type="hidden" name="old_two" value="{{ $product->image_two }}">
                                <img src="" id="two" alt="">
                                <div>
                                    <img src="{{ asset($product->image_two) }}" id="one" alt=""
                                        style="width:100px; height:100px">
                                </div>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Image Three: <span
                                        class="tx-danger">*</span></label>
                                <br>
                                <label class="custom-file mg-b-25">
                                    <input type="file" id="file" name="image_three" class="custom-file-input"
                                        onchange="readURL3(this);">
                                    <span class="custom-file-control"></span>
                                </label> <br>
                                <input type="hidden" name="old_three" value="{{ $product->image_three }}">
                                <img src="" id="three" alt="">
                                <div>
                                    <img src="{{ asset($product->image_three) }}" id="one" alt=""
                                        style="width:100px; height:100px">
                                </div>
                            </div>
                        </div><!-- col-4 -->
                    </div><!-- row -->
                    <div class="form-layout-footer">
                        <button class="btn btn-warning mg-r-5 ">Update Photo</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="category_id"]').on('change', function() {
                var category_id = $(this).val();
                if (category_id) {

                    $.ajax({
                        url: "{{ url('category/subcategory/ajax/') }}/" + category_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            var d = $('select[name="subcategory_id"]').empty();
                            $.each(data, function(key, value) {

                                $('select[name="subcategory_id"]').append(
                                    '<option value="' + value.id + '">' + value
                                    .subcategory_name + '</option>');

                            });
                        },
                    });

                } else {
                    alert('danger');
                }

            });
        });
    </script>

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
    <script type="text/javascript">
        function readURL2(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#two')
                        .attr('src', e.target.result)
                        .width(80)
                        .height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <script type="text/javascript">
        function readURL3(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#three')
                        .attr('src', e.target.result)
                        .width(80)
                        .height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

@endsection
