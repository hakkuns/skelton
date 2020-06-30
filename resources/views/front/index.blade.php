@extends('layouts.front.app')

@section('content')
    <section class="jumbotron text-center" style="background-color: #ffffff">
        <div class="container">
            <h2 class="jumbotron-heading">Sample</h1>
            <p class="lead text-muted">Welcome to our online store</p>
        </div>
    </section>
    <div class="py-5 bg-light">
        <div class="container">
            <div class="row">
                @foreach($cats as $cat)
                    @if($cat->products->isNotEmpty())
                        <div class="col-md-3">
                            <div class="card mb-3 box-shadow">
                                <div class="card-body">
                    
                                    <h5 class="card-title">{{ $cat->name }}</h5>
                                    <hr>
                                    <p class="card-text">{!!  str_limit($cat->description, 100, ' ...') !!}</p>
                                    <a href="{{ route('front.category.slug', $cat->slug) }}" class="btn btn-primary">商品詳細</a>
                                            
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection