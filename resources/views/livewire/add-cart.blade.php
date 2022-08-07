<div class="py-3 mt-6 flex justify-between gap-4">
    <div class="flex gap-2 sm:gap-4 items-center font-semibold sm:text-xl text-red-600">
        <button {{ $cant <=1 ? 'disabled' : '' }} wire:click="menosCant">
            <i class="fa-solid fa-circle-minus"></i>
        </button>
        <span>{{ $cant }}</span>
        <button {{ $cant>= $product->stock ? 'disabled' : '' }} wire:click="masCant">
            <i class="fa-solid fa-circle-plus"></i>
        </button>
    </div>
    <div class="w-3/4 flex justify-center items-center">
        <button wire:click="addCartItem({{ $product->id }})" wire:loading.attr="disabled" wire:target="addCartItem"
            class="w-56 sm:w-full py-1 bg-red-600 text-white text-md sm:text-xl rounded-lg">Añadir al
            carrito</button>
    </div>
</div>
