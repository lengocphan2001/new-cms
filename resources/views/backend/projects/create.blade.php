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

                {{ html()->form('POST', route('backend.projects.store'))->class('form-horizontal')->open() }}
                {{ csrf_field() }}

                <div class="row mb-3">
                    <?php
                    $field_name = 'name';
                    $field_label = __('labels.backend.projects.fields.name');
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

                <div class="row mb-3">
                    <?php
                    $field_name = 'name';
                    $field_placeholder = $field_label;
                    $required = "";
                    ?>
                </div>

                <div class="row mb-3">
                    <?php
                    $field_name = 'customer';
                    $field_label = __('labels.backend.projects.fields.customer');
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

                <div class="row mb-3">
                    <?php
                    $field_name = 'customer';
                    $field_placeholder = $field_label;
                    $required = "";
                    ?>
                </div>
                
                <div class="row mb-3">
                    <?php
                    $field_name = 'start_date';
                    $field_label = __('labels.backend.projects.fields.start_date');
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
                            {{ html()->date($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
                        </div>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <?php
                    $field_name = 'start_date';
                    $field_placeholder = $field_label;
                    $required = "";
                    ?>
                </div>

                <div class="row mb-3">
                    <?php
                    $field_name = 'end_date';
                    $field_label = __('labels.backend.projects.fields.end_date');
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
                            {{ html()->date($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
                        </div>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <?php
                    $field_name = 'end_date';
                    $field_placeholder = $field_label;
                    $required = "";
                    ?>
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