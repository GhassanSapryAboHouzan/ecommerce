@extends('layouts.frontend')

@section('content')
    <!-- HERO SECTION-->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
                <div class="col-lg-6">
                    <h1 class="h2 text-uppercase mb-0">{!! __('customAuth.register') !!}</h1>
                </div>
                <div class="col-lg-6 text-lg-right">
                </div>
            </div>
        </div>
    </section>


    <section class="py-5">
        <div class="row">
            <div class="col-6 offset-3">
                <h2 class="h5 text-uppercase mb-4">{!! __('customAuth.register') !!}</h2>
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="row">
                        <!-------------------------  First Name  ------------------->
                        <div class="col-12">
                            <div class="form-group">
                                <label for="first_name" class="text-sm text-uppercase">
                                    {!! __('customAuth.first_name') !!}:
                                </label>
                                <input id="first_name" name="first_name"
                                       type="text" class="form-control form-control-lg"
                                       value="{{ old('first_name') }}" autocomplete="off"
                                placeholder="{!! __('customAuth.enter_first_name') !!}">
                                @error('first_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-------------------------  Last Name  ------------------->
                        <div class="col-12">
                            <div class="form-group">
                                <label for="last_name" class="text-sm text-uppercase">
                                    {!! __('customAuth.last_name') !!}:
                                </label>
                                <input id="last_name" name="last_name"
                                       type="text" class="form-control form-control-lg"
                                       value="{{ old('last_name') }}" autocomplete="off"
                                       placeholder="{!! __('customAuth.enter_last_name') !!}">
                                @error('last_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-------------------------  User Name  ------------------->
                        <div class="col-12">
                            <div class="form-group">
                                <label for="username" class="text-sm text-uppercase">
                                    {!! __('customAuth.username') !!}:
                                </label>
                                <input id="username" name="username"
                                       type="text" class="form-control form-control-lg"
                                       value="{{ old('username') }}" autocomplete="off"
                                       placeholder="{!! __('customAuth.enter_username') !!}">
                                @error('username')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

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

                        <!-------------------------  mobile  ------------------->
                        <div class="col-12">
                            <div class="form-group">
                                <label for="mobile" class="text-sm text-uppercase">
                                    {!! __('customAuth.mobile') !!}:
                                </label>
                                <input id="mobile" name="mobile"
                                       type="text" class="form-control form-control-lg"
                                       value="{{ old('mobile') }}" autocomplete="off"
                                       placeholder="{!! __('customAuth.enter_mobile') !!}">
                                @error('mobile')
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
                                       type="password" class="form-control form-control-lg"
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
                                       type="password" class="form-control form-control-lg"
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
                                    {!! __('customAuth.register') !!}
                                </button>

                                @if (Route::has('login'))
                                    <a class="btn btn-link" href="{{ route('login') }}">
                                        {{ __('customAuth.have_any_account') }}
                                    </a>
                                @endif
                            </div>
                        </div>

                    </div>


                </form>
            </div>
        </div>
    </section>
@endsection
