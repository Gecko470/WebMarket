<div class="container mx-auto pt-12 pb-20">
    <div class="mb-8">
        <x-jet-form-section submit='saveProvincia' class="mb-6">
            <x-slot name='title'>
                <p class="text-gray-700 text-2xl font-semibold">Nueva Provincia</p>
            </x-slot>
            <x-slot name='description'>
                Completa los campos para crear una nueva provincia
            </x-slot>
            <x-slot name='form'>
                <div class="col-span-4">
                    <x-jet-label>Nombre</x-jet-label>
                    <x-jet-input type='text' class="w-full" wire:model='provinciaForm.name' />
                    <x-jet-input-error for='provinciaForm.name' />
                </div>
                <div class="col-span-4">
                    <x-jet-label>Coste envío</x-jet-label>
                    <x-jet-input type='number' step="0.01" class="w-full" wire:model='provinciaForm.coste_envio' />
                    <x-jet-input-error for='provinciaForm.coste_envio' />
                </div>
            </x-slot>
            <x-slot name='actions'>
                <x-jet-action-message class="mr-6 text-xl font-semibold text-red-600" on='provincia_guardado'>
                    Provincia agregada !
                </x-jet-action-message>
                <x-jet-button>
                    Guardar
                </x-jet-button>
            </x-slot>
        </x-jet-form-section>

        <x-jet-action-section>
            <x-slot name='title'>
                <p class="text-gray-700 text-2xl font-semibold">Provincias</p>
            </x-slot>
            <x-slot name='description'>Listado de todas las provincias</x-slot>
            <x-slot name='content'>
                <table>
                    <thead class="border-b border-gray-300">
                        <tr>
                            <th class="w-full text-left">Nombre</th>
                            <th class="px-2 sm:px-12 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-300">
                        @foreach ($provincias as $provincia)
                        <tr>
                            <td class="py-1 capitalize">
                                <a href="{{ route('admin.provincias.edit', $provincia)}}">{{ $provincia->name }} <i
                                        class="fa-solid fa-arrow-trend-up text-red-500"></i></a>
                            </td>
                            <td>
                                <div class="flex items-center justify-center">
                                    <a class="text-blue-600 mx-2 cursor-pointer"
                                        wire:click="edit({{ $provincia->id }})"><i class="fas fa-edit"></i></a>
                                    <a class="text-red-600 mx-2 cursor-pointer"
                                        wire:click="$emit('deleteProvincia', {{ $provincia->id }})"><i
                                            class="fas fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </x-slot>
        </x-jet-action-section>
    </div>

    <x-jet-dialog-modal wire:model='provinciaEdit.open'>
        <x-slot name='title' class="text-3xl">
            Editar Provincia
        </x-slot>
        <x-slot name='content'>
            <div class="space-y-3">
                <div class="col-span-4">
                    <x-jet-label>Nombre</x-jet-label>
                    <x-jet-input type='text' class="w-full capitalize" wire:model='provinciaEdit.name' />
                    <x-jet-input-error for='provinciaEdit.name' />
                </div>
                <div class="col-span-4">
                    <x-jet-label>Coste envío</x-jet-label>
                    <x-jet-input type='number' class="w-full" wire:model='provinciaEdit.coste_envio' />
                    <x-jet-input-error for='provinciaEdit.coste_envio' />
                </div>
            </div>
        </x-slot>
        <x-slot name='footer'>
            <x-jet-danger-button class="mr-4" wire:click="$set('provinciaEdit.open', false)">
                Cancelar
            </x-jet-danger-button>
            <x-jet-button wire:click="update" wire:loading.attr='disabled' wire:target='update'>
                Actualizar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

    @push('js')
    <script>
        Livewire.on('deleteProvincia', id => {
            Swal.fire({
            title: 'Quieres eliminar esta provincia?',
            showDenyButton: true,
            confirmButtonText: 'Eliminar',
            denyButtonText: `Cancelar`,
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
            Swal.fire('Provincia eliminada!', '', 'success');
            Livewire.emit('delete', id);
            } else if (result.isDenied) {
            Swal.fire('Operación cancelada', '', 'info')
            }
            });
            });
    </script>
    @endpush
</div>
