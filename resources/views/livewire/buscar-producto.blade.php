<div class="w-full md:w-9/12 mx-auto mt-10 relative" x-data>
    <div class="flex items-center gap-4">
        <x-jet-input type='text' class="w-full" wire:model.debounce.500ms="termino" placeholder="Buscar producto.." />
    </div>
    <div>
        <x-jet-input-error for='producto' />
    </div>
    <div class="mt-2 px-4 py-2 absolute bg-white z-10 w-full text-gray-700 hidden" :class="{ 'hidden' : !$wire.open }"
        @click.away="$wire.open = false">
        @forelse ($products as $product)
        <a href="{{ route('show', $product) }}">
            <div class="flex my-2 items-center">
                <img class="rounded h-16 w-auto object-cover object-center"
                    src="{{ Storage::url($product->images()->first()->url) }}" alt="{{ $product->name }}">
                <div class="ml-2">
                    <p class="font-semibold text-sm md:text-lg capitalize">{{ $product->name }}</p>
                    <p class="font-semibold text-sm capitalize">Categoría: {{
                        $product->category->name }}</p>
                    <p class="font-semibold text-sm capitalize">Subcategoría: {{
                        $product->subcategory->name
                        }}
                    </p>
                </div>
            </div>
        </a>
        @empty
        <div class="mx-2 text-lg text-red-600">
            No se han encontrado productos con ese nombre...
        </div>
        @endforelse
    </div>
</div>