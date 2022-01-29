@extends('layouts.frontend')

@section('content')
    @include('frontend.index.hero')
    @include('frontend.index.categories')
    <livewire:frontend.featured-product/>
    @include('frontend.index.services')
    @include('frontend.index.newsletter')
@endsection
