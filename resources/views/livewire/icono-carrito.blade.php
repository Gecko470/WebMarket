<div>
    <button class="relative">
        <a href="{{ route('carrito') }}" class="text-sm text-red-500">
            <i class="fa-solid fa-cart-shopping text-xl"></i>
        </a><span id="spanCant"
            class="inline-flex items-center justify-center px-2 py-1 mr-2 -translate-x-3 -translate-y-3 text-xs font-bold leading-none text-red-600 bg-white border border-red-600 rounded-full">
            {{ Cart::getTotalQuantity() }}
        </span>
    </button>
</div>