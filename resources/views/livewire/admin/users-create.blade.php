<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-gray-700">
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-2xl font-semibold">Nuevo usuario</h2>
        <a class="cursor-pointer mx-2 text-lg text-red-600" href="{{ route('admin.users') }}">
            <span>Volver</span>
        </a>
    </div>

    <div class="mb-4">
        <x-jet-label value='Nombre' class="text-lg" />
        <x-jet-input wire:model='name' type='text' class="w-full" />
        <x-jet-input-error for='name' />
    </div>
    <div class="mb-4">
        <x-jet-label value='Email' class="text-lg" />
        <x-jet-input wire:model='email' type='text' class="w-full" />
        <x-jet-input-error for='email' />
    </div>
    <div class="mb-4">
        <x-jet-label value='Password' class="text-lg" />
        <x-jet-input wire:model='password' type='text' class="w-full" />
        <x-jet-input-error for='password' />
    </div>

    <div class="flex justify-end items-center">
        <x-jet-button wire:click='save()' wire:loading.attr='disabled' wire:target='save'>
            Guardar
        </x-jet-button>
    </div>
</div>
