@extends('layouts.front.app')

@section('content')
    <div class="container product-in-cart-list">
        @if(!$products->isEmpty())
            <div class="row">
                <div class="col-md-12">
                    <ol class="breadcrumb">
                        <li><a href="{{ route('home') }}">Home</a></li>
                    </ol>
                </div>
                <div class="col-md-12 content">
                    <div class="box-body">
                        @include('layouts.errors-and-messages')
                    </div>
                    @if(count($addresses) > 0)
                        <div class="row">
                            <div class="col-md-12">
                                
                            <legend>商品</legend>
                            <hr>
                                @include('front.products.product-list-table', compact('products'))
                            </div>
                        </div>
                        <hr>
                        @if(isset($addresses))
                            <div class="row">
                                <div class="col-md-12">
                                    <legend>住所</legend>
                                    <table class="table table-striped">
                                        <thead>
                                            <th>登録名</th>
                                            <th>住所</th>
                                            <th>配送先</th>
                                        </thead>
                                        <tbody>
                                            @foreach($addresses as $key => $address)
                                                <tr>
                                                    <td>{{ $address->alias }}</td>
                                                    <td>
                                                        {{ $address->address_1 }} {{ $address->address_2 }} {{ $address->address_3 }}<br />
                                                    </td>
                                                    <td>
                                                        <label class="col-md-6 col-md-offset-3">
                                                        <input
                                                                type="radio"
                                                                value="{{ $address->id }}"
                                                                name="billing_address"
                                                                @if($billingAddress->id == $address->id) checked="checked"  @endif>
                                                        </label>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <hr>
                        @endif
                        <div class="row">
                            <div class="col-md-12">
                            <legend>ご請求金額</legend>
                                <form action="{{ route('checkout.store') }}" class="form-horizontal" method="post">
                                    {{ csrf_field() }}
                                        <hr>
                                        <ul class="list-unstyled">
                                            <li>商品代金: {{ config('cart.currency_symbol') }} {{ $subtotal }}</li>
                                            <li>税: {{ config('cart.currency_symbol') }} {{ $tax }}</li>
                                            <li>合計: {{ config('cart.currency_symbol') }} {{ $total }}</li>
                                        </ul>
                                        
                                    <hr>
                                    </div>
                                    <div class="">
                                        <a href="{{ route('checkout.index') }}" class="btn btn-default">戻る</a>
                                        <button onclick="return confirm('注文を確定してよろしいですか?')" class="btn btn-primary">注文を確定する</button>
                                        <input type="hidden" class="billing_address" name="billing_address" value="">
                                    </div>
                                </form>           
                            </div>
                        </div>    
                    @else
                        <p class="alert alert-danger"><a href="{{ route('customer.address.create', [$customer->id]) }}">住所が登録されていません</a></p>
                    @endif
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


    <script type="text/javascript">
        $(document).ready(function () {
            let billingAddressId = $('input[name="billing_address"]:checked').val();
            $('.billing_address').val(billingAddressId);
            $('input[name="billing_address"]').on('change', function () {
            billingAddressId = $('input[name="billing_address"]:checked').val();
            $('.billing_address').val(billingAddressId);
            });

        });
    </script>

@endsection