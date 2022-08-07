<div class="my-8">
    <div wire:loading class="w-full">
        <div class="loader mx-auto"></div>
    </div>
    <div wire:init="load" wire:target="products" class="text-gray-700">
        @if ($products->count())
        <div class="grid grid-cols-1 md:grid-cols-2 mb-6 mx-auto gap-4">
            <div class="mx-auto">
                <img class="rounded w-full h-full object-cover object-center"
                    src="{{ Storage::url($products->first()->subcategory->img) }}"
                    alt="{{ $products->first()->subcategory->name }}">
            </div>
            <div class="shadow-lg p-8">
                <a class="mx-2 text-lg text-red-600"
                    href="{{ route('showcategory', $products->first()->category->id) }}">
                    <span>Volver</span>
                </a>
                <h2 class="font-semibold text-2xl mx-2 mt-4">Categoría: {{ $products->first()->category->name }}</h2>
                <h2 class="font-semibold text-2xl mt-4 mx-2">Subcategoría: {{ $products->first()->subcategory->name }}
                </h2>
                <div class="w-full mt-8">
                    <x-jet-dropdown align='left' width="w-52">
                        <x-slot name='trigger'>
                            <span>
                                <button type="button"
                                    class="flex items-center justify-between w-52 px-2 py-2 shadow-gray-400 text-xl leading-4 font-semibold transition border">
                                    <div>Marcas</div>
                                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </span>
                        </x-slot>

                        <x-slot name='content'>
                            <x-jet-dropdown-link wire:click="$set('marca', 'todas')"
                                class="capitalize font-semibold text-lg cursor-pointer">Todas
                            </x-jet-dropdown-link>
                            @if($marca == 'todas')
                            @foreach ($products->first()->subcategory->brands as $brand )
                            <x-jet-dropdown-link wire:click="$set('marca', '{{ $brand->name }}')"
                                class="capitalize font-semibold text-lg cursor-pointer">{{
                                $brand-> name}}
                            </x-jet-dropdown-link>
                            @endforeach
                            @else
                            <x-jet-dropdown-link wire:click="$set('marca', '{{ $products->first()->brand->name }}')"
                                class="capitalize font-semibold text-lg cursor-pointer">
                                {{ $products->first()->brand->name }}
                            </x-jet-dropdown-link>
                            @endif

                        </x-slot>
                    </x-jet-dropdown>
                </div>
            </div>
        </div>

        <div class="flex shadow-lg py-2 px-4 items-center justify-between gap-2 mx-auto mb-12">
            <div>
                <h2 class="font-semibold text-red-600 text-3xl">Productos</h2>
            </div>
            <div class="flex items-center gap-2">
                <div class="hover:text-red-600 {{ $grid ? 'text-red-600' : ''}} cursor-pointer"
                    wire:click="$set('grid', true)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                        class="bi bi-grid-3x3-gap" viewBox="0 0 16 16">
                        <path
                            d="M4 2v2H2V2h2zm1 12v-2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1zm0-5V7a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1zm0-5V2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1zm5 10v-2a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1zm0-5V7a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1zm0-5V2a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1zM9 2v2H7V2h2zm5 0v2h-2V2h2zM4 7v2H2V7h2zm5 0v2H7V7h2zm5 0h-2v2h2V7zM4 12v2H2v-2h2zm5 0v2H7v-2h2zm5 0v2h-2v-2h2zM12 1a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-2zm-1 6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1V7zm1 4a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-2a1 1 0 0 0-1-1h-2z" />
                    </svg>
                </div>
                <div class="hover:text-red-600 {{ $grid ? '' : 'text-red-600'}} cursor-pointer"
                    wire:click="$set('grid', false)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        class="bi bi-list" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                    </svg>
                </div>
            </div>
        </div>

        @if($grid)
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 mt-3 mx-auto mb-16 gap-4">
            @foreach($products as $product)
            <div class="shadow-lg p-2">
                <a href="{{ route('show', $product) }}">
                    <img class="rounded h-32 md:h-48 w-full object-cover object-center"
                        src="{{ Storage::url($product->images()->first()->url) }}" alt="{{ $product->name }}">
                    <div class="w-auto px-2 py-4 flex justify-between">
                        <div>
                            <p class="font-semibold text-sm md:text-lg capitalize">{{ $product->name }}</p>
                            <ul class="flex items-center">
                                <li><i class="fas fa-star text-yellow-400 text-sm"></i></li>
                                <li><i class="fas fa-star text-yellow-400 text-sm"></i></li>
                                <li><i class="fas fa-star text-yellow-400 text-sm"></i></li>
                                <li><i class="fas fa-star text-yellow-400 text-sm"></i></li>
                                <li><i class="fas fa-star text-yellow-400 text-sm"></i></li>
                                <span class="text-sm font-semibold ml-2">(18)</span>
                            </ul>
                        </div>
                        <div>
                            <p class="font-semibold text-sm md:text-lg">{{ $product->price }}&#128;</p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        {{ $products->links() }}
        @else
        <div class="flex flex-col mt-8">
            <div class="overflow-x-auto mb-12 sm:-mx-6 lg:-mx-8">
                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-hidden">
                        <table class="min-w-full">
                            <thead class="bg-white border-b">
                                <tr>
                                    <th scope="col" class="text-md font-semibold text-gray-900 px-6 py-4 text-center">
                                        Nombre
                                    </th>
                                    <th scope="col" class="text-md font-semibold text-gray-900 px-6 py-4 text-center">
                                        Imagen
                                    </th>
                                    <th scope="col" class="text-md font-semibold text-gray-900 px-6 py-4 text-center">
                                        Precio
                                    </th>
                                    <th scope="col" class="text-md font-semibold text-gray-900 px-6 py-4 text-center">
                                        Categoría
                                    </th>
                                    <th scope="col" class="text-md font-semibold text-gray-900 px-6 py-4 text-center">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                                    <td
                                        class="text-sm text-gray-900 font-light capitalize px-6 py-4 whitespace-nowrap text-center">
                                        {{
                                        $product->name }}</td>
                                    <td
                                        class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-center">
                                        <div class="flex items-center justify-center">
                                            <img class="w-28" src="{{ Storage::url($product->images()->first()->url) }}"
                                                alt="{{ $product->name }}">
                                        </div>
                                    </td>
                                    <td
                                        class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-center">
                                        {{
                                        $product->price }}&#128;</td>
                                    <td
                                        class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-center">
                                        {{
                                        $product->category->name }}</td>
                                    <td class="text-sm text-red-600 font-light px-6 py-4 whitespace-nowrap text-center">
                                        <a href="{{ route('show', $product) }}">Ver..</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{ $products->links() }}
        </div>
        @endif

        @else
        <div>
            <div class="flex justify-between items-center">
                <div>
                    No hay productos disponibles..
                </div>
                <a class="mx-2 text-xl text-red-600" href="{{ route('home') }}">
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

        </div>
        @endif
    </div>
</div>
