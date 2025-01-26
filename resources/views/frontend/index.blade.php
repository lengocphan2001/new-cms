@extends('frontend.layouts.app')

@section('title')
    {{ app_name() }}
@endsection

@section('content')
    <section class="bg-gray-100">
        <div class="container mx-auto flex px-1 sm:px-20 py-20 md:flex-row flex-col items-center">
            <div class="flex flex-col items-center text-center lg:max-w-lg md:w-2/5 w-1/3 mb-10 md:mb-0">
                <img class="object-cover object-center rounded" alt="hero" src="{{ asset('images/default.png') }}" />
            </div>
            <div
                class="flex flex-col lg:flex-grow md:items-start md:text-left items-center text-center md:w-3/5 w-2/3 px-4 md:pl-8">
                <div class="row mt-4">
                    @if (auth()->check())
                    <div class="col">
                        {{ html()->form('POST', route('backend.stage_users.store'))->class('form-horizontal')->open() }}
                        {{ csrf_field() }}

                        <div class="row mb-3">
                            <?php
                            $field_name = 'product_id';
                            $field_label = __('labels.backend.products.fields.name');
                            ?>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    {{ html()->label($field_label, $field_name)->class('form-label') }}
                                </div>
                            </div>
                            <div class="col-12 col-sm-10">
                                <div class="form-group">
                                    <select name="{{ $field_name }}" id="product-select" class="form-control">
                                        <option value="">Tên sản phẩm</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3" id="stages-container" style="display: none;">
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="stage_id">{{ __('labels.backend.stages.fields.name') }}</label>
                                    
                                </div>
                            </div>
                            <div class="col-12 col-sm-10">
                                <div class="form-group">
                                    <select name="stage_id" id="stage-select" class="form-control">
                                        <option value="">Tên công đoạn</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="stage_group_id">{{ __('labels.backend.stage_groups.fields.name') }}</label>
                                    
                                </div>
                            </div>
                            <div class="col-12 col-sm-10">
                                <div class="form-group">
                                    <select name="stage_group_id" id="stage-group-select" class="form-control">
                                        <option value="">Tên nhóm công đoạn</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <?php
                                $field_name = 'total';
                                $field_label = 'Sản lượng';
                                $field_placeholder = 'Sản lượng';
                                $required = 'required';
                                ?>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        {{ html()->label($field_label, $field_name)->class('form-label') }}
                                    </div>
                                </div>
                                <div class="col-12 col-sm-10">
                                    <div class="form-group">
                                        <div class="form-group">
                                            {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <x-buttons.create
                                        title="{{ __('Create') }} {{ ucwords(Str::singular($module_name)) }}">
                                        Gửi báo cáo
                                    </x-buttons.create>
                                </div>
                            </div>
                        </div>
                        {{ html()->form()->close() }}
                    </div>
                    @else
                    <h1 class="title-font sm:text-5xl text-5xl mb-4 font-medium text-gray-800">
                        {{ app_name() }}<!--{!! setting('app_name') !!}-->
                    </h1>
                    <p class="mb-8 sm:text-2xl text-3xl">
                        {!! setting('meta_description') !!}
                    </p>
                    @endif
                    
                </div>


                @include('frontend.includes.messages')

            </div>
        </div>
    </section>
@endsection

@if (auth()->check())
@push('after-scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const userId = {{ auth()->user()->id }};
        const productSelect = document.getElementById('product-select');
        if (productSelect) {
            productSelect.addEventListener('change', function() {
                const productId = this.value;
                console.log(productId);
                if (productId) {
                    fetch(`/api/user-stages/${productId}/${userId}`)
                        .then(response => response.json())
                        .then(data => {
                            console.log(data);
                            // Populate stage options
                            const stageSelect = document.getElementById('stage-select');
                            stageSelect.innerHTML = '<option value="">Tên công đoạn</option>';
                            data.stage_ids.forEach(stage => {
                                stageSelect.innerHTML +=
                                    `<option value="${stage.id}">${stage.name}</option>`;
                            });

                            // Populate stage group options
                            const stageGroupSelect = document.getElementById('stage-group-select');
                            stageGroupSelect.innerHTML = '<option value="">Nhóm công đoạn</option>';
                            data.group_stage_ids.forEach(group => {
                                stageGroupSelect.innerHTML +=
                                    `<option value="${group.id}">${group.name}</option>`;
                            });

                            document.getElementById('stages-container').style.display = 'block';
                        })
                        .catch(error => console.error('Error fetching product stages:', error));
                } else {
                    document.getElementById('stages-container').style.display = 'none';
                }
            });
        }
    });
</script>
@endpush
@endif

