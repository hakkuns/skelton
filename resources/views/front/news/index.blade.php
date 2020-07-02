@extends('layouts.front.app')

@section('content')
    <section class="jumbotron text-center" style="background-color: #ffffff">
        <div class="container">
            <h2 class="jumbotron-heading">Hello</h1>
        </div>
    </section>
    <div class="py-5 bg-light">
        <div class="container">
            <div class="row">
                @foreach($news as $each_news)
                <div class="col-md-3">
                    <div class="card mb-3 box-shadow">
                        <div class="card-body">
            
                            <p class="card-text">{{$each_news->text}}</p>
                                    
                        </div>
                    </div>
                </div>
 
                @endforeach
            </div>
        </div>
    </div>
@endsection