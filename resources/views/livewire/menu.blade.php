<div x-data="{ open2:false }" x-on:click.away=" open2=false ">
    <div class="ml-2">
        <button x-on:click=" open2 = !open2 "
            class="inline-flex items-center justify-center p-2 rounded-md text-red-600 transition">
            <i :class="{ 'text-red-300': open2 }" class="fa-solid fa-bars"></i>
        </button>
    </div>

    <div :class="{ 'hidden':!open2 , 'absolute':open2 }" class="hidden w-full text-gray-700">
        {{-- Menú--}}
        <div class="md:flex md:relative hidden">
            <div class="bg-white w-1/4">
                <p class="text-md md:text-xl font-semibold text-center my-2">Categorías</p>
                <ul>
                    @foreach($categories as $category)
                    <li class="navigation-link my-6 cursor-pointer"><a
                            class="px-4 py-2 hover:bg-red-600 hover:text-white text-sm lg:text-lg"
                            href="{{ route('showcategory', $category->id) }}"><span class="mr-2">{!! $category->icon
                                !!}</span>{{ $category->name }}</a>

                        <div class="navigation-sub absolute hidden w-3/4 top-0 right-0 bg-gray-200">
                            <div class="grid grid-cols-4 md:p-4">
                                <div>
                                    <p class="text-lg font-semibold md:text-center my-2">Subcategorías</p>
                                    <ul>
                                        @foreach($category->subcategories as $subcategory)
                                        <li
                                            class="md:px-4 py-2 cursor-pointer hover:bg-red-600 hover:text-white text-sm lg:text-lg">
                                            <a href="{{ route('showsubcategory', $subcategory->id) }}"><span
                                                    class="mr-2">{!! $subcategory->icon !!}</span>{{ $subcategory->name
                                                }}
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>

                                <div class="col-span-3 ml-12 mr-24">
                                    <img class="h-64 w-9/12 object-cover object-center"
                                        src="{{ Storage::url($category->img) }}" alt="$category->name">
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>

            <div class="w-3/4 bg-gray-200">
                <div class="grid grid-cols-4 p-4">
                    <div>
                        <p class="text-lg font-semibold text-center my-2">Subcategorías</p>
                        <ul>
                            @foreach($categories->first()->subcategories as $item)
                            <li class="px-4 py-2 cursor-pointer hover:bg-red-600 hover:text-white text-sm lg:text-lg">
                                <a href="{{ route('showsubcategory', $item->id) }}"><span class="mr-2">{!! $item->icon
                                        !!}</span>{{ $item->name }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="col-span-3  ml-12 mr-24">
                        <img class="h-64 w-9/12 object-cover object-center"
                            src="{{ Storage::url($categories->first()->img) }}" alt="$categories->first()->name">
                    </div>
                </div>
            </div>
        </div>
        {{-- Menú Responsive--}}
        <div class="w-full absolute top-0 left-0 md:hidden bg-white overflow-auto">
            <div class="w-full top-0 right-0 bg-white">
                <p class="ml-12 text-lg text-red-600 font-bold my-2">Categorías</p>
                <ul>
                    @foreach($categories as $category)
                    <li class="my-4 cursor-pointer"><a class="px-2 py-1 text-red-600 text-lg"
                            href="{{ route('showcategory', $category->id) }}"><span class="mr-2">{!! $category->icon
                                !!}</span>{{ $category->name }}</a>

                        <div>
                            <ul>
                                @foreach($category->subcategories as $subcategory)
                                <li class="ml-8 px-4 py-2 cursor-pointer text-md">
                                    <a href="{{ route('showsubcategory', $subcategory->id) }}"><span class="mr-2">{!!
                                            $subcategory->icon !!}</span>{{ $subcategory->name }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
