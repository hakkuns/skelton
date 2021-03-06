@extends('layouts.front.app')

@section('content')
    <!-- Main content -->
    <section class="container content">
        @include('layouts.errors-and-messages')
        <div class="box">
            <form action="{{ route('customer.address.update', [$customer->id, $address->id]) }}" method="post" class="form" enctype="multipart/form-data">
                <input type="hidden" name="status" value="1">
                <input type="hidden" name="_method" value="put">
                <div class="box-body">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="alias">登録名<span class="text-danger">*</span></label>
                        <input type="text" name="alias" id="alias" placeholder="Home or Office" class="form-control" value="{{ old('alias') ?? $address->alias }}">
                    </div>
                    <div class="form-group">
                        <label for="address_1">住所 1 <span class="text-danger">*</span></label>
                        <input type="text" name="address_1" id="address_1" placeholder="住所 1" class="form-control" value="{{ old('address_1') ?? $address->address_1 }}">
                    </div>
                    <div class="form-group">
                        <label for="address_2">住所 2 </label>
                        <input type="text" name="address_2" id="address_2" placeholder="住所 2" class="form-control" value="{{ old('address_2') ?? $address->address_2 }}">
                    </div>
                    <div class="form-group">
                        <label for="address_3">住所 3 </label>
                        <input type="text" name="address_3" id="address_3" placeholder="住所 3" class="form-control" value="{{ old('address_3') ?? $address->address_3 }}">
                    </div>
                    <div class="form-group">
                        <label for="zip">郵便番号 </label>
                        <input type="text" name="zip" id="zip" placeholder="郵便番号" class="form-control" value="{{ old('zip') ?? $address->zip }}">
                    </div>
                    <div class="form-group">
                        <label for="phone">電話番号 </label>
                        <input type="text" name="phone" id="phone" placeholder="電話番号" class="form-control" value="{{ old('phone') ?? $address->phone }}">
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <div>
                        <a href="{{ route('account')}}" class="btn btn-default">戻る</a>
                        <button type="submit" class="btn btn-primary">更新</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection

