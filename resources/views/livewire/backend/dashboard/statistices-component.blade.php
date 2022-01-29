<div class="row">
    <!----- start  Count ----->
    <div class="col-xl-3">
        <!--begin::Stats Widget 32-->
        <div class="card card-custom bg-info-o-80 card-stretch gutter-b">
            <!--begin::Body-->
            <div class="card-body">
            <span>
                <!--begin::Svg Icon-->
                <i class="fa fa-money-bill-wave fa-3x" style="color: #3699FF"></i>
                <!--end::Svg Icon-->
            </span>
                <span class="card-title font-weight-bolder font-size-h2 mb-0 mt-6 text-hover-primary d-block">
                  $ {!! $currentMonthEarning !!}
                </span>
                <span class="font-weight-bold card_name_span">{!! __('dashboard.monthly_earnings') !!}</span>

            </div>
            <!--end::Body-->
        </div>
        <!--end::Stats Widget 32-->
    </div>
    <!----- end  Count ------>


    <!----- start  Count ----->
    <div class="col-xl-3">
        <!--begin::Stats Widget 32-->
        <div class="card card-custom bg-primary-o-50 card-stretch gutter-b">
            <!--begin::Body-->
            <div class="card-body">
                <span>
                    <!--begin::Svg Icon-->
                      <i class="fa fa-money-bill-alt fa-3x" style="color: #3699FF"></i>
                    <!--end::Svg Icon-->
                </span>
                <span class="card-title font-weight-bolder font-size-h2 mb-0 mt-6 text-hover-primary d-block">
                   $ {!! $currentAnnualEarning !!}
                </span>
                <span class="font-weight-bold card_name_span">{!! __('dashboard.annual_earnings') !!}</span>
            </div>
            <!--end::Body-->
        </div>
        <!--end::Stats Widget 32-->
    </div>
    <!----- end  Count ------>


    <!----- start  Count ----->
    <div class="col-xl-3">
        <!--begin::Stats Widget 32-->
        <div class="card card-custom bg-warning-o-80 card-stretch gutter-b">
            <!--begin::Body-->
            <div class="card-body">
                <span>
                    <!--begin::Svg Icon-->
                      <i class="fa fa-shopping-cart fa-3x" style="color: #3699FF"></i>
                    <!--end::Svg Icon-->
                </span>
                <span class="card-title font-weight-bolder  font-size-h2 mb-0 mt-6 text-hover-primary d-block">
                   {!! $currentMonthNewOrders !!}
                </span>
                <span class="font-weight-bold  card_name_span">{!! __('dashboard.month_new_orders') !!}</span>
            </div>
            <!--end::Body-->
        </div>
        <!--end::Stats Widget 32-->
    </div>
    <!----- end  Count ------>


    <!----- start  Count ----->
    <div class="col-xl-3">
        <!--begin::Stats Widget 32-->
        <div class="card card-custom bg-dark-o-80 card-stretch gutter-b">
            <!--begin::Body-->
            <div class="card-body">
                <span>
                    <!--begin::Svg Icon-->
                      <i class="fa fa-shopping-bag fa-3x" style="color: #3699FF"></i>
                    <!--end::Svg Icon-->
                </span>
                <span class="card-title font-weight-bolder font-size-h2 mb-0 mt-6 text-hover-primary d-block">
                    {!! $currentMonthOrdersFinished !!}
                </span>
                <span class="font-weight-bold  card_name_span">{!! __('dashboard.annual_finished_orders') !!}</span>
            </div>
            <!--end::Body-->
        </div>
        <!--end::Stats Widget 32-->
    </div>
    <!----- end  Count ------>
</div>
