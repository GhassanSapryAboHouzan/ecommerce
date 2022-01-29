@extends('layouts.admin-auth')



@section('content')
    @if (LaravelLocalization::getCurrentLocale() == 'ar')
        <style>
            .form-check .form-check-input {
                float: right;
                margin-left: 0.5em;
            }
        </style>
    @endif

    <!-- Basic login form-->
    <div class="card shadow-lg border-0 rounded-lg mt-5">
        <div class="card-header justify-content-center"><h3 class="fw-light my-4">{!! __('dashboard.login') !!}</h3>
        </div>
        <div class="card-body">
            <div class="mt-4">
                @if(\Illuminate\Support\Facades\Session::has('error'))
                    <div class="alert alert-danger font-weight-bold" role="alert">
                        {{\Illuminate\Support\Facades\Session::get('error')}}
                    </div>
                @endif
            </div>

            <!-- Login form-->
            <form action="{!! route('admin.login') !!}" method="post">
            @csrf
            <!-- Form Group (username)-->
                <div class="mb-3">
                    <label class="small mb-1" for="username">{!! __('dashboard.username') !!}</label>
                    <input class="form-control" id="username" name="username"
                           value="{!! old('username') !!}" autocomplete="off"
                           type="text" placeholder="{!! __('dashboard.enter_username') !!}"/>
                    @error('username')
                    <span class="text-danger">{!! $message !!}</span>
                    @enderror
                </div>
                <!-- Form Group (password)-->
                <div class="mb-3">
                    <label class="small mb-1" for="password">{!! __('dashboard.password') !!}</label>
                    <input class="form-control" id="password" name="password" autocomplete="off"
                           type="password" placeholder="{!! __('dashboard.enter_password') !!}"/>
                    @error('password')
                    <span class="text-danger">{!! $message !!}</span>
                    @enderror
                </div>
                <!-- Form Group (remember password checkbox)-->
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" id="remember" name="remember"
                               type="checkbox" {!! old('remember') ? 'checked':'' !!} />
                        <label class="form-check-label" for="remember">{!! __('dashboard.remember_me') !!}</label>
                    </div>
                </div>
                <!-- Form Group (login box)-->
                <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                    <a class="small"
                       href="{!! route('admin.forget.password') !!}">{!! __('dashboard.forget_your_password') !!}</a>
                    <button type="submit" class="btn btn-primary">{!! __('dashboard.login') !!}</button>
                </div>
            </form>
        </div>

    </div>
@endsection
