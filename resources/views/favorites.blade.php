@extends('layouts.app')

@section('title', 'Избранное')

@section('content')
<div class="p-4 w-full">
  <div class="text-xl">Избранное</div>
  <div>В избранном находится {{ $favoritesCount }} товаров</div>
  <div class="w-11/12 p-4">
    @foreach ($products as $product)
    <x-product-card :id="$product->id" :name="$product->name" :description="$product->indications"
              :price="$product->price" :imagePath="$product->image_path" :brand="$product->brand"
              :category="$product->category"
              :isFavorite="$favorites ? in_array($product->id, $favorites) : false"/> 
  @endforeach
  </div>

</div>

@endsection