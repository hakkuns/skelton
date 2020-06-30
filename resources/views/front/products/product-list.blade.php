@if(!empty($products) && !collect($products)->isEmpty())
        @foreach($products as $product)

                <div class="col-md-3">
                    <div class="card mb-3 box-shadow">
                        @if(isset($product->cover))
                            <img src="{{ asset("storage/$product->cover") }}" alt="{{ $product->name }}" 
                            class="img-bordered img-responsive"
                            style="width: 100%; display: block;">
                        @else
                            <img src="https://placehold.it/250" alt="{{ $product->name }}" class="card-img-top" />
                        @endif
                        <div class="card-body">

                            <h5 class="card-title">{{ $product->name }}</h5>
                            <hr>
                            <p class="card-text">{!!  str_limit($product->description, 100, ' ...') !!}</p>
                            <a href="{{ route('front.get.product', str_slug($product->slug)) }}" class="btn btn-primary">商品詳細</a>
                        
                        </div>
                    </div>
                </div>
            

        @endforeach
@else
    <p class="alert alert-warning">商品がありません</p>
@endif