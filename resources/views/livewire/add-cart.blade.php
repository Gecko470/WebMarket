<div class="py-3 mt-6 flex justify-between">
    <div class="flex gap-4 items-center font-semibold text-xl text-red-600">
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
            class="w-full py-1 bg-red-600 text-white text-xl rounded-lg">Añadir al
            carrito</button>
    </div>
</div>