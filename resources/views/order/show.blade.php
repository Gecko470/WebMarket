<x-app-layout>
    <div class="container mx-auto py-8 text-gray-700">
        <div
            class="bg-white shadow-lg rounded-lg px-6 py-4 mb-6 text-xl lg:text-2xl mx-2 xl:mx-0 flex justify-between items-center">
            <p><span class="font-semibold">Pedido nº</span> {{ $order->id }}</p>
            <a class="cursor-pointer mx-2 text-xl text-red-600" href="{{ url()->previous() }}">
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

        <div class="bg-white shadow-lg rounded-lg px-10 py-10 mb-6 mx-2 xl:mx-0">
            <div class="flex items-center w-full">
                <div class="flex-col relative">
                    <div
                        class="rounded-full w-10 h-10 {{ ($order->status >= 1 && $order->status != 5) ? 'bg-green-600' : 'bg-gray-500'}} flex items-center justify-center">
                        <i class="fas fa-credit-card text-white"></i>
                    </div>
                    <div class="absolute mt-0.5 -left-1.5">
                        <p>Pagado</p>
                    </div>
                </div>

                <div
                    class="h-1 {{ ($order->status >= 2 && $order->status != 5) ? 'bg-green-600' : 'bg-gray-500'}} mx-2 flex-1">
                </div>

                <div class="flex-col relative">
                    <div
                        class="rounded-full w-10 h-10 {{ ($order->status >= 2 && $order->status != 5) ? 'bg-green-600' : 'bg-gray-500'}} flex items-center justify-center">
                        <i class="fas fa-truck text-white"></i>
                    </div>
                    <div class="absolute mt-0.5 -left-2">
                        <p>Enviado</p>
                    </div>
                </div>

                <div
                    class="h-1 {{ ($order->status >= 3 && $order->status != 5) ? 'bg-green-600' : 'bg-gray-500'}} mx-2 flex-1">
                </div>

                <div class="flex-col relative">
                    <div
                        class="rounded-full w-10 h-10 {{ ($order->status >= 3 && $order->status != 5) ? 'bg-green-600' : 'bg-gray-500'}} flex items-center justify-center">
                        <i class="fas fa-check text-white"></i>
                    </div>
                    <div class="absolute mt-0.5 -left-2">
                        <p>Recibido</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white shadow-lg rounded-lg p-6 mb-6 md:grid md:grid-cols-3 md:gap-6  mx-2 xl:mx-0">
            <div class="md:col-span-1">
                <p class="text-xl lg:text-2xl font-semibold mb-4">Recogida</p>
                @if ($order->tipo_recogida == 1)
                <p class="text-sm md:text-md">Recogida en tienda WebMarket</p>
                <p class="text-sm md:text-md">Dirección: C/Echegary 128, Barcelona</p>
                @else
                @php
                $envio = json_decode($order->envio);
                @endphp
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
                                <div class="flex items-center">
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
                <div class="ml-auto mt-8">
                    <div class="font-semibold flex flex-col items-end">
                        <p class="text-lg">Subtotal {{ $order->total - $order->coste_envio }}&#128;</p>
                        <p class="text-lg">Envío {{ $order->coste_envio }}&#128;</p>
                        <p class="text-2xl">Total {{ $order->total }}&#128;</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
