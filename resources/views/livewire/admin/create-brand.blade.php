<div class="container mx-auto pt-12 pb-20">
    <div>
        <x-jet-form-section submit='saveBrand' class="mb-6">
            <x-slot name='title'>
                <p class="text-gray-700 text-2xl font-semibold">Nueva Marca</p>
            </x-slot>
            <x-slot name='description'>
                Completa los campos para crear una nueva marca
            </x-slot>
            <x-slot name='form'>
                <div class="col-span-4">
                    <x-jet-label>Subcategoría</x-jet-label>
                    <select class="w-full" wire:model='brandForm.subcategory_id'>
                        <option value="">Selecciona..</option>
                        @foreach ($subcategories as $subcategory)
                        <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for='brandForm.subcategory_id' />
                </div>
                <div class="col-span-4">
                    <x-jet-label>Nombre</x-jet-label>
                    <x-jet-input type='text' class="w-full" wire:model='brandForm.name' />
                    <x-jet-input-error for='brandForm.name' />
                </div>
            </x-slot>
            <x-slot name='actions'>
                <x-jet-action-message class="mr-6 text-xl font-semibold text-red-600" on='brand_guardado'>
                    Marca agregada !
                </x-jet-action-message>
                <x-jet-button>
                    Guardar
                </x-jet-button>
            </x-slot>
        </x-jet-form-section>

        <x-jet-action-section>
            <x-slot name='title'>
                <p class="text-gray-700 text-2xl font-semibold">Marcas</p>
            </x-slot>
            <x-slot name='description'>
                Listado de todas las marcas
            </x-slot>
            <x-slot name='content'>
                <table>
                    <thead class="border-b border-gray-300">
                        <tr>
                            <th class="w-full text-left">Nombre</th>
                            <th class="text-left pr-8">Subcategoría</th>
                            <th class="px-12 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-300">
                        @foreach ($brands as $brand)
                        <tr>
                            <td class="py-1 capitalize">
                                <span>{{ $brand->name }}</span>
                                
                            </td>
                            <td class="py-1 text-left">
                                <span>{{ $brand->subcategory->name }}</span>
                            </td>
                            <td>
                                <div class="flex items-center justify-center">
                                    <a class="text-blue-600 mx-2 cursor-pointer"
                                        wire:click="editBrand({{ $brand->id }})"><i class="fas fa-edit"></i></a>
                                    <a class="text-red-600 mx-2 cursor-pointer"
                                        wire:click="$emit('delBrand', {{ $brand->id }})"><i
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

    <x-jet-dialog-modal wire:model='brandEdit.open'>
        <x-slot name='title'>
            Editar Marca
        </x-slot>
        <x-slot name='content'>
            <div>
                <x-jet-label>Nombre</x-jet-label>
                <x-jet-input type='text' class="w-full capitalize" wire:model='brandEdit.name' />
                <x-jet-input-error for='brandEdit.name' />
            </div>
            <div>
                <x-jet-label>Subcategoría</x-jet-label>
                <select class="w-full" wire:model='brandEdit.subcategory_id'>
                    <option value="">Selecciona..</option>
                    @foreach ($subcategories as $subcategory)
                        <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                    @endforeach
                </select>
                <x-jet-input-error for='brandEdit.subcategory_id' />
            </div>
        </x-slot>
        <x-slot name='footer'>
            <x-jet-danger-button class="mr-4" wire:click="$set('brandEdit.open', false)">
                Cancelar
            </x-jet-danger-button>
            <x-jet-button wire:click="updateBrand" wire:loading.attr='disabled' wire:target='updateBrand'>
                Actualizar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

    @push('js')
    <script>
            Livewire.on('delBrand', id => {
            Swal.fire({
            title: 'Quieres eliminar esta subcategoría?',
            showDenyButton: true,
            confirmButtonText: 'Eliminar',
            denyButtonText: `Cancelar`,
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
            Swal.fire('Marca eliminada!', '', 'success');
            Livewire.emit('deleteBrand', id);
            } else if (result.isDenied) {
            Swal.fire('Operación cancelada', '', 'info')
            }
            });
            });
    </script>
    @endpush
</div>
