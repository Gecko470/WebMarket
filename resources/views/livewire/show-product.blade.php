<div>
    <div wire:loading class="w-full">
        <div class="loader mx-auto"></div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700">
        <div class="p-4 shadow-lg shadow-gray-700">
            <h2 class="font-semibold text-5xl capitalize">{{ $product->name }}</h2>
            <div class="my-5">
                <div class="flexslider">
                    <ul class="slides">
                        @foreach ($product->images as $item)
                        <li data-thumb="{{ Storage::url($item->url) }}">
                            <img src="{{ Storage::url($item->url) }}" />
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="py-6 mt-12 px-4 font-semibold">
                <h2 class="text-xl">Descripción</h2>
                <p>{{ $product->description }}</p>
            </div>
        </div>
        <div class="shadow-lg shadow-gray-700 p-20">
            <div class="cursor-pointer">
                <a class="mx-2 text-xl text-red-600" wire:click="volver">
                    <div class="flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                        </svg>
                        <span>Volver</span>
                    </div>
                </a>
            </div>

            <div class="py-3">
                <h2 class="font-semibold text-xl">Categoría</h2>
                <span>{{ $product->category->name }}</span>
            </div>

            <div class="py-3">
                <h2 class="font-semibold text-xl">Subcategoría</h2>
                <span>{{ $product->subcategory->name }}</span>
            </div>

            <div class="py-3">
                <h2 class="font-semibold text-xl">Marca</h2>
                <span class="capitalize">{{ $product->brand->name }}</span>
            </div>

            <div class="py-3">
                <h2 class="font-semibold text-xl">Stock disponible</h2>
                <span>{{ $product->stock }} uds.</span>
            </div>

            <div class="py-3">
                <h2 class="font-semibold text-xl">Precio</h2>
                <span>{{ $product->price }}&#128;</span>
            </div>

            @livewire('add-cart', ['product' => $product])

        </div>
    </div>
</div>