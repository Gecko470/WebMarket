<x-app-layout>
    <div class="z-0 py-12">
        <div class="container mx-auto sm:px-6 lg:px-8 bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">
            @livewire('show-category', ['identificador' => $id])
        </div>
    </div>
</x-app-layout>