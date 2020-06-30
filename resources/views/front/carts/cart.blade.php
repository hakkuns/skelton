@extends('layouts.front.app')

@section('content')
        <div class="container product-in-cart-list">
            @if(!$cartItems->isEmpty())
                <div class="row">
                    <div class="col-md-12">
                        <ol class="breadcrumb">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li class="active">Cart</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 content">
                        <div class="box-body">
                            @include('layouts.errors-and-messages')
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <!-- <div class="row header hidden-xs hidden-sm"> -->
                        <div class="row hidden-xs hidden-sm" style="height: 40px;">
                            
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><b>写真</b></div>
                                </div>
                            </div>

                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                <div class="row">
                                    <div class="col-lg-5 col-md-4"><b>名前</b></div>
                                    <div class="col-lg-2 col-md-4"><b>数量</b></div>
                                    <div class="col-lg-2 col-md-1"><b>単価</b></div>
                                    <div class="col-lg-2 col-md-1"><b>合計</b></div>
                                    <div class="col-lg-2 col-md-1"><b></b></div>
                                    <div class="col-lg-2 col-md-1"><b></b></div>
                                </div>
                            </div>

							
							
                        </div>
                        @foreach($cartItems as $cartItem)
                            <div class="row">
                                
                                <div class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                            <a href="{{ route('front.get.product', [$cartItem->product->slug]) }}" class="hover-border">
                                                @if(isset($cartItem->cover))
                                                    <img src="{{$cartItem->cover}}" alt="{{ $cartItem->name }}" class="img-responsive img-thumbnail">
                                                @else
                                                    <img src="https://placehold.it/120x120" alt="" class="img-responsive img-thumbnail">
                                                @endif
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-9 col-xs-8">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                            <h4 style="margin-bottom:5px;">{{ $cartItem->name }}</h4>
                                            @if($cartItem->options->has('combination'))
                                                <div style="margin-bottom:5px;">
                                                @foreach($cartItem->options->combination as $option)
                                                    <small class="label label-primary">{{$option['value']}}</small>
                                                @endforeach
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-8">
                                            <form action="{{ route('cart.update', $cartItem->rowId) }}" class="form-inline" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="put">
                                                <div class="input-group">
                                                    <input type="text" name="quantity" value="{{ $cartItem->qty }}" class="form-control input-sm" />
                                                    <span class="input-group-btn"><button class="btn btn-primary btn-sm">更新</button></span>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                            <span class="hidden-lg hidden-md"><small>単価: </span>
                                            {{config('cart.currency')}} {{ number_format($cartItem->price, 2) }}</small>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                            <span class="hidden-lg hidden-md"><small>合計: </span>
                                            {{config('cart.currency')}} {{ number_format(($cartItem->qty*$cartItem->price), 2) }}</small>
                                        </div>
                                        <div class="col-lg-1 col-md-1 col-sm-8 col-xs-4"> 
                                            <form action="{{ route('cart.destroy', $cartItem->rowId) }}" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="delete">
                                                <button onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">削除</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>                       
                                
                            </div>
                            <br>
                        @endforeach


                    </div>
                </div>
               

                <div class="row">
                    <div class="col-md-12 content">
                        <table class="table table-striped">
                            <tfoot>
                                <tr>
                                    <td>商品代金</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>{{config('cart.currency')}} {{ number_format($subtotal, 2, '.', ',') }}</td>
                                </tr>
                                <tr>
                                    <td>税</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>{{config('cart.currency')}} {{ number_format($tax, 2) }}</td>
                                </tr>
                                <tr>
                                    <td>合計</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>{{config('cart.currency')}} {{ number_format($total, 2, '.', ',') }}</td>
                                </tr>
                            </tfoot>
                        </table>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="">
                                    <a href="{{ route('home') }}" class="btn btn-default">買い物を続ける</a>
                                    <a href="{{ route('checkout.index') }}" class="btn btn-primary">注文する</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-md-12">
                        <p class="alert alert-warning">商品がカートにありません</p>
                    </div>
                </div>
            @endif
        </div>
@endsection
@section('css')
    <style type="text/css">
        .product-description {
            padding: 10px 0;
        }
        .product-description p {
            line-height: 18px;
            font-size: 14px;
        }
    </style>
@endsection