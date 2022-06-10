@extends('admin.admin_master')

@section('admin_content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="index.html">Starlight</a>
            <span class="breadcrumb-item active">Seo Setting Section</span>
        </nav>

        <div class="sl-pagebody">

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Seo Setting
                </h6>

                <form action="{{ route('update.seo', $seo->id) }}" method="post">
                    @csrf
                    <div class="form-layout">
                        <div class="row mg-b-25">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Meta Title: <span
                                            class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="meta_title"
                                        value="{{ $seo->meta_title }}" placeholder="Enter Meta Title">
                                    @error('meta_title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Meta Author: <span
                                            class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="meta_author"
                                        value="{{ $seo->meta_author }}" placeholder="Enter Meta Author">
                                    @error('meta_author')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Meta Tag: <span
                                            class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="meta_tag"
                                        value="{{ $seo->meta_tag }} " placeholder="Enter Meta Tag">
                                    @error('meta_tag')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">
                                        Meta Description: <span class="tx-danger">*</span>
                                    </label>
                                    <textarea name="meta_description" class="form-control" cols="30" rows="10">{{ $seo->meta_description }}</textarea>
                                    @error('meta_description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">
                                        Google Analytics: <span class="tx-danger">*</span>
                                    </label>
                                    <textarea name="google_analytics" class="form-control" cols="30" rows="10">{{ $seo->google_analytics }}</textarea>
                                    @error('google_analytics')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">
                                        Bing Analytics: <span class="tx-danger">*</span>
                                    </label>
                                    <textarea name="bing_analytics" class="form-control" cols="30" rows="10">{{ $seo->bing_analytics }}</textarea>
                                    @error('bing_analytics')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div><!-- form-layout -->
                        <div class="form-layout-footer">
                            <button class="btn btn-info mg-r-5" type="submit">Submit Form</button>
                        </div><!-- form-layout-footer -->
                    </div>
                </form>
            </div><!-- card -->

        </div><!-- sl-pagebody -->
    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
@endsection
