@extends('layouts.frontend')

@section('content')

    <!-- HERO SECTION-->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
                <div class="col-lg-6">
                    <h1 class="h2 text-uppercase mb-0">{!! __('customAuth.login') !!}</h1>
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

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="username" class="text-sm text-uppercase">
                                    {!! __('customAuth.username') !!}:
                                </label>
                                <input id="username" name="username"
                                       type="text" class="form-control form-control-lg"
                                       value="{{ old('username') }}" autocomplete="off"
                                       autofocus>
                                @error('username')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-12">
                            <div class="form-group">
                                <label for="password" class="text-sm text-uppercase">
                                    {!! __('customAuth.password') !!}:
                                </label>

                                <input id="password" name="password"
                                       type="password" class="form-control form-control-lg"
                                       placeholder="{!! __('customAuth.enter_password') !!}" autocomplete="off">
                                @error('password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-6 form-group">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" name="remember"
                                       id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="custom-control-label text-sm" for="remember">
                                    {{ __('customAuth.remember_me') }}
                                </label>

                            </div>
                        </div>


                        <div class="col-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-dark">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('customAuth.forget_your_password') }}
                                    </a>
                                @endif

                                @if (Route::has('register'))
                                    <a class="btn btn-secondary float-right" href="{{ route('register') }}">
                                        {{ __('customAuth.have_not_account') }}
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
