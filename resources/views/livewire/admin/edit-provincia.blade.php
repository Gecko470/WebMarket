<div class="container mx-auto pt-12 pb-20">
    <div class="mb-8">
        <div class="flex justify-between my-2 mb-8 ">
            <h2 class="text-2xl capitalize font-semibold">Provincia: <span class="text-red-500">{{ $provincia->name
                    }}</span></h2>
            <a class="text-lg text-red-500" href="{{ route('admin.provincias') }}">Volver</a>
        </div>
        <x-jet-form-section submit='saveCiudad' class="mb-6">
            <x-slot name='title'>
                <p class="text-gray-700 text-2xl font-semibold">Nueva Ciudad</p>
            </x-slot>
            <x-slot name='description'>
                Completa los campos para crear una nueva ciudad en la provincia seleccionada
            </x-slot>
            <x-slot name='form'>
                <div class="col-span-4">
                    <x-jet-label>Nombre</x-jet-label>
                    <x-jet-input type='text' class="w-full" wire:model='ciudadForm.name' />
                    <x-jet-input-error for='ciudadForm.name' />
                </div>
            </x-slot>
            <x-slot name='actions'>
                <x-jet-action-message class="mr-6 text-xl font-semibold text-red-600" on='ciudad_guardado'>
                    Ciudad agregada !
                </x-jet-action-message>
                <x-jet-button>
                    Guardar
                </x-jet-button>
            </x-slot>
        </x-jet-form-section>

        <x-jet-action-section>
            <x-slot name='title'>
                <p class="text-gray-700 text-2xl font-semibold">Ciudades</p>
            </x-slot>
            <x-slot name='description'>Listado de todas las ciudades de la provincia seleccionada</x-slot>
            <x-slot name='content'>
                <table>
                    <thead class="border-b border-gray-300">
                        <tr>
                            <th class="w-full text-left">Nombre</th>
                            <th class="px-2 sm:px-12 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-300">
                        @foreach ($ciudades as $ciudad)
                        <tr>
                            <td class="py-1 capitalize">
                                {{ $ciudad->name }}
                            </td>
                            <td class="px-2 sm:px-12">
                                <div class="flex items-center justify-center">
                                    <a class="text-blue-600 mx-2 cursor-pointer" wire:click="edit({{ $ciudad->id }})"><i
                                            class="fas fa-edit"></i></a>
                                    <a class="text-red-600 mx-2 cursor-pointer"
                                        wire:click="$emit('deleteCiudad', {{ $ciudad->id }})"><i
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

    <x-jet-dialog-modal wire:model='ciudadEdit.open'>
        <x-slot name='title' class="text-3xl">
            Editar Ciudad
        </x-slot>
        <x-slot name='content'>
            <div class="space-y-3">
                <div class="col-span-4">
                    <x-jet-label>Nombre</x-jet-label>
                    <x-jet-input type='text' class="w-full capitalize" wire:model='ciudadEdit.name' />
                    <x-jet-input-error for='ciudadEdit.name' />
                </div>
            </div>
        </x-slot>
        <x-slot name='footer'>
            <x-jet-danger-button class="mr-4" wire:click="$set('ciudadEdit.open', false)">
                Cancelar
            </x-jet-danger-button>
            <x-jet-button wire:click="update" wire:loading.attr='disabled' wire:target='update'>
                Actualizar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

    @push('js')
    <script>
        Livewire.on('deleteCiudad', id => {
            Swal.fire({
            title: 'Quieres eliminar esta ciudad?',
            showDenyButton: true,
            confirmButtonText: 'Eliminar',
            denyButtonText: `Cancelar`,
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
            Swal.fire('Ciudad eliminada!', '', 'success');
            Livewire.emit('delete', id);
            } else if (result.isDenied) {
            Swal.fire('Operación cancelada', '', 'info')
            }
            });
            });
    </script>
    @endpush
</div>
