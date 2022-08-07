<div class="container mx-auto pb-20">
    <x-slot name="header">
        <div class="flex justify-between items-center px-2 sm:px-0">
            <h2 class="font-semibold text-3xl text-gray-700">Productos</h2>
            <a class="btn btn-danger text-sm sm:text-lg" href="{{ route('admin.products.create') }}">Nuevo producto</a>
        </div>
    </x-slot>

    <x-table>

        <div class="py-4">
            <x-jet-input type="text" placeholder="Buscar producto por nombre.." class="w-full" wire:model='termino' />
        </div>

        @if ($products->count())
        <table class="min-w-full">
            <thead class="bg-white border-b">
                <tr>
                    <th scope="col" class="text-sm sm:text-md font-medium text-gray-900 px-2 sm:px-6 py-4 text-center">
                        #
                    </th>
                    <th scope="col"
                        class="text-sm sm:text-md font-medium text-gray-900 pr-4 sm:pr-0 lg:px-10 py-4 text-left">
                        Producto
                    </th>
                    <th scope="col" class="text-sm sm:text-md font-medium text-gray-900 px-1 sm:px-6 py-4 text-center">
                        Categoría
                    </th>
                    <th scope="col" class="text-sm sm:text-md font-medium text-gray-900 px-1 sm:px-6 py-4 text-center">
                        Subcategoría
                    </th>
                    <th scope="col" class="text-sm sm:text-md font-medium text-gray-900 px-1 sm:px-6 py-4 text-center">
                        Marca
                    </th>
                    <th scope="col" class="text-sm sm:text-md font-medium text-gray-900 px-2 sm:px-6 py-4 text-center">
                        Stock
                    </th>
                    <th scope="col" class="text-sm sm:text-md font-medium text-gray-900 px-2 sm:px-6 py-4 text-center">
                        Precio
                    </th>
                    <th scope="col" class="text-sm sm:text-md font-medium text-gray-900 px-2 sm:px-6 py-4 text-center">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                    <td class="text-sm font-light px-2 sm:px-6 py-4 text-center">
                        {{ $product->id }}
                    </td>
                    <td class="text-sm font-light pr-4 sm:pr-0 lg:px-6 py-4">
                        <div class="flex items-center gap-4">
                            @if ($product->images->count())
                            <img class="hidden lg:block w-16 h-16 object-cover object-center rounded-full"
                                src="{{ Storage::url($product->images->first()->url) }}" alt="{{ $product->name }}">
                            @else
                            <img class="hidden lg:block w-16 h-16 object-cover object-center rounded-full"
                                src="https://cms-assets.tutsplus.com/uploads/users/769/posts/25334/preview_image/get-started-with-laravel-6-400x277.png"
                                alt="{{ $product->name }}">
                            @endif
                            <span class="capitalize">{{ $product->name }}</span>
                        </div>
                    </td>
                    <td class="text-sm font-light px-1 sm:px-6 py-4 whitespace-nowrap text-center">
                        {{ $product->category->name }}
                    </td>
                    <td class="text-sm font-light px-1 sm:px-6 py-4 whitespace-nowrap text-center">
                        {{ $product->subcategory->name }}
                    </td>
                    <td class="text-sm font-light px-1 sm:px-6 py-4 capitalize text-center">
                        {{ $product->brand->name }}
                    </td>
                    <td class="text-sm font-light px-2 sm:px-6 py-4 whitespace-nowrap text-center">
                        {{ $product->stock }}
                    </td>
                    <td class="text-sm font-light px-2 sm:px-6 py-4 whitespace-nowrap text-center">
                        {{ $product->price }}
                    </td>
                    <td class="text-sm font-light px-2 sm:px-6 py-4">
                        <div class="flex justify-center gap-4">
                            <a href="{{ route('admin.products.edit', $product) }}"><i
                                    class="fa-solid fa-pen-to-square text-blue-600"></i></a>
                            <a class="cursor-pointer" wire:click="$emit('alert', {{ $product->id }})"><i
                                    class="fa-solid fa-trash-can text-red-600"></i></a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div>
            No se han encontrado resultados con ese término de búsqueda..
        </div>
        @endif

    </x-table>

    @if ($products->hasPages())
    <div class="mt-4">
        {{ $products->links() }}
    </div>
    @endif

    @push('js')
    <script>
        Livewire.on('alert', id => {
            Swal.fire({
            title: 'Quieres eliminar este producto?',
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
