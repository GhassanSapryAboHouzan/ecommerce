@extends('layouts.admin-auth')

@section('content')
 <!-- Basic forgot password form-->
 <div class="card shadow-lg border-0 rounded-lg mt-5">
    <div class="card-header justify-content-center"><h3 class="fw-light my-4"> {!! __('dashboard.password_recovery') !!} </h3></div>
    <div class="card-body">
        <div class="small mb-3 text-muted">
            {!! __('dashboard.enter_your_email_address_and_we_will_send_you_link_to_reset_your_password') !!}
        </div>
        <!-- Forgot password form-->
        <form method="POST" action="{{ route('password.email') }}">
        @csrf
            <!-- Form Group (email address)-->
            <div class="mb-3">
                <label class="small mb-1" for="email">{!! __('customAuth.email') !!}</label>
                <input class="form-control" id="email" name="email" type="email" value="{!! old('email') !!}"
                       placeholder="{!! __('customAuth.enter_email') !!}" />
                @error('email')
                <span class="text-danger">{!! $message !!}</span>
                @enderror
            </div>
            <!-- Form Group (submit options)-->
            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                <a class="small" href="{!! route('admin.login') !!}">{!! __('dashboard.return_to_login') !!}</a>
                <button type="submit" class="btn btn-primary">{!! __('customAuth.reset_password') !!}</button>
            </div>
        </form>
    </div>

</div>
@endsection
