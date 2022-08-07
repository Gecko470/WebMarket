<x-app-layout>
    <div class="container mx-auto py-8 text-gray-700">
        <div class="md:grid md:grid-cols-5 md:gap-4">
            <div class="md:col-span-3">
                <div
                    class="bg-white shadow-lg rounded-lg px-6 py-4 mb-6 text-xl lg:text-2xl mx-2 xl:mx-0 flex justify-between items-center">
                    <p><span class="font-semibold">Pedido nº</span> {{ $order->id }}</p>
                    <a class="cursor-pointer mx-2 text-lg text-red-600" href="{{ route('aPersonal') }}">
                        <span>Volver</span>
                    </a>
                </div>

                <div class="bg-white shadow-lg rounded-lg p-6 mb-6 md:grid md:grid-cols-3 md:gap-6  mx-2 xl:mx-0">
                    <div class="md:col-span-1">
                        <p class="text-xl lg:text-2xl font-semibold mb-4">Recogida</p>
                        @if ($order->tipo_recogida == 1)
                        <p class="text-sm md:text-md">Recogida en tienda WebMarket</p>
                        <p class="text-sm md:text-md">Dirección: C/Echegary 128, Barcelona</p>
                        @else
                        <p class="text-xl">Envío a domicilio</p>
                        <p class="text-sm md:text-md capitalize">{{ $envio->address }}</p>
                        <p class="text-sm md:text-md capitalize">{{ $envio->ciudad }}, {{
                            $envio->provincia }}</p>
                        @endif
                    </div>
                    <div class="md:col-span-2">
                        <p class="text-xl lg:text-2xl font-semibold mb-4">Resumen</p>
                        <table class="w-full">
                            <thead>
                                <tr class="text-center text-sm lg:text-lg">
                                    <th></th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Sutotal</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700">
                                @foreach ($items as $item )
                                <tr class="text-center">
                                    <td>
                                        <div class="hidden lg:flex lg:items-center">
                                            <img class="w-15 h-10 object-cover object-center mr-2 lg:mr-6"
                                                src="{{ $item->attributes->img }}" alt="{{ $item->name }}">
                                            <h2 class="capitalize font-bold">{{ $item->name }}</h2>
                                        </div>
                                    </td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->price }}&#128;</td>
                                    <td>{{ $item->quantity * $item->price }}&#128;</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="md:col-span-2 mx-2 xl:mx-0">
                @livewire('stripe-payment', ['order' => $order])
            </div>
        </div>
    </div>
</x-app-layout>
