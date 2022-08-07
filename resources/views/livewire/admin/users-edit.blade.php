<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-gray-700">
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-3xl font-semibold">Editar usuario</h2>
        <a class="cursor-pointer mx-2 text-lg text-red-600" href="{{ route('admin.users') }}">
            <span>Volver</span>
        </a>
    </div>
    @if ($user->email != 'codeworks9@gmail.com')
    <div class="mb-4">
        <x-jet-label value='Rol' class="text-lg" />
        <label>Administrador <input {{ $user->roles->count()? 'checked': ''}} type="radio" value="0" name="{{
            $user->name }}"
            wire:change="assignRole($event.target.value)" /></label>
        <label class="ml-4">Cliente <input {{ $user->roles->count()? '': 'checked'}} type="radio" value="1" name="{{
            $user->name }}"
            wire:change="assignRole($event.target.value)" /></label>
    </div>
    @endif
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
        <x-jet-label value='Password actual encriptado' class="text-lg" />
        <x-jet-input wire:model='password' type='password' class="w-full" readonly />
        <x-jet-input-error for='password' />
    </div>
    <div class="mb-4">
        <x-jet-label value='Nuevo password (opcional)' class="text-lg" />
        <x-jet-input wire:model='nuevoPassword' type='text' class="w-full" />
        <x-jet-input-error for='nuevoPassword' />
    </div>

    <div class="flex justify-end items-center">
        <x-jet-button wire:click='update()' wire:loading.attr='disabled' wire:target='update'>
            Guardar
        </x-jet-button>
    </div>
</div>
