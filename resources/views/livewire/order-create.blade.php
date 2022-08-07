<div class="container sm:mx-auto pt-10 pb-56 sm:gap-6 sm:flex">
    <div class="w-full sm:w-2/5 text-gray-700">
        <div class="mb-8" x-data="{ tipo_recogida : @entangle('tipo_recogida') }">
            <p class="text-2xl font-semibold mb-2">Recogida</p>
            <label class="bg-white rounded-lg shadow p-6 mb-4 flex items-center">
                <input x-model='tipo_recogida' type="radio" name="tipo_recogida" value="1" class="text-gray-700">
                <span class="ml-2 font-semibold">Recoger en tienda</span>
                <span class="font-semibold ml-auto">Gratis</span>
            </label>

            <div class="bg-white rounded-lg shadow ">
                <label class="p-6 flex items-center">
                    <input x-model='tipo_recogida' type="radio" name="tipo_recogida" value="2" class="text-gray-700">
                    <span class="ml-2 font-semibold">Envío a domicilio</span>
                    <span class="ml-auto">{{ $coste_envio }}&#128;</span>
                </label>
                <div class="hidden" :class="{ 'hidden' : tipo_recogida !=2 }">
                    <div class="px-6 pb-6 grid grid-cols-2 gap-4">
                        <div>
                            <x-jet-label value="Provincia" />
                            <select wire:model='provincia_id'
                                class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm capitalize">
                                <option value="" selected disabled>Selecciona..</option>
                                @foreach ($provincias as $provincia)
                                <option value="{{ $provincia->id }}">{{ $provincia->name }}</option>
                                @endforeach
                            </select>
                            <x-jet-input-error for='provincia_id' />
                        </div>
                        <div>
                            <x-jet-label value="Ciudad" />
                            <select wire:model='ciudad_id'
                                class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm capitalize">
                                <option value="" selected disabled>Selecciona..</option>
                                @foreach ($ciudades as $ciudad)
                                <option value="{{ $ciudad->id }}">{{ $ciudad->name }}</option>
                                @endforeach
                            </select>
                            <x-jet-input-error for='ciudad_id' />
                        </div>
                    </div>
                    <div class="w-full px-6 pb-6">
                        <x-jet-label value='Dirección' />
                        <x-jet-input type='text' class="w-full" wire:model='address' />
                        <x-jet-input-error for='address' />
                    </div>
                    <div class="w-full px-6 pb-6">
                        <x-jet-label value='Observaciones' />
                        <x-jet-input type='text' class="w-full" wire:model='observaciones' />
                    </div>
                </div>
            </div>
        </div>
        <p>Al pulsar Continuar aceptas nuestra <a class="text-red-600" href="#"> Política de Privacidad</a> </p>
        <div class="flex justify-end">
            <button class="bg-red-600 text-white text-xl font-semibold px-4 py-1 my-4 rounded" wire:click="create_order"
                wire:loading.attr="disabled" wire:target="create_order">
                Continuar
            </button>
        </div>
    </div>

    <div class="w-full sm:w-3/5 text-gray-700">
        <p class="text-2xl font-semibold mb-2">Tu carrito</p>
        @if(count($cartContent))
        <div class="w-full bg-white rounded-lg shadow p-4">
            <table class="w-full">
                <thead class="bg-white border-b">
                    <tr>
                        <th scope="col"
                            class="hidden lg:block text-sm md:text-md font-semibold text-gray-700 md:px-6 py-4 text-left">
                            Imagen
                        </th>
                        <th scope="col" class="text-sm md:text-md font-semibold text-gray-700 md:px-6 py-4 text-center">
                            Nombre
                        </th>
                        <th scope="col" class="text-sm md:text-md font-semibold text-gray-700 md:px-6 py-4 text-center">
                            Cantidad
                        </th>
                        <th scope="col" class="text-sm md:text-md font-semibold text-gray-700 md:px-6 py-4 text-center">
                            Precio
                        </th>
                        <th scope="col" class="text-sm md:text-md font-semibold text-gray-700 md:px-6 py-4 text-center">
                            Subtotal
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cartContent as $item)
                    <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                        <td class="hidden lg:block text-gray-700 font-light md:px-4 py-2 whitespace-nowrap">
                            <img class="w-16 md:w-20" src="{{ $item['attributes']['img'] }}" alt="{{ $item['name']}}">
                        </td>
                        <td
                            class="capitalize text-sm md: text-md text-center text-gray-700 font-light px-2 md:px-4 py-2 whitespace-nowrap">
                            {{
                            $item['name']}}</td>
                        <td
                            class="capitalize text-sm md: text-md text-center text-gray-700 font-light px-2 md:px-4 py-2 whitespace-nowrap">
                            {{
                            $item['quantity']}}</td>
                        <td
                            class="text-sm md:text-md text-center text-gray-700 font-light md:px-4 py-2 whitespace-nowrap">
                            {{
                            $item['price'] }}&#128;</td>
                        <td
                            class="text-sm md:text-md text-center text-gray-700 font-light md:px-4 py-2 whitespace-nowrap">
                            {{
                            $item['quantity'] * $item['price'] }}&#128;</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="bg-white rounded-lg shadow">
            <div class="w-full p-4  flex justify-between items-center text-xl text-gray-700 font-semibold mt-10">
                <div>
                    <h4>Subtotal</h4>
                </div>
                <div>{{ Cart::getTotal() }}&#128;</div>
            </div>
            <div class="w-full p-4  flex justify-between items-center text-lg text-gray-700 font-semibold">
                <p>Envío</p>
                @if ($tipo_recogida == 1 || $coste_envio == 0)
                <p>Gratis</p>
                @else
                <p>{{ $coste_envio }}&#128;</p>
                @endif

            </div>
            <div class="w-full p-4  flex justify-between items-center text-2xl text-gray-700 font-semibold">
                <p>Total</p>
                <p>{{ Cart::getTotal() + $coste_envio }}&#128;</p>
            </div>
            @endif
        </div>
    </div>
