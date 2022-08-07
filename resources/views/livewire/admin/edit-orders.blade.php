<div class="container mx-auto pb-14">

    <div class="flex justify-between items-center mt-10">
        <h2 class="font-semibold text-3xl text-gray-700">Pedidos</h2>
    </div>


    <div class="flex justify-between items-end">
        <div class="lg:flex lg:gap-8">
            <div class="py-4 w-28">
                <label class="font-medium">Núm. Pedido</label>
                <x-jet-input type="text" placeholder="Buscar.." class="w-full" wire:model='pedidoF' />
            </div>
            <div class="py-4 w-56 lg:mx-3">
                <label class="font-medium">Cliente</label>
                <x-jet-input type="text" placeholder="Buscar.." class="w-full" wire:model='clienteF' />
            </div>
            <div class="py-4">
                <label class="font-medium">Recogida</label>
                <div>
                    <select wire:model='recogidaF'>
                        <option value="">Todos..</option>
                        <option value="1">Recogida en tienda</option>
                        <option value="2">Envío a domicilio</option>
                    </select>
                </div>
            </div>
            <div class="py-4">
                <label class="font-medium">Status</label>
                <div>
                    <select wire:model='statusF'>
                        <option value="">Todos..</option>
                        <option value="0">Pendiente</option>
                        <option value="1">Pagado</option>
                        <option value="2">Enviado</option>
                        <option value="3">Entregado</option>
                        <option value="4">Anulado</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="py-4">
            <button class="btn btn-danger" wire:click="borrar()">Borrar filtros</button>
        </div>
    </div>

    <x-table>
        @if ($orders->count())
        <table class="min-w-full">
            <thead class="bg-white border-b">
                <tr>
                    <th scope="col" class="text-md font-medium text-gray-900 px-6 py-4 text-center">
                        #
                    </th>
                    <th scope="col" class="text-md font-medium text-gray-900 px-10 py-4 text-left">
                        Cliente
                    </th>
                    <th scope="col" class="text-md font-medium text-gray-900 px-6 py-4 text-center">
                        Ciudad
                    </th>
                    <th scope="col" class="text-md font-medium text-gray-900 px-6 py-4 text-center">
                        Provincia
                    </th>
                    <th scope="col" class="text-md font-medium text-gray-900 px-6 py-4 text-center">
                        Coste envío
                    </th>
                    <th scope="col" class="text-md font-medium text-gray-900 px-6 py-4 text-center">
                        Total
                    </th>
                    <th scope="col" class="text-md font-medium text-gray-900 px-6 py-4 text-center">
                        Tipo de recogida
                    </th>
                    <th scope="col" class="text-md font-medium text-gray-900 px-6 py-4 text-center">
                        Status
                    </th>
                    <th scope="col" class="text-md font-medium text-gray-900 px-6 py-4 text-center">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                @php
                $envio = json_decode($order->envio)
                @endphp
                <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                    <td class="text-sm font-light px-6 py-4 text-center">
                        {{ $order->id }}
                    </td>
                    <td class="text-sm font-light px-6 py-4">
                        {{ $order->user->name}}
                    </td>
                    <td class="text-sm font-light px-6 py-4 whitespace-nowrap text-center capitalize">
                        @if($envio->ciudad )
                        {{ $envio->ciudad }}
                        @else
                        <span class="text-red-500"> - </span>
                        @endif
                    </td>
                    <td class="text-sm font-light px-6 py-4 whitespace-nowrap text-center capitalize">
                        @if($envio->provincia)
                        {{ $envio->provincia }}
                        @else
                        <span class="text-red-500"> - </span>
                        @endif
                    </td>
                    <td class="text-sm font-light px-6 py-4 capitalize text-center">
                        {{ $order->coste_envio }} €
                    </td>
                    <td class="text-sm font-light px-6 py-4 whitespace-nowrap text-center">
                        {{ $order->total }} €
                    </td>
                    <td class="text-sm font-light px-6 py-4 whitespace-nowrap text-center">
                        @switch($order->tipo_recogida)
                        @case(1)
                        <span>Recogida en tienda</span>
                        @break
                        @case(2)
                        <span>Envío a domicilio</span>
                        @break

                        @default

                        @endswitch
                    </td>
                    <td class="text-sm text-center font-light px-6 py-4">
                        @switch($order->status)
                        @case(0)
                        <span>Pendiente</span>
                        @break
                        @case(1)
                        <span class="text-blue-500">Pagado</span>
                        @break
                        @case(2)
                        <span class="text-yellow-600">Enviado</span>
                        @break
                        @case(3)
                        <span class="text-green-500">Entregado</span>
                        @break
                        @case(4)
                        <span class="text-red-500">Anulado</span>
                        @break

                        @default

                        @endswitch
                    </td>
                    <td class="text-sm font-light px-6 py-4">
                        <div class="flex justify-center gap-4">
                            <a href="{{ route('admin.orders.edit', $order)}}"><i
                                    class="fa-solid fa-pen-to-square text-blue-600"></i></a>
                            <a class="cursor-pointer" wire:click="$emit('alert', {{ $order->id }})"><i
                                    class="fa-solid fa-trash-can text-red-600"></i></a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div>
            No se han encontrado resultados..
        </div>
        @endif

    </x-table>


    @if ($orders->hasPages())
    <div class="mt-4">
        {{ $orders->links() }}
    </div>
    @endif


    @push('js')
    <script>
        Livewire.on('alert', id => {
            Swal.fire({
            title: 'Quieres eliminar este pedido?',
            showDenyButton: true,
            confirmButtonText: 'Eliminar',
            denyButtonText: `Cancelar`,
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
            Swal.fire('Pedido eliminado!', '', 'success');
            Livewire.emit('delete', id);
            } else if (result.isDenied) {
            Swal.fire('Operación cancelada', '', 'info')
            }
            });
            });
    </script>
    @endpush
</div>
