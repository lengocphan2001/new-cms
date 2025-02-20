@extends ('backend.layouts.app')

@section('title') {{ __($module_action) }} {{ __($module_title) }} @endsection

@section('breadcrumbs')
<x-backend.breadcrumbs>
    <x-backend.breadcrumb-item route='{{route("backend.$module_name.index")}}' icon='{{ $module_icon }}'>
        {{ __($module_title) }}
    </x-backend.breadcrumb-item>
    <x-backend.breadcrumb-item type="active">{{ __($module_action) }}</x-backend.breadcrumb-item>
</x-backend.breadcrumbs>
@endsection

@section('content')

<div class="card">
    <div class="card-body">
        <x-backend.section-header>
            <i class="{{ $module_icon }}"></i> {{ __($module_title) }} <small class="text-muted">{{ __($module_action) }}</small>

            <x-slot name="subtitle">
                @lang(":module_name Management Dashboard", ['module_name'=>__(Str::title($module_name))])
            </x-slot>
            <x-slot name="toolbar">
                <x-buttons.return-back />
            </x-slot>
        </x-backend.section-header>

        <hr>

        <div class="row mt-4">
            <div class="col">

                {{ html()->form('POST', route('backend.stage_users.store'))->class('form-horizontal')->open() }}
                {{ csrf_field() }}

                <div class="row mb-3">
                    <?php
                    $field_name = 'product_id';
                    $field_label = __('labels.backend.stage_users.fields.product');
                    $field_placeholder = $field_label;
                    $required = "required";
                    ?>
                    <div class="col-12 col-sm-2">
                        <div class="form-group">
                            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! fielf_required($required) !!}
                        </div>
                    </div>
                    <div class="col-12 col-sm-10">
                        <div class="form-group">
                            <select name="{{ $field_name }}" id="product-select" class="form-control">
                                <option value="">Tên sản phẩm</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}" >{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <?php
                    $field_name = 'stage_id';
                    $field_label = __('labels.backend.stage_users.fields.stage');
                    $field_placeholder = $field_label;
                    $required = "required";
                    ?>
                    <div class="col-12 col-sm-2">
                        <div class="form-group">
                            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! fielf_required($required) !!}
                        </div>
                    </div>
                    <div class="col-12 col-sm-10">
                        <div class="form-group">
                            <select name="{{ $field_name }}" id="stage-select" class="form-control">
                                <option value="">Tên công đoạn</option>
                                
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <?php
                    $field_name = 'group_stage_id';
                    $field_label = __('labels.backend.stage_users.fields.group_stage');
                    $field_placeholder = $field_label;
                    $required = "required";
                    ?>
                    <div class="col-12 col-sm-2">
                        <div class="form-group">
                            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! fielf_required($required) !!}
                        </div>
                    </div>
                    <div class="col-12 col-sm-10">
                        <div class="form-group">
                            <select name="{{ $field_name }}" id="stage-group-select" class="form-control">
                                <option value="">Tên nhóm công đoạn</option>
                                
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <?php
                    $field_name = 'total';
                    $field_label = __('labels.backend.stage_users.fields.quantity');
                    $field_placeholder = $field_label;
                    $required = "required";
                    ?>
                    <div class="col-12 col-sm-2">
                        <div class="form-group">
                            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! fielf_required($required) !!}
                        </div>
                    </div>
                    <div class="col-12 col-sm-10">
                        <div class="form-group">
                            {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <x-buttons.create title="{{__('Create')}} {{ ucwords(Str::singular($module_name)) }}">
                                {{__('Create')}}
                            </x-buttons.create>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="float-end">
                            <div class="form-group">
                                <x-buttons.cancel />
                            </div>
                        </div>
                    </div>
                </div>
                {{ html()->form()->close() }}
            </div>
        </div>
    </div>

    <div class="card-footer">
        <div class="row">
            <div class="col">
                <small class="float-end text-muted">

                </small>
            </div>
        </div>
    </div>
</div>

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
                if (productId) {
                    fetch(`/api/user-stages/${productId}/${userId}`)
                        .then(response => response.json())
                        .then(data => {
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