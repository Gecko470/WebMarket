<div class="container mx-auto py-12 text-gray-700">
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-3xl font-semibold">Nuevo producto</h2>
        <a class="cursor-pointer mx-2 text-lg sm:text-xl text-red-600" wire:click="volver">
            <span>Volver</span>
        </a>
    </div>

    <div class="grid grid-cols-3 gap-4 mb-4">
        <div>
            <x-jet-label value="Categoría" class="text-sm sm:text-lg" />
            <select class="w-full" wire:model='category_id'>
                <option value="" selected disabled>Selecciona..</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <x-jet-input-error for='category_id' />
        </div>
        <div>
            <x-jet-label value="Subcategoría" class="text-sm sm:text-lg" />
            <select wire:model='subcategory_id' class="w-full">
                <option value="" selected disabled>Selecciona..</option>
                @foreach ($subcategories as $subcategory)
                <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                @endforeach
            </select>
            <x-jet-input-error for='subcategory_id' />
        </div>
        <div>
            <x-jet-label value="Marca" class="text-sm sm:text-lg" />
            <select wire:model='brand_id' class="w-full">
                <option value="" selected disabled>Selecciona..</option>
                @foreach ($brands as $brand)
                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
            </select>
            <x-jet-input-error for='brand_id' />
        </div>
    </div>

    <div class="mb-4">
        <x-jet-label value='Nombre' class="text-sm sm:text-lg" />
        <x-jet-input wire:model='name' type='text' class="w-full" />
        <x-jet-input-error for='name' />
    </div>

    <div class="mb-4">
        <div wire:ignore>
            <x-jet-label value='Descripción' class="text-sm sm:text-lg" />
            <textarea x-data x-ref='ckEditor' x-init="ClassicEditor
            .create( $refs.ckEditor )
            .then(function(editor){
                editor.model.document.on('change:data', () => {
                    @this.set('description', editor.getData());
                });
            })
            .catch( error => {
                console.error( error );
            } );" wire:model='description' class="form-control" rows="5"></textarea>
        </div>

        <x-jet-input-error for='description' />
    </div>

    <div class="grid grid-cols-2 gap-4 mb-4">
        <div class="mb-4">
            <x-jet-label value='Stock' class="text-sm sm:text-lg" />
            <x-jet-input wire:model='stock' type='number' class="w-full" />
            <x-jet-input-error for='stock' />
        </div>
        <div class="mb-4">
            <x-jet-label value='Precio' class="text-sm sm:text-lg" />
            <x-jet-input wire:model='price' type='number' step='.01' class="w-full" />
            <x-jet-input-error for='price' />
        </div>
    </div>

    <div class="flex justify-end items-center">
        <x-jet-button wire:click='save' wire:loading.attr='disabled' wire:target='save'>
            Guardar
        </x-jet-button>
    </div>
</div>
