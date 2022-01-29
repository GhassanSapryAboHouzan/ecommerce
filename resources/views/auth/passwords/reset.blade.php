@extends('layouts.frontend')

@section('content')
    <!-- HERO SECTION-->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
                <div class="col-lg-6">
                    <h1 class="h2 text-uppercase mb-0">{{ __('Reset Password') }}</h1>
                </div>
                <div class="col-lg-6 text-lg-right">

                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="row">
            <div class="col-6 offset-3">
                <h2 class="h5 text-uppercase mb-4">{!! __('customAuth.login') !!}</h2>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="row">
                        <!-------------------------  Email  ------------------->
                        <div class="col-12">
                            <div class="form-group">
                                <label for="email" class="text-sm text-uppercase">
                                    {!! __('customAuth.email') !!}:
                                </label>
                                <input id="email" name="email"
                                       type="text" class="form-control form-control-lg"
                                       value="{{ old('email') }}" autocomplete="off"
                                       placeholder="{!! __('customAuth.enter_email') !!}">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror


                            </div>
                        </div>


                        <!-------------------------  password  ------------------->
                        <div class="col-12">
                            <div class="form-group">
                                <label for="password" class="text-sm text-uppercase">
                                    {!! __('customAuth.password') !!}:
                                </label>
                                <input id="password" name="password"
                                       type="text" class="form-control form-control-lg"
                                       value="{{ old('password') }}" autocomplete="off"
                                       placeholder="{!! __('customAuth.enter_password') !!}">
                                @error('password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror


                            </div>
                        </div>


                        <!-------------------------  password confirmation  ------------------->
                        <div class="col-12">
                            <div class="form-group">
                                <label for="password_confirmation" class="text-sm text-uppercase">
                                    {!! __('customAuth.password_confirmation') !!}:
                                </label>
                                <input id="password_confirmation" name="password_confirmation"
                                       type="text" class="form-control form-control-lg"
                                       value="{{ old('password_confirmation') }}" autocomplete="off"
                                       placeholder="{!! __('customAuth.enter_password_confirmation') !!}">
                                @error('password_confirmation')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror


                            </div>
                        </div>


                        <!------------------------- submit  ------------------->
                        <div class="col-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-dark">
                                    {!! __('customAuth.reset_password') !!}
                                </button>
                            </div>
                        </div>


                    </div>


                </form>
            </div>
        </div>
    </section>
@endsection
