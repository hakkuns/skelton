@extends('layouts.front.app')

@section('content')
    <!-- Main content -->
    <section class="container content">
        <div class="row">
            <div class="box-body">
                @include('layouts.errors-and-messages')
            </div>
            <div class="col-md-12">
                <h2>アカウント情報</h2>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h3>名前とメール</h3>
                    Name: {{$customer->name}} <br />
                    Email: {{$customer->email}}
                    <hr><br />
                    <h3>注文履歴</h3>
                    @if(!$orders->isEmpty())
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>日付</td>
                                    <td>合計</td>
                                    <td>状態</td>
                                </tr>
                            </tbody>
                            <tbody>
                                @foreach ($orders as $order)
                                <tr>
                                    <td>
                                        <a data-toggle="modal" data-target="#order_modal_{{$order['id']}}" title="Show order" href="javascript: void(0)">{{ date('M d, Y h:i a', strtotime($order['created_at'])) }}</a>
                                        <!-- Button trigger modal -->
                                        <!-- Modal -->
                                        <div class="modal fade" id="order_modal_{{$order['id']}}" tabindex="-1" role="dialog" aria-labelledby="MyOrders">
                                            <div class="modal-dialog" role="document" style="max-width:800px">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="display: block">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                         <h4 class="modal-title" id="myModalLabel">注文ID #{{$order['reference']}}</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table class="table">
                                                            <thead>
                                                                <th>住所</th>
                                                                <th>お支払方法</th>
                                                                <th>合計</th>
                                                                <th>状態</th>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <address>
                                                                            <strong>{{$order['address']->alias}}</strong><br />
                                                                            {{$order['address']->address_1}} {{$order['address']->address_2}}<br>
                                                                            </address>
                                                                    </td>
                                                                    <td>{{$order['payment']}}</td>
                                                                    <td>{{ config('cart.currency_symbol') }} {{$order['total']}}</td>
                                                                    <td><p class="text-center" style="color: #ffffff; background-color: {{ $order['status']->color }}">{{ $order['status']->name }}</p></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <hr>
                                                        <p>注文詳細:</p>
                                                        <table class="table">
                                                            <thead>
                                                                <th>名前</th>
                                                                <th>数量</th>
                                                                <th>単価</th>
                                                                <th>写真</th>
                                                            </thead>
                                                            <tbody>
                                                            @foreach ($order['products'] as $product)
                                                                <tr>
                                                                    <td>{{$product['name']}}</td>
                                                                    <td>{{$product['pivot']['quantity']}}</td>
                                                                    <td>{{$product['price']}}</td>
                                                                    <td><img src="{{ asset("storage/".$product['cover']) }}" width=50px height=50px alt="{{ $product['name'] }}" class="img-orderDetail"></td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="label @if($order['total'] != $order['total_paid']) label-danger @else label-success @endif">{{ config('cart.currency') }} {{ $order['total'] }}</span>
                                    </td>
                                    <td><p class="text-center" style="color: #ffffff; background-color: {{ $order['status']->color }}">{{ $order['status']->name }}</p></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $orders->links() }}
                    @else
                        <p class="alert alert-warning">まだ注文がありません</p>
                    @endif
                    <hr><br />
                    
                    <h3>住所</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{ route('customer.address.create', auth()->user()->id) }}" class="btn btn-primary">住所を登録する</a>
                            </div>
                        </div>
                        @if(!$addresses->isEmpty())
                            <table class="table">
                                <thead>
                                    <th>名前</th>
                                    <th>住所 1</th>
                                    <th>住所 2</th>
                                    <th>住所 3</th>
                                    <th>郵便番号</th>
                                    <th>電話番号</th>
                                    <th></th>
                                </thead>
                            <tbody>
                                @foreach($addresses as $address)
                                    <tr>
                                        <td>{{$address->alias}}</td>
                                        <td>{{$address->address_1}}</td>
                                        <td>{{$address->address_2}}</td>
                                        <td>{{$address->address_3}}</td>
                                        <td>{{$address->zip}}</td>
                                        <td>{{$address->phone}}</td>
                                        <td>
                                            <form method="post" action="{{ route('customer.address.destroy', [auth()->user()->id, $address->id]) }}" class="form-horizontal">
                                                <div>
                                                    <input type="hidden" name="_method" value="delete">
                                                    {{ csrf_field() }}
                                                    <a href="{{ route('customer.address.edit', [auth()->user()->id, $address->id]) }}" class="btn btn-primary">編集</a>
                                                    <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger"> <i class="fa fa-trash"></i> 削除</button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                            <br /> <p class="alert alert-warning">まだ住所が登録されていません</p>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection
