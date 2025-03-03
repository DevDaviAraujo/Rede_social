<div class="overflow-x-auto flex gap-2">
    @foreach($uploads as $index => $image)
        <!-- Item {{$index}} -->
        <div class="max-w-32 ">
            <div class="size-32">
                <img class="rounded" src="{{$image->temporaryUrl()}}">
            </div>
            <li class="flex gap-3 mb-1 ps-1.5 bg-indigo-500 w-full">
                <p class="truncate overflow-hidden">{{ $image->getClientOriginalName() }}</p>

            </li>
        </div>
    @endforeach
    @if(isset($oldUploads))
        @foreach($oldUploads as $index => $image)
            <!-- Item {{$index}} -->
            <div class="max-w-32 ">
                <div class="size-32">
                    <img class="rounded" src="{{$image->getDir()}}">
                </div>
                <li class="flex gap-3 mb-1 ps-1.5 bg-indigo-500 w-full">
                    <p class="truncate overflow-hidden">{{ $image->file }}</p>

                </li>
            </div>
        @endforeach
    @endif
</div>