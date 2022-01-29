@extends('layouts.admin')
@push('css')
    <style href="{!! asset('adminBoard/assets/plugins/custom/select2/css/select2.min.css') !!}" rel="stylesheet"/>
@endpush
@section('content')

    <form action="{!! route('admin.products.update',  $product->id) !!}" method="post"
          enctype="multipart/form-data">
    @csrf
    @method('PATCH')

    <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div
                class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex align-items-center flex-wrap mr-2">

                    <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                    <!--begin::Actions-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{!! route('admin.products.index') !!}" class="text-muted">
                                {!! __('products.products') !!}
                            </a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="" class="text-muted">
                                {!! __('products.product_update') !!}
                            </a>
                        </li>
                    </ul>

                    <!--end::Actions-->
                </div>
                <!--end::Info-->

                <!--begin::Toolbar-->
                <div class="d-flex align-items-center">
                    <button type="submit" class="btn btn-primary btn-sm font-weight-bold font-size-base mr-1">
                        <i class="fa fa-save"></i>
                        {!! __('common.save') !!}
                    </button>
                    &nbsp;
                </div>
                <!--end::Toolbar-->
            </div>
        </div>
        <!--end::Subheader-->

        <!--begin::content-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class=" container">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-lg-12">
                        <!--begin::Card-->
                        <div class="card card-custom card-shadowless rounded-top-0">
                            <div class="card-body pt-20 pb-20">


                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-xl-2 col-lg-2 col-form-label">
                                        {!! __('products.name') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                   id="name" name="name" value="{!! old('name' , $product->name) !!}"
                                                   autocomplete="off"
                                                   placeholder="{!! __('products.enter_name') !!}"/>
                                        </div>
                                        @error('name')
                                        <span class="form-text text-danger">{!! $message !!}</span>
                                        @enderror
                                    </div>


                                </div>
                                <!--end::Group-->


                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-xl-2 col-lg-2 col-form-label">
                                        {!! __('products.product_category_id') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <select class="form-control" id="product_category_id"
                                                    name="product_category_id">
                                                <option value="">{!! __('common.choose_from_list') !!}</option>
                                                @foreach($categories as $category)
                                                    <option
                                                        value="{!! $category->id !!}"
                                                        {!! old('product_category_id',$product->product_category_id)==$category->id ? 'selected':'' !!}>
                                                        {!! $category->name !!}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('product_category_id')
                                        <span class="form-text text-danger">{!! $message !!}</span>
                                        @enderror
                                    </div>


                                </div>
                                <!--end::Group-->


                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-xl-2 col-lg-2 col-form-label">
                                        {!! __('products.status') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <select class="form-control" name="status" id="status">
                                                <option
                                                    value="1" {{ old('status', $product->status) == __('common.active') ? 'selected' : '' }}>
                                                    {!! __('common.active') !!}
                                                </option>
                                                <option
                                                    value="0" {{ old('status', $product->status) == __('common.inactive') ? 'selected' : '' }}>
                                                    {!! __('common.inactive') !!}
                                                </option>
                                            </select>

                                        </div>
                                        @error('status')
                                        <span class="form-text text-danger">{!! $message !!}</span>
                                        @enderror
                                    </div>


                                </div>
                                <!--end::Group-->


                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-xl-2 col-lg-2 col-form-label">
                                        {!! __('products.description') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <textarea class="form-control summernote"
                                                      id="description" name="description"
                                                      placeholder="{!! __('products.enter_description') !!}"
                                            >{!! old('description',$product->description) !!}</textarea>
                                        </div>
                                        @error('description')
                                        <span class="form-text text-danger">{!! $message !!}</span>
                                        @enderror
                                    </div>


                                </div>
                                <!--end::Group-->


                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-xl-2 col-lg-2 col-form-label">
                                        {!! __('products.price') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                   id="price" name="price" value="{!! old('price',$product->price) !!}"
                                                   autocomplete="off"
                                                   placeholder="{!! __('products.enter_price') !!}"/>
                                        </div>
                                        @error('price')
                                        <span class="form-text text-danger">{!! $message !!}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!--end::Group-->

                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-xl-2 col-lg-2 col-form-label">
                                        {!! __('products.quantity') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                   id="quantity" name="quantity"
                                                   value="{!! old('quantity',$product->quantity) !!}"
                                                   autocomplete="off"
                                                   placeholder="{!! __('products.enter_quantity') !!}"/>
                                        </div>
                                        @error('quantity')
                                        <span class="form-text text-danger">{!! $message !!}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!--end::Group-->


                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-xl-2 col-lg-2 col-form-label">
                                        {!! __('products.featured') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <select class="form-control" name="featured" id="featured">
                                                <option
                                                    value="1" {{ old('featured', $product->featured) == __('common.yes') ? 'selected' : '' }}>
                                                    {!! __('common.yes') !!}
                                                </option>
                                                <option
                                                    value="0" {{ old('featured',$product->featured) == __('common.no') ? 'selected' : '' }}>
                                                    {!! __('common.no') !!}
                                                </option>
                                            </select>

                                        </div>
                                        @error('featured')
                                        <span class="form-text text-danger">{!! $message !!}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!--end::Group-->



                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-xl-2 col-lg-2 col-form-label">
                                        {!! __('products.tags') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <select class="form-control select2" name="tags" id="tags"
                                                    multiple="multiple">
                                                @forelse($tags as $tag)
                                                    <option value="{!! $tag->id !!}"
                                                        {{ in_array($tag->id, $product->tags->pluck('id')->toArray()) ? 'selected' : null }}>
                                                        {!! $tag->name !!}
                                                    </option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                        @error('tags')
                                        <span class="form-text text-danger">{!! $message !!}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!--end::Group-->


                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-xl-2 col-lg-2 col-form-label">
                                        {!! __('products.images') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <input class="file-input-overview" type="file" name="images[]"
                                               id="product_images"
                                               multiple="multiple"
                                               placeholder="{!! __('common.select_file') !!}">
                                        @error('images')
                                        <span class="form-text text-danger">{!! $message !!}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!--end::Group-->


                            </div>
                            <!--end::Card-->
                        </div>
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Container-->

                <!--begin::Form-->
            </div>
            <!--end::content-->
        </div>
    </form>
@endsection
@push('js')

    <script type="text/javascript"
            src="{!! asset('adminBoard/assets/plugins/custom/select2/js/select2.full.min.js') !!}"></script>
    <script type="text/javascript">
        $(function () {



            //////////////////////////////////////////////////////////////
            // tags select2
            function matchStart(params, data) {
                // If there are no search terms, return all of the data
                if ($.trim(params.term) === '') {
                    return data;
                }

                // Skip if there is no 'children' property
                if (typeof data.children === 'undefined') {
                    return null;
                }

                // `data.children` contains the actual options that we are matching against
                var filteredChildren = [];
                $.each(data.children, function (idx, child) {
                    if (child.text.toUpperCase().indexOf(params.term.toUpperCase()) == 0) {
                        filteredChildren.push(child);
                    }
                });

                // If we matched any of the timezone group's children, then set the matched children on the group
                // and return the group object
                if (filteredChildren.length) {
                    var modifiedData = $.extend({}, data, true);
                    modifiedData.children = filteredChildren;

                    // You can return modified objects from here
                    // This includes matching the `children` how you want in nested data sets
                    return modifiedData;
                }

                // Return `null` if the term should not be displayed
                return null;
            }

            $(".select2").select2({
                tags: true,
                closeOnSelect: false,
                minimumResultsForSearch: Infinity,
                matcher: matchStart
            });


            $('.summernote').summernote({
                width: '100%',
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']],

                ]
            })

            //////////////////////////////////////////////////////////////
            // image
            $("#product_images").fileinput({
                theme: "fas",
                maxFileCount: 5,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false,
                initialPreview: [
                    @if($product->media()->count() > 0)
                        @foreach($product->media as $media)
                        "{{ asset('adminBoard/uploaded_images/products/' . $media->file_name) }}",
                    @endforeach
                    @endif
                ],
                initialPreviewAsData: true,
                initialPreviewFileType: 'image',
                initialPreviewConfig: [
                        @if($product->media()->count() > 0)
                        @foreach($product->media as $media)
                    {
                        caption: "{{ $media->file_name }}",
                        size: '{{ $media->file_size }}',
                        width: "120px",
                        url: "{{ route('admin.products.remove_image', ['image_id' => $media->id, 'product_id' => $product->id, '_token' => csrf_token()]) }}",
                        key: {{ $media->id }}
                    },
                    @endforeach
                    @endif
                ]
            }).on('filesorted', function (event, params) {
                console.log(params.previewId, params.oldIndex, params.newIndex, params.stack);
            });

        });


    </script>
@endpush
