<div class="bg-white text-gray-700 shadow-lg rounded-lg p-2 sm:p-6 mt-6 relative mx-2 xl:mx-0">
    <h2 class="text-2xl font-semibold mb-4">Pedidos realizados</h2>
    <div wire:loading.flex class="absolute w-full h-full bg-gray-200 bg-opacity-50 z-20 items-center justify-center">
        <div class="loader"></div>
    </div>
    @forelse ($orders as $order)
    <div>
        <a class="my-4 p-4 font-semibold hover:bg-gray-200 flex items-center gap-4"
            href="{{ $order->status == 0 ? route('order.payment', $order) : route('order.show', $order) }}">
            <span>
                @switch($order->status)
                @case(0)
                <i class="fas fa-business-time text-gray-600 text-lg sm:text-2xl"></i>
                @break
                @case(1)
                <i class="fas fa-credit-card text-green-600 text-lg sm:text-2xl"></i>
                @break
                @case(2)
                <i class="fas fa-truck text-yellow-600 text-lg sm:text-2xl"></i>
                @break
                @case(3)
                <i class="fas fa-check-circle text-pink-600 text-lg sm:text-2xl"></i>
                @break
                @case(4)
                <i class="fas fa-times-circle text-red-600 text-lg sm:text-2xl"></i>
                @break
                @default

                @endswitch
            </span>
            <div class="text-sm sm:text-md">
                <p>Pedido nº {{ $order->id }}</p>
                <p>Importe total {{ $order->total }}&#128;</p>
                <p>Fecha {{ $order->updated_at->format('d-m-Y') }}</p>
            </div>
            <div class="text-sm sm:text-md ml-auto flex flex-col items-end">
                <span class="font-bold">
                    @switch($order->status)
                    @case(0)
                    Pendiente
                    @break
                    @case(1)
                    Pagado
                    @break
                    @case(2)
                    Enviado
                    @break
                    @case(3)
                    Recibido
                    @break
                    @case(4)
                    Anulado
                    @break
                    @default

                    @endswitch
                </span>
                <div class="ml-auto">
                    {{ $order->total }}&#128;
                </div>
            </div>
            <span>
                <i class="fas fa-angle-right font-bold"></i>
            </span>
        </a>
    </div>
    @empty
    <p>Aún no has realizado ningun pedido</p>
    @endforelse
</div>
