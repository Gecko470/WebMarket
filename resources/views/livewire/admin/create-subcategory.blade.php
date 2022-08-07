<div class="container mx-auto pt-12 pb-20">
    <div class="mb-8">
        <x-jet-form-section submit='saveSubcategory' class="mb-6">
            <x-slot name='title'>
                <p class="text-gray-700 text-2xl font-semibold">Nueva Subcategoría</p>
            </x-slot>
            <x-slot name='description'>
                Completa los campos para crear una nueva subcategoría
            </x-slot>
            <x-slot name='form'>
                <div class="col-span-4">
                    <x-jet-label>Categoría</x-jet-label>
                    <select class="w-full" wire:model='subcategoryForm.category_id'>
                        <option value="">Selecciona..</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for='subcategoryForm.category_id' />
                </div>
                <div class="col-span-4">
                    <x-jet-label>Nombre</x-jet-label>
                    <x-jet-input type='text' class="w-full" wire:model='subcategoryForm.name' />
                    <x-jet-input-error for='subcategoryForm.name' />
                </div>
                <div class="col-span-4">
                    <x-jet-label>Icono</x-jet-label>
                    <x-jet-input type='text' class="w-full" wire:model='subcategoryForm.icon' />
                    <x-jet-input-error for='subcategoryForm.icon' />
                </div>

                <div class="col-span-4">
                    <x-jet-label>Imagen</x-jet-label>
                    <input class="mt-1" type="file" accept="image/*" wire:model='subcategoryForm.image' id={{
                        $idAleatorio }}>
                    <x-jet-input-error for='subcategoryForm.image' />
                </div>
            </x-slot>
            <x-slot name='actions'>
                <x-jet-action-message class="mr-6 text-xl font-semibold text-red-600" on='subcat_guardado'>
                    Subcategoría agregada !
                </x-jet-action-message>
                <x-jet-button>
                    Guardar
                </x-jet-button>
            </x-slot>
        </x-jet-form-section>


        <x-jet-action-section>
            <x-slot name='title'>
                <p class="text-gray-700 text-2xl font-semibold">Subcategorías</p>
            </x-slot>
            <x-slot name='description'>Listado de todas las subcategorías</x-slot>
            <x-slot name='content'>
                <table>
                    <thead class="border-b border-gray-300">
                        <tr>
                            <th class="w-full text-left">Nombre</th>
                            <th class="px-2 sm:px-12 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-300">
                        @foreach ($subcategories as $subcategory)
                        <tr>
                            <td class="py-1">
                                <span class="inline-block w-8 text-center">{!!$subcategory->icon!!}</span>
                                <span>{{ $subcategory->name }}</span>
                            </td>
                            <td>
                                <div class="flex items-center justify-center">
                                    <a class="text-blue-600 mx-2 cursor-pointer"
                                        wire:click="edit({{ $subcategory->id }})"><i class="fas fa-edit"></i></a>
                                    <a class="text-red-600 mx-2 cursor-pointer"
                                        wire:click="$emit('deleteSubcat', {{ $subcategory->id }})"><i
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

    <div>
        <x-jet-form-section submit='saveBrand'>
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
    </div>

    <x-jet-dialog-modal wire:model='subcategoryEdit.open'>
        <x-slot name='title'>
            Editar Subcategoría
        </x-slot>
        <x-slot name='content'>
            <div class="space-y-3">
                <div>
                    @if ($imgSubcatEdit)
                    <img class="w-full h-64 object-cover object-center" src="{{ $imgSubcatEdit->temporaryUrl() }}"
                        alt="{{ $subcategoryEdit['name'] }}">
                    @else
                    <img class="w-full h-64 object-cover object-center"
                        src="{{ Storage::url($subcategoryEdit['image']) }}" alt="{{ $subcategoryEdit['name'] }}">
                    @endif
                </div>
                <div class="col-span-4">
                    <x-jet-label>Categoría</x-jet-label>
                    <select class="w-full" wire:model='subcategoryEdit.category_id'>
                        <option value="">Selecciona..</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for='subcategoryEdit.category_id' />
                </div>
                <div class="col-span-4">
                    <x-jet-label>Nombre</x-jet-label>
                    <x-jet-input type='text' class="w-full" wire:model='subcategoryEdit.name' />
                    <x-jet-input-error for='subcategoryEdit.name' />
                </div>
                <div class="col-span-4">
                    <x-jet-label>Icono</x-jet-label>
                    <x-jet-input type='text' class="w-full" wire:model='subcategoryEdit.icon' />
                    <x-jet-input-error for='subcategoryEdit.icon' />
                </div>
                <div class="col-span-4">
                    <x-jet-label>Imagen</x-jet-label>
                    <input class="mt-1" type="file" accept="image/*" wire:model='imgSubcatEdit' id={{ $idAleatEdit }}>
                    <x-jet-input-error for='imgSubcatEdit' />
                </div>
            </div>
        </x-slot>
        <x-slot name='footer'>
            <x-jet-danger-button class="mr-4" wire:click="$set('subcategoryEdit.open', false)">
                Cancelar
            </x-jet-danger-button>
            <x-jet-button wire:click="update" wire:loading.attr='disabled' wire:target='imgSubcatEdit, update'>
                Actualizar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

    @push('js')
    <script>
        Livewire.on('deleteSubcat', id => {
            Swal.fire({
            title: 'Quieres eliminar esta subcategoría?',
            showDenyButton: true,
            confirmButtonText: 'Eliminar',
            denyButtonText: `Cancelar`,
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
            Swal.fire('Producto eliminado!', '', 'success');
            Livewire.emit('delete', id);
            } else if (result.isDenied) {
            Swal.fire('Operación cancelada', '', 'info')
            }
            });
            });
    </script>
    @endpush
</div>
