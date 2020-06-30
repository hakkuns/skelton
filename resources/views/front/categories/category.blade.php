@extends('layouts.front.app')

@section('og')
    <meta property="og:type" content="category"/>
    <meta property="og:title" content="{{ $category->name }}"/>
    <meta property="og:description" content="{{ $category->description }}"/>
@endsection

@section('content')
            <div class="container product">
                <div class="row">
                    <div class="col-md-12">
                            <ol class="breadcrumb">
                                <li><a href="{{ route('home') }}">Home</a></li>
                                @if(isset($category))
                                <li><a href="{{ route('front.category.slug', $category->slug) }}">{{ $category->name }}</a></li>
                                @endif
                            </ol>
                    </div>
                </div>
            </div>

            <section class="jumbotron text-center" style="background-color: #ffffff">
                <div class="container">
                    <h2 class="jumbotron-heading">{{ $category->name }}</h1>
                    <p class="lead text-muted">{{ $category->description }}</p>
                </div>
            </section>

        <!-- div class="col-md-3">
            @include('front.categories.sidebar-category')
        </div-->
        <div class="py-5 bg-light">
            <div class="container">
                <div class="row">
                @include('front.products.product-list', ['products' => $products])
                </div>
            </div>
        </div>
@endsection
