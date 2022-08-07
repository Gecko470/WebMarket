<div class="container mx-auto pb-20">
    <div class="flex justify-between items-center mt-10">
        <h2 class="font-semibold text-3xl text-gray-700">Usuarios</h2>
        <a class="btn btn-danger" href="{{ route('admin.users.create') }}">Nuevo usuario</a>
    </div>

    <x-table>

        <div class="py-4">
            <x-jet-input type="text" placeholder="Buscar usuarios.." class="w-full" wire:model='usuario' />
        </div>

        @if ($users->count())
        <table class="min-w-full">
            <thead class="bg-white border-b">
                <tr>
                    <th scope="col" class="text-md font-medium text-gray-900 px-2 sm:px-6 py-4 text-center">
                        #
                    </th>
                    <th scope="col" class="text-md font-medium text-gray-900 px-2 sm:px-10 py-4 text-center">
                        Nombre
                    </th>
                    <th scope="col" class="text-md font-medium text-gray-900 px-2 sm:px-6 py-4 text-center">
                        Email
                    </th>
                    <th scope="col" class="text-md font-medium text-gray-900 px-2 sm:px-6 py-4 text-center">
                        Rol
                    </th>
                    <th scope="col" class="text-md font-medium text-gray-900 px-2 sm:px-6 py-4 text-center">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr wire:key='{{ $user->name }}'
                    class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                    <td class="text-sm font-light px-2 sm:px-6 py-4 text-center">
                        {{ $user->id }}
                    </td>
                    <td class="text-sm font-light px-2 sm:px-6 py-4 whitespace-nowrap text-center capitalize">
                        {{ $user->name }}</span>
                    </td>
                    <td class="text-sm font-light px-2 sm:px-6 py-4 whitespace-nowrap text-center">
                        {{ $user->email}}
                    </td>
                    <td class="text-sm font-light px-2 sm:px-6 py-4 whitespace-nowrap text-center capitalize">
                        @if ($user->roles->count())
                        {{ $user->roles[0]->name }}
                        @else
                        Cliente
                        @endif
                    </td>
                    <td class="text-sm font-light px-2 sm:px-6 py-4">
                        <div class="flex justify-center gap-4">
                            <a href="{{ route('admin.users.edit', $user) }}"><i
                                    class="fa-solid fa-pen-to-square text-blue-600"></i></a>
                            <a class="cursor-pointer" wire:click="$emit('alert', {{ $user->id }})"><i
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

    @if ($users->hasPages())
    <div class="mt-4">
        {{ $users->links() }}
    </div>
    @endif

    @push('js')
    <script>
        Livewire.on('alert', id => {
            Swal.fire({
            title: 'Quieres eliminar este usuario?',
            showDenyButton: true,
            confirmButtonText: 'Eliminar',
            denyButtonText: `Cancelar`,
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
            Swal.fire('Usuario eliminado!', '', 'success');
            Livewire.emit('delete', id);
            } else if (result.isDenied) {
            Swal.fire('Operación cancelada', '', 'info')
            }
            });
            });
    </script>
    @endpush
</div>
