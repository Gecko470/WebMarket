<div class="flex flex-col mt-8">
    <div class="flex justify-between items-center w-full px-4 sm:px-0 mb-8">
        <div>
            <a class=" text-xl text-red-600" href="{{ route('home') }}">
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
        @if(count($cartContent))
        <div class="text-red-600 text-md font-semibold">
            <a wire:click="clear" class="cursor-pointer"><i class="fas fa-trash mx-1"></i>Vaciar Carrito</a>
        </div>
        @endif
    </div>
    <h2 class="font-semibold text-3xl text-gray-700 px-4 sm:px-0 ">Carrito</h2>
    @if(count($cartContent))
    <div class="w-full mb-8 py-2 px-4 sm:px-0 ">

        <table class="min-w-full">
            <thead class="bg-white border-b">
                <tr>
                    <th scope="col"
                        class="hidden sm:block text-sm md:text-lg font-semibold text-gray-700 px-1 md:px-6 py-4 text-center w-auto">
                        Imagen
                    </th>
                    <th scope="col"
                        class="text-sm md:text-lg font-semibold text-gray-700 px-2 md:px-6 py-4 text-center w-auto">
                        Nombre
                    </th>
                    <th scope="col"
                        class="text-sm md:text-lg font-semibold text-gray-700 px-1 md:px-6 py-4 text-center w-auto">
                        Precio
                    </th>
                    <th scope="col"
                        class="text-sm md:text-lg font-semibold text-gray-700 px-1 md:px-6 py-4 text-center w-auto">
                        Cantidad
                    </th>
                    <th scope="col"
                        class="text-sm md:text-lg font-semibold text-gray-700 px-1 md:px-6 py-4 text-center w-auto">
                        Subtotal
                    </th>
                    <th scope="col"
                        class="text-sm md:text-lg font-semibold text-gray-700 md:px-6 py-4 text-center w-auto">
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cartContent as $item)
                <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                    <td
                        class="hidden sm:visible sm:flex justify-center text-gray-700 font-light md:px-4 py-2 whitespace-nowrap w-auto">
                        <img class="w-16 md:w-20" src="{{ $item['attributes']['img'] }}" alt="{{ $item['name']}}">
                    </td>
                    <td
                        class="capitalize text-sm md: text-md text-center text-gray-700 font-light px-2 md:px-4 py-2 whitespace-nowrap w-auto">
                        {{
                        $item['name']}}</td>
                    <td
                        class="text-sm md:text-md text-center text-gray-700 font-light md:px-4 py-2 whitespace-nowrap w-auto">
                        {{
                        $item['price'] }}&#128;</td>
                    <td class="text-gray-700 text-sm md:text-md font-light px-2 w-auto">
                        <div class="flex items-center justify-center">
                            <div class="cursor-pointer" wire:click="menosCant({{ $item['id'] }})">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-dash-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z" />
                                </svg>
                            </div>
                            <span class="mx-1 md:mx-2">{{ $item['quantity'] }}</span>
                            <div class="cursor-pointer" wire:click="masCant({{ $item['id'] }})">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-plus-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path
                                        d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                </svg>
                            </div>
                        </div>
                    </td>
                    <td
                        class="text-sm md:text-md text-center text-gray-700 font-light md:px-4 py-2 whitespace-nowrap w-auto">
                        {{
                        $item['quantity'] * $item['price'] }}&#128;</td>
                    <td class="text-sm md:text-md text-center text-red-600 font-light md:px-4 py-2">
                        <button wire:click="removeItem({{ $item['id'] }})"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>


        <div class="w-full flex justify-between items-center text-lg sm:text-2xl text-gray-700 font-semibold mt-10">
            <div class="flex gap-4 mr-8">
                <div>
                    <h3>Subtotal:</h3>
                </div>
                <div>{{ Cart::getTotal() }}&#128;</div>
            </div>
            <div>
                <a class="bg-red-600 text-white sm:text-xl font-semibold px-2 sm:px-4 py-1 rounded"
                    href="{{ route('order.create') }}">
                    Continuar
                </a>
            </div>
        </div>
    </div>
    @else
    <div class="mx-auto flex flex-col items-center gap-4 py-8 text-xl text-gray-700 font-semibold">
        <i class="fa-solid fa-cart-shopping text-3xl"></i>
        <span>Tu carrito está vacío</span>
    </div>
    @endif
</div>
