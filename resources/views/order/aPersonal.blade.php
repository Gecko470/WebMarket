<x-app-layout>
    <div class="container mx-auto pt-10 pb-32">
        <div class="flex justify-between items-center p-6 bg-white rounded-lg shadow-lg  mx-2 xl:mx-0">
            <h2 class="text-2xl font-semibold text-red-600">Área Personal</h2>
            <a class="cursor-pointer mx-2 text-lg text-red-600" href="{{ route('home') }}">
                <span>Volver</span>
            </a>
        </div>
        @livewire('facturas')
    </div>
</x-app-layout>
