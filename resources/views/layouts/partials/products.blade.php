<div class="album py-5 bg-light">
  <div class="container">
    <div class="row">
      @forelse(App\Product::where('status', 1)->get() as $product)
      <div class="col-md-3">
        <div class="card mb-3 shadow-sm">
          <img class="card-img-top img-thumbnail" src="{{ asset('storage/'. $product->thumbnail)}}">
          <div class="card-body">
            <h4 class="card-title">{{ $product->title }}</h4>
            <p class="card-text">{!! substr($product->description,0, 30 ) !!}</p>
            <div class="d-flex justify-content-between align-items-center">
              <div class="btn-group">
                <a type="button" class="btn btn-sm btn-outline-secondary" href="{{route('products.single', $product)}}">View Product</a>
                <a type="button" href="{{route('products.addToCart', $product)}}" class="btn btn-sm btn-outline-secondary">Add to Cart</a>
              </div>
              <small class="text-muted">9 mins</small>
            </div>
          </div>
        </div>
      </div>
      @empty
      <div class="col-md-12">
        <div class="card mb-12 shadow-sm text-center">
          No Category Found
        </div>
      </div>
      @endforelse
    </div>
    <div class="row">
      <div class="col-md-12">
        {{ $products->links() }}
      </div>
    </div>
  </div>
</div>