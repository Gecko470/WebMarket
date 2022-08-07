<div class="container mx-auto pb-14">
    <div class="max-w-5xl mx-auto">
        <div class="flex justify-between items-center my-8">
            <h2 class="font-semibold text-3xl text-gray-700">Editar Pedido</h2>
            <a class="cursor-pointer mx-2 text-lg text-red-600" href="{{ route('admin.orders') }}">
                <span>Volver</span>
            </a>
        </div>

        <div class="space-y-3">
            <div>
                <x-jet-label>Núm. Pedido</x-jet-label>
                <x-jet-input type='number' readonly class="w-full" wire:model='orderEdit.id' />
                <x-jet-input-error for='orderEdit.id' />
            </div>
            <div>
                <x-jet-label>Tipo recogida</x-jet-label>
                <select class="w-full" wire:model='orderEdit.tipo_recogida'>
                    <option value="" disabled>Seleccione..</option>
                    <option value="1">Recogida en tienda</option>
                    <option value="2">Envío a domicilio</option>
                </select>
                <x-jet-input-error for='orderEdit.tipo_recogida' />
            </div>
            <div>
                <x-jet-label>Cliente</x-jet-label>
                <select class="w-full capitalize" wire:model='orderEdit.user_id'>
                    <option value="{{ $orderEdit['user_id'] }}" selected>{{ $cliente }}</option>
                </select>
                <x-jet-input-error for='orderEdit.user_id' />
            </div>
            <div>
                <x-jet-label>Dirección</x-jet-label>
                <x-jet-input type='text' class="w-full capitalize" wire:model='orderEdit.address' />
                <x-jet-input-error for='orderEdit.address' />
            </div>
            <div>
                <x-jet-label>Provincia</x-jet-label>
                <select class="w-full capitalize" wire:model='provincia_id'>
                    <option value="" disabled>Seleccione..</option>
                    @foreach ($provincias as $provincia)
                    <option value="{{ $provincia->id }}">{{ $provincia->name }}</option>
                    @endforeach
                </select>
                <x-jet-input-error for='provincia_id' />
            </div>
            <div>
                <x-jet-label>Ciudad</x-jet-label>
                <select class="w-full capitalize" wire:model='orderEdit.ciudad_id'>
                    @if ($ciudades)
                    <option value="" disabled>Seleccione..</option>
                    @foreach ($ciudades as $ciudad)
                    <option value="{{ $ciudad->id }}">{{ $ciudad->name }}</option>
                    @endforeach
                    @endif
                </select>
                <x-jet-input-error for='orderEdit.ciudad_id' />
            </div>
            <div class="border">
                <x-jet-label>Productos</x-jet-label>
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
            </div>
            <div>
                <x-jet-label>Observaciones</x-jet-label>
                <x-jet-input type="text" class="w-full" wire:model='orderEdit.observaciones' />
                <x-jet-input-error for='orderEdit.observaciones' />
            </div>
            <div>
                <x-jet-label>Coste envío</x-jet-label>
                <x-jet-input type="number" class="w-full" wire:model='orderEdit.coste_envio' />
                <x-jet-input-error for='orderEdit.coste_envio' />
            </div>
            <div>
                <x-jet-label>Importe total</x-jet-label>
                <x-jet-input type="number" readonly class="w-full" wire:model='orderEdit.total' />
                <x-jet-input-error for='orderEdit.total' />
            </div>
            <div>
                <x-jet-label>Status</x-jet-label>
                <select class="w-full" wire:model='orderEdit.status'>
                    <option value="" disabled>Seleccione..</option>
                    <option value="0">Pendiente</option>
                    <option value="1">Pagado</option>
                    <option value="2">Enviado</option>
                    <option value="3">Entregado</option>
                    <option value="4">Anulado</option>
                </select>
                <x-jet-input-error for='orderEdit.status' />
            </div>
        </div>
        <div class="mt-5 flex justify-end">
            <x-jet-button wire:click="updateOrder" wire:loading.attr='disabled' wire:target='updateOrder'>
                Actualizar
            </x-jet-button>
        </div>
    </div>
</div>
