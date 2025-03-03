<div id="indicators-carousel" class="relative w-full" data-carousel="static">

    <!-- Carousel wrapper -->
    <div class="relative h-56 overflow-hidden rounded ">
        @foreach($images as $index => $image)
            <div class="hidden duration-700 ease-in-out bg-slate-800" data-carousel-item="{{$index}}">

                <div class=" bg-slate-800 ">
                    <img src='{{$image->getDir()}}'
                    class="absolute block size-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                   >
                </div>
                
                
            </div>
        @endforeach
    </div>
    <!-- Slider indicators -->

    @if($images->count() > 1)
        <div
            class="absolute z-30 flex -translate-x-1/2 space-x-3 rtl:space-x-reverse bottom-5 left-1/2 bg-slate-900 rounded-full p-1.5">
            @foreach($images as $index => $image)
                <button type="button" class="h-2 w-2 sm:w-3 sm:h-3 rounded-full" aria-current="true"
                    aria-label="Slide {{$index}}" data-carousel-slide-to="{{$index}}"></button>
            @endforeach
        </div>
    @endif

</div>