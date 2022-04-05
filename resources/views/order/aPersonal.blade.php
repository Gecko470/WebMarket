<x-app-layout>
    <div class="container mx-auto pt-10 pb-32">
        <div class="flex justify-between items-center p-6 bg-white rounded-lg shadow-lg  mx-2 xl:mx-0">
            <h2 class="text-2xl font-semibold text-red-600">Área Personal</h2>
            <a class="cursor-pointer mx-2 text-xl text-red-600" href="{{ route('home') }}">
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
        @livewire('facturas')
    </div>
</x-app-layout>