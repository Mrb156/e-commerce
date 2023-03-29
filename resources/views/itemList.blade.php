

@foreach($products as $product)
    {{ $product->id }} {{ $product->name }} {{ $product->description }} {{ $product->price }} {{ $product->category_id }}
@endforeach
