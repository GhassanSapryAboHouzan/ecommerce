<div class="card border-0 rounded-0 p-lg-4 bg-light">
    <div class="card-body">
        <div
            class="py-2 px-4 mb-3 {!! Route::currentRouteName() =='customer.dashboard' ?  'bg-dark text-white':'bg-light' !!} ">
            <a href="{{ route('customer.dashboard') }}">
                <strong class="small text-uppercase font-weight-bold">Dashboard</strong>
            </a>
        </div>

        <div
            class="py-2 px-4 mb-3 py-2 px-4 mb-3  {!! Route::currentRouteName() =='customer.profile' ?  'bg-dark text-white':'bg-light' !!} ">
            <a href="{{ route('customer.profile') }}">
                <strong class="small text-uppercase font-weight-bold">Profile</strong>
            </a>
        </div>

        <div
            class="py-2 px-4 mb-3 py-2 px-4 mb-3  {!! Route::currentRouteName() =='customer.addresses' ?  'bg-dark text-white':'bg-light' !!} ">
            <a href="{{ route('customer.addresses') }}">
                <strong class="small text-uppercase font-weight-bold">Addresses</strong>
            </a>
        </div>

        <div
            class="py-2 px-4 mb-3 py-2 px-4 mb-3  {!! Route::currentRouteName() =='customer.orders' ?  'bg-dark text-white':'bg-light' !!} ">
            <a href="{{ route('customer.orders') }}">
                <strong class="small text-uppercase font-weight-bold">Orders</strong>
            </a>
        </div>

        <div class="py-2 px-4 mb-3 py-2 px-4 mb-3 bg-light text-dark">
            <a href="javascript:void(0)" class="small text-uppercase font-weight-bold"
               onclick="event.preventDefault(); document.getElementById('logout_form').submit();">
                {!! __('customAuth.logout') !!}
            </a>

            <form action="{!! route('logout') !!}" method="post" id="logout_form" class="d-none">
                @csrf
            </form>
        </div>

    </div>
</div>
