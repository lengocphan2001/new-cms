@props(['url', 'title', 'image'=>''])

<div class="flex flex-col bg-white border border-gray-200 rounded-lg shadow hover:shadow-lg dark:bg-gray-800 dark:border-gray-700">
    <div class="rounded-t-lg overflow-hidden">
        <a href="{{$url}}">
            @if ($image)
            <img class="transform hover:scale-110 duration-300" src="{{$image}}" alt="{{$title}}">
            @else
            <x-image-placeholder width='100%' height='100%' text="Costar" class="transform hover:scale-110 duration-300" />
            @endif
        </a>
    </div>
    <div class="mt-5 px-5">
        <a href="{{$url}}">
            <h5 class="mb-2 sm:mb-4 text-lg sm:text-xl font-semibold tracking-tight text-gray-900">
                {{$title}}
            </h5>
        </a>
    </div>
    <div class="flex-1 px-5 mb-2 sm:mb-4 font-normal text-sm sm:text-base">
        {!! $slot !!}
    </div>
    <div class="px-5 text-end pb-5">
        <a href="{{$url}}" class="inline-flex items-center text-sm text-gray-700 hover:text-gray-100 bg-gray-200 hover:bg-gray-700 py-2 px-3 rounded">
            {{__("View details")}}
            <svg class="ml-2 -mr-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
        </a>
    </div>
</div>