@extends('layouts.app')

@section('title', 'Butik Online - Temukan Gaya Unikmu')

@section('content')
<!-- Page: Home -->
<div id="home">
    @include('home.components.hero')
    @include('home.components.categories')
    @include('home.components.featured-products')
    @include('home.components.custom-cta')
</div>
@endsection