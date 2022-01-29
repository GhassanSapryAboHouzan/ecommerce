<!-- begin Brochure Modal -->
<div class="modal fade" id="modal_Brochure" data-backdrop="static" tabindex="-1" role="dialog"
     aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('aboutSite.brochure')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form action="" method="POST" enctype="multipart/form-data"
                  id="form_brochure_store">
                @csrf
                <div class="modal-body">

                    <!--begin::Card-->
                    <div class="card card-custom card-shadowless rounded-top-0">
                        <!--begin::Body-->
                        <div class="card-body p-0">

                            <div class="col-xl-12 col-xxl-10">

                                <div class="row justify-content-center">
                                    <div class="col-xl-12">

                                        <!--begin::Group-->
                                        <div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">
                                                    {{trans('aboutSite.brochure')}}
                                                </label>
                                                <div class="col-lg-9 col-xl-9">
                                                    <input
                                                        class="form-control form-control-solid form-control-lg"
                                                        type="file" name="brochure"
                                                        id="brochure"
                                                        placeholder=""/>
                                                    <span class="form-text text-danger"
                                                          id="brochure_error"></span>
                                                </div>
                                            </div>
                                            <div class="example-preview">
                                                <div class="pt-4">
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar"
                                                             aria-valuenow="0" aria-valuemin="0"
                                                             aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div id="uploadStatus"></div>
                                            </div>
                                        </div>
                                        <!--end::Group-->


                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="" id="cancel_brochure_btn" class="btn btn-light-primary font-weight-bold">
                        {{trans('general.cancel')}}
                    </button>

                    <button type="submit" id="save_brochure_btn" class="btn btn-primary font-weight-bold">
                        {{trans('general.save')}}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end Brochure Add Modal-->


