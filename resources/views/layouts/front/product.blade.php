<div class="row">
    <div class="col-md-6">
        <div class="product-image-box">
            
            <figure class="text-center product-cover-wrap">
                @if(isset($product->cover))
                    <img id="main-image" class="product-cover img-responsive"
                        src="{{ asset("storage/$product->cover") }}?w=400"
                        style="max-width: 100%; height: auto;"/>
                @else
                    <img id="main-image" class="product-cover" src="https://placehold.it/300x300"
                        data-zoom="{{ asset("storage/$product->cover") }}?w=1200" alt="{{ $product->name }}">
                @endif
            </figure>
            <hr>
            <div class="thumbnailbox">

                @if(isset($product->cover))
                    <img class="img-responsive img-thumbnail"
                        src="{{ asset("storage/$product->cover") }}"
                        alt="{{ $product->name }}" />
                @else
                    <img class="img-responsive img-thumbnail"
                        src="{{ asset("https://placehold.it/180x180") }}"
                        alt="{{ $product->name }}" />
                @endif
                   
                @if(isset($images) && !$images->isEmpty())
                    @foreach($images as $image)
                        <img class="img-responsive img-thumbnail"
                            src="{{ asset("storage/$image->src") }}"
                            alt="{{ $product->name }}" />
                    @endforeach
                @endif
               
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="product-description">
            <h1>{{ $product->name }}
            </h1>
            <strong>{{ config('cart.currency') }} {{ $product->price }}</strong>
            <div class="description">{!! $product->description !!}</div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    @include('layouts.errors-and-messages')
                    <form action="{{ route('cart.store') }}" method="post">
                        {{ csrf_field() }}
                        @if(isset($productAttributes) && !$productAttributes->isEmpty())
                            <div class="form-group">
                                <select name="productAttribute" id="productAttribute" class="form-control select2">
                                    @foreach($productAttributes as $productAttribute)
                                        <option value="{{ $productAttribute->id }}">
                                            @foreach($productAttribute->attributesValues as $value)
                                                {{ $value->attribute->name }} : {{ ucwords($value->value) }}
                                            @endforeach
                                            @if(!is_null($productAttribute->price))
                                                ( {{ config('cart.currency_symbol') }} {{ $productAttribute->price }})
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                            </div><hr>
                        @endif
                        <div class="form-group">
                            <input type="text"
                                   class="form-control"
                                   name="quantity"
                                   id="quantity"
                                   placeholder="数量"
                                   value="{{ old('quantity') }}" />
                            <input type="hidden" name="product" value="{{ $product->id }}" />
                        </div>
                        <button type="submit" class="btn btn-warning">
                            カートに入れる
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>