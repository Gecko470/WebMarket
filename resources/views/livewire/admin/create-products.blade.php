<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-gray-700">
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-semibold mb-8">Nuevo producto</h2>
        <a class="cursor-pointer mx-2 text-xl text-red-600" wire:click="volver">
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

    <div class="grid grid-cols-3 gap-4 mb-4">
        <div>
            <x-jet-label value="Categoría" class="text-lg" />
            <select class="w-full" wire:model='category_id'>
                <option value="" selected disabled>Selecciona..</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <x-jet-input-error for='category_id' />
        </div>
        <div>
            <x-jet-label value="Subcategoría" class="text-lg" />
            <select wire:model='subcategory_id' class="w-full">
                <option value="" selected disabled>Selecciona..</option>
                @foreach ($subcategories as $subcategory)
                <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                @endforeach
            </select>
            <x-jet-input-error for='subcategory_id' />
        </div>
        <div>
            <x-jet-label value="Marca" class="text-lg" />
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
        <x-jet-label value='Nombre' class="text-lg" />
        <x-jet-input wire:model='name' type='text' class="w-full" />
        <x-jet-input-error for='name' />
    </div>

    <div class="mb-4">
        <div wire:ignore>
            <x-jet-label value='Descripción' class="text-lg" />
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
            <x-jet-label value='Stock' class="text-lg" />
            <x-jet-input wire:model='stock' type='number' class="w-full" />
            <x-jet-input-error for='stock' />
        </div>
        <div class="mb-4">
            <x-jet-label value='Precio' class="text-lg" />
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