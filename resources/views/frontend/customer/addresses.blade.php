@extends('layouts.frontend')
@section('content')


    <!-- HERO SECTION-->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
                <div class="col-lg-6">
                    <h1 class="h4 text-uppercase mb-0">{{ auth()->user()->full_name }} Profile</h1>
                </div>
                <div class="col-lg-6 text-lg-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-lg-end mb-0 px-0">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('customer.addresses') }}">Addresses</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>


    <section class="py-5">

        <div class="row">

            <!--begin: content -->
            <div class="col-lg-8">
                <div class="card border-0 rounded-0 p-lg-1">
                    <div class="card-body">
                        <livewire:frontend.customer.addresses-component/>
                    </div>
                </div>
            </div>
            <!--end:content -->

            <!-- SIDEBAR -->
            <div class="col-lg-4">
                @include('frontend.customer.includes.sidebar')
            </div>

        </div>


    </section>

@endsection
