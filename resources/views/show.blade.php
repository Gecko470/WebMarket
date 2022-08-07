<x-app-layout>
    <div class="z-0 py-12">
        <div class="container mx-auto sm:px-6 lg:px-8 bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">
            @livewire('show-product', ['product' => $product])
        </div>
    </div>
    @push('js')
    <script>
        $(document).ready(function() {
            $('.flexslider').flexslider({
            animation: "slide",
            controlNav: "thumbnails"
            });
            });
    
            window.addEventListener('agregar', event => {
            document.getElementById('spanCant').innerHTML = event.detail.cantidad;
        });
    </script>
    @endpush
</x-app-layout>