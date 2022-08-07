<x-app-layout>
    <div class="z-0 py-12">
        <div class="container mx-auto sm:px-6 lg:px-8 bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">
            <livewire:buscar-producto />
            <livewire:show-imagen />
            <livewire:show-sonido />
            <livewire:show-telefonia />
            <livewire:show-videojuegos />
            <livewire:show-informatica />
        </div>
    </div>

    @push('js')
    <script>
        Livewire.on('slider', function(){

            $('.owl-carousel').owlCarousel({
            loop:true,
            margin:10,
            nav:true,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:4
                },
                1200:{
                    items:6
                }
            }
        });
        });
        
    </script>
    @endpush
</x-app-layout>