<div class="my-8 text-gray-700 bg-white py-4">
    <div class="shadow-lg px-4 py-4" wire:init="load" wire:target="products">
        <div class="flex items-center gap-2">
            <h2 class="font-semibold uppercase text-xl">Telefonía</h2>
            <a class="text-lg text-red-600 font-semibold" href="{{ route('showcategory', ['id' => 3])}}">Más..</a>
        </div>
        @if (count($products))
        <div class="owl-carousel owl-theme mt-3">
            @foreach($products as $product)
            <div class="item border-2">
                <a href="{{ route('show', $product) }}">
                    <figure>
                        <img class="rounded h-48 w-full object-cover object-center"
                            src=" {{ Storage::url($product->images()->first()->url) }}" alt="{{
                        $product->name }}">
                    </figure>
                    <div class="px-2 py-4 flex justify-between">
                        <div>
                            <p class="font-semibold text-lg capitalize">{{ $product->name }}</p>
                        </div>
                        <div>
                            <p class="font-semibold text-lg">{{ $product->price }}&#128;</p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        @else
        <div class="w-full">
            <div class="loader mx-auto"></div>
        </div>
        @endif
    </div>
</div>
