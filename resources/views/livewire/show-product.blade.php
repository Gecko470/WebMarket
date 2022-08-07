<div>
    <div wire:loading class="w-full">
        <div class="loader mx-auto"></div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700">
        <div class="p-4 shadow-lg">
            <div>
                <h2 class="font-semibold text-5xl capitalize">{{ $product->name }}</h2>
            </div>

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
            <div class="py-2 mt-12 px-4 font-semibold">
                <h2 class="text-xl">Descripción</h2>
                <p>{{ $product->description }}</p>
            </div>

            @can('valoraciones', $product)
            <div class="mt-4 px-4" x-data="{ ratio : 5}">
                <form action="{{ route('valoraciones', ['product' => $product]) }}" method="POST">
                    @csrf
                    <div>
                        <label for="" class="font-semibold">Deja tu valoración: </label>
                    </div>
                    <ul class="flex mb-2">
                        <li x-bind:class="ratio >= 1 ? 'text-yellow-500' : ''"><button type="button"
                                x-on:click="ratio = 1"><i class="fas fa-star"></i></button></li>
                        <li x-bind:class="ratio >= 2 ? 'text-yellow-500' : ''"><button type="button"
                                x-on:click="ratio = 2"><i class="fas fa-star"></i></button></li>
                        <li x-bind:class="ratio >= 3 ? 'text-yellow-500' : ''"><button type="button"
                                x-on:click="ratio = 3"><i class="fas fa-star"></i></button></li>
                        <li x-bind:class="ratio >= 4 ? 'text-yellow-500' : ''"><button type="button"
                                x-on:click="ratio = 4"><i class="fas fa-star"></i></button></li>
                        <li x-bind:class="ratio >= 5 ? 'text-yellow-500' : ''"><button type="button"
                                x-on:click="ratio = 5"><i class="fas fa-star"></i></button></li>
                    </ul>
                    <textarea name="comment" class="w-full"></textarea>
                    <x-jet-input-error for="comment" />
                    <div class="flex justify-end">
                        <input name="ratio" class="hidden" x-model="ratio" type="number">
                        <x-jet-input-error for="ratio" />
                        <x-jet-button>
                            Enviar
                        </x-jet-button>
                    </div>
                </form>
            </div>
            @endcan

            @if ($product->valoraciones->isNotEmpty())
            <div class="py-2 mt-4 px-4 font-semibold">
                <h2 class="text-xl mb-2">Valoraciones</h2>
                @foreach ($product->valoraciones as $valoracion )
                <div class="flex justify-between items-center gap-2 my-2">
                    <div class="flex gap-2 items-center">
                        <div>
                            <img class="rounded-full w-8 h-auto flex-shrink-0"
                                src="{{ $valoracion->user->profile_photo_url }}" alt="{{ $valoracion->user->name }}">
                        </div>
                        <div class="w-full">
                            <p class="font-semibold">{{ $valoracion->user->name }}</p>
                            <p class="text-sm">{{ $valoracion->created_at->diffforHumans() }}</p>
                            <div>
                                <p>{{ $valoracion->comment }}</p>
                            </div>
                        </div>
                    </div>

                    <div>{{ $valoracion->ratio }} <i class="fas fa-star text-yellow-500"></i></div>
                </div>
                @endforeach
            </div>
            @endif

        </div>
        <div class="shadow-lg p-10 sm:p-20">
            <div class="cursor-pointer">
                <a class="text-lg text-red-600" href="{{ route('home') }}">
                    <span>Volver</span>
                </a>
            </div>

            <div class="py-3 mt-4">
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

            @if ($product->valoraciones->isNotEmpty())
            <div class="py-3">
                <h2 class="font-semibold text-xl">Valoraciones</h2>
                <div class="flex items-center gap-2">
                    <p>{{ $product->valoraciones->avg('ratio') }} <i class="fas fa-star text-yellow-500"></i></p>
                    <p class="font-semibold">{{ $product->valoraciones->count()}} Valoración/es</p>
                </div>
            </div>
            @endif


            @livewire('add-cart', ['product' => $product])

        </div>
    </div>
</div>
