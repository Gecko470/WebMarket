<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-gray-700">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold">Editar producto</h2>
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

    <div wire:ignore>
        <form action="{{ route('admin.products.filesEdit', $product) }}" class="dropzone" id="my-great-dropzone">
            <div class="flex justify-center items-center">
                <span class="dz-message">Para agregar imágenes a tu producto arrástralas aquí..</span>
            </div>

        </form>
    </div>

    @if ($product->images->count())
    <div class="mt-6">
        <h2 class="font-semibold text-xl text-center mb-4">Imágenes del producto</h2>
        <ul class="flex flex-wrap gap-2">
            @foreach ($product->images as $image)
            <li class="relative" wire:key='image{{ $image->id }}'>
                <img class="w-32 h-20 object-cover object-center" src="{{ Storage::url($image->url) }}" alt="">
                <x-jet-danger-button class="absolute top-1 right-1" wire:click='deleteImg({{ $image->id }})'
                    wire:loading.attr='disabled' wire:target='deleteImg({{ $image->id }})'>
                    x
                </x-jet-danger-button>
            </li>
            @endforeach
        </ul>
    </div>
    @endif


    <div class="grid grid-cols-3 gap-4 my-8">
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
        <x-jet-action-message class="mr-6 text-xl font-semibold text-red-600" on='actualizado'>
            Producto actualizado !
        </x-jet-action-message>

        <x-jet-button wire:click='save' wire:loading.attr='disabled' wire:target='save'>
            Actualizar
        </x-jet-button>
    </div>

    @push('js')
    <script>
        Dropzone.options.myGreatDropzone = { // camelized version of the `id`
        headers: {
        "X-CSRF-TOKEN" : "{{ csrf_token() }}"
        },
        acceptedFiles: "image/*",
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 2, // MB
        complete: function(file){
            this.removeFile(file)
        },
        queuecomplete: function(){
            Livewire.emit('refreshEdit')
        },
        accept: function(file, done) {
        if (file.name == "justinbieber.jpg") {
        done("Naha, you don't.");
        }
        else { done(); }
        }
        };
    </script>
    @endpush
</div>