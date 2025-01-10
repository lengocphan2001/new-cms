@extends('frontend.layouts.app')

@section('title') {{ __($module_title) }} @endsection

@section('content')

<section class="bg-gray-100 text-gray-600 py-10">
    <div class="container mx-auto flex px-5 items-center justify-center flex-col">
        <div class="text-center lg:w-2/3 w-full">
            <h1 class="text-3xl sm:text-4xl mb-4 font-medium text-gray-800">
                {{ __($module_title) }}
            </h1>
            <p class="leading-relaxed">
                The list of {{ __($module_name) }}.
            </p>

            @include('frontend.includes.messages')
        </div>
    </div>
</section>

<section class="px-6 pt-8 sm:px-20">
    <div class="grid grid-cols-4 sm:grid-cols-3 gap-6">
        @foreach ($featured_data as $index => $featured)
            @php
            $detail_url = route("frontend.$module_name.show",[encode_id($featured->id), $featured->slug]);
            @endphp
            <x-frontend.card 
                :url="$detail_url" 
                :title="$featured->name" 
                :image="$featured->featured_image"
            >
                <div class="flex flex-row mb-2">
                    <div class="flex flex-row items-center mr-4 text-gray-400">
                        <span class="w-5">
                            <i class="fa fa-fw fa-folder-open"></i>
                        </span>
                        <x-frontend.badge 
                            :url="route('frontend.categories.show', [encode_id($featured->category_id), $featured->category->slug])" 
                            :text="$featured->category_name"
                        />
                    </div>
                    @if(count($featured->tags))
                    <div class="flex flex-row items-center text-gray-400">
                        <span class="w-5">
                            <i class="fa fa-tag"></i> 
                        </span>
                        @foreach ($featured->tags as $tag)
                        <x-frontend.badge 
                            :url="route('frontend.tags.show', [encode_id($tag->id), $tag->slug])" 
                            :text="$tag->name"
                        />
                        @endforeach
                    </div>
                    @endif
                </div>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                    {{$featured->intro}}
                </p>
            </x-frontend.card>
        @endforeach
    </div>
</section>

<section class="bg-white text-gray-600 p-6 sm:p-20">
    <div class="mx-auto flex md:flex-row flex-col">
        <div class="flex flex-col lg:flex-grow sm:w-8/12 sm:pr-8">
            <div class="grid grid-cols-1 gap-6">
                @foreach ($posts_data as $post_singular)
                    @php
                        $detail_url = route("frontend.$module_name.show",[encode_id($post_singular->id), $post_singular->slug]);
                    @endphp
                    <x-frontend.list 
                        :url="$detail_url" 
                        :title="$post_singular->name" 
                        :image="$post_singular->featured_image"
                    >
                        <div class="flex flex-row mb-2">
                            <div class="flex flex-row items-center mr-4 text-gray-500">
                                <span class="w-5">
                                    <i class="fa fa-fw fa-folder-open"></i>
                                </span>
                                <x-frontend.badge 
                                    :url="route('frontend.categories.show', [encode_id($post_singular->category_id), $post_singular->category->slug])" 
                                    :text="$post_singular->category_name"
                                />
                            </div>
                            @if(count($post_singular->tags))
                            <div class="flex flex-row items-center text-gray-500">
                                <span class="w-5">
                                    <i class="fa fa-tag"></i> 
                                </span>
                                @foreach ($post_singular->tags as $tag)
                                <x-frontend.badge 
                                    :url="route('frontend.tags.show', [encode_id($tag->id), $tag->slug])" 
                                    :text="$tag->name"
                                />
                                @endforeach
                            </div>
                            @endif
                        </div>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-500">
                            {{$post_singular->intro}}
                        </p>
                    </x-frontend.list>
                @endforeach
            </div>
        </div>
        <div class="flex flex-col sm:w-4/12">
            <div class="py-5 sm:pt-0">
                <div class="w-full mx-auto flex flex-col items-center justify-center border border-gray-200 rounded-md shadow hover:shadow-lg">
                    <div class="w-full px-6 py-4 border-b border-gray-100">
                        <h3 class="text-lg leading-6 font-medium text-gray-800">
                            @lang('Recent Posts')
                        </h3>
                        <p class="max-w-2xl text-sm text-gray-500 mb-0">
                            {{__('Recently published posts')}}
                        </p>
                    </div>
                    <ul class="w-full py-3">
                        @foreach ($recent_data as $row)
                        @php
                        $detail_url = route("frontend.posts.show",[encode_id($row->id), $row->slug]);
                        @endphp
                        <li class="flex items-center flex-row flex-1 transition duration-500 ease-in-out transform hover:-translate-y-1 px-6 py-3">
                            <a class="flex w-full" href="{{$detail_url}}">
                                <div class="flex-0-0-48 justify-center items-center mr-4">
                                    @if($row->featured_image != "")  
                                        <img alt="{{ $row->name }}" src="{{$row->featured_image}}" class="mx-auto object-cover rounded h-10 " />
                                    @else
                                    <x-image-placeholder width='48' height='40' text="Costar" fontSize="14px" class="transform hover:scale-110 duration-300" />
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <div class="font-medium">
                                        {{ $row->name }}
                                    </div>
                                    <div class="text-gray-600 text-sm">
                                        {{ $row->category_name }}
                                    </div>
                                </div>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center w-100 mt-4">
        {{$posts_data->links()}}
    </div>
</section>
@endsection