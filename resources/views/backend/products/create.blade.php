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

                {{ html()->form('POST', route('backend.products.store'))->class('form-horizontal')->open() }}
                {{ csrf_field() }}

                <div class="row mb-3">
                    <?php
                    $field_name = 'name';
                    $field_label = __('labels.backend.products.fields.name');
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
                    $field_name = 'project_id';
                    $field_label = __('labels.backend.products.fields.project_id');
                    $field_placeholder = $field_label;
                    $required = "required";
                    $stageGroups = \App\Models\Project::pluck('name', 'id');
                    ?>
                    <div class="col-12 col-sm-2">
                        <div class="form-group">
                            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! fielf_required($required) !!}
                        </div>
                    </div>
                    <div class="col-12 col-sm-10">
                        <div class="form-group">
                            {{ html()->select($field_name, $stageGroups)
                                ->placeholder($field_placeholder)
                                ->class('form-control')
                                ->attributes([$required]) }}
                        </div>
                    </div>
                </div>
            


                <div class="row mb-3">
                    <?php
                    $field_name = 'price';
                    $field_label = __('labels.backend.products.fields.price');
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
                    $field_name = 'price';
                    $field_placeholder = $field_label;
                    $required = "";
                    ?>
                </div>

                <div class="row mb-3">
                    <?php
                    $field_name = 'quantity';
                    $field_label = __('labels.backend.products.fields.quantity');
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
                    $field_name = 'quantity';
                    $field_placeholder = $field_label;
                    $required = "";
                    ?>
                </div>


                <div class="row mb-3">
                    <?php
                    $field_name = 'group_management';
                    $field_label = __('labels.backend.products.fields.group_management');
                    $field_placeholder = $field_label;
                    $required = "required";
                    $groups = \App\Models\Group::pluck('name', 'id');
                    ?>
                    <div class="col-12 col-sm-2">
                        <div class="form-group">
                            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! fielf_required($required) !!}
                        </div>
                    </div>
                    <div class="col-12 col-sm-10">
                        <div class="form-group">
                            {{ html()->select($field_name, $groups)
                                ->placeholder($field_placeholder)
                                ->class('form-control')
                                ->attributes([$required]) }}
                        </div>
                    </div>
                </div>
                


                <div class="row mb-3">
                    <?php
                    $field_name = 'number_of_employees';
                    $field_label = __('labels.backend.products.fields.number_of_employees');
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
                    $field_name = 'number_of_employees';
                    $field_placeholder = $field_label;
                    $required = "";
                    ?>
                </div>


                <div class="row mb-3">
                    <?php
                    $field_name = 'time_to_complete';
                    $field_label = __('labels.backend.products.fields.time_to_complete');
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
                    $field_name = 'time_each_employee';
                    $field_placeholder = $field_label;
                    $required = "";
                    ?>
                </div>

                <div class="row mb-3">
                    <?php
                    $field_name = 'time_to_complete';
                    $field_label = __('labels.backend.products.fields.time_each_employee');
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
                    $field_name = 'time_each_employee';
                    $field_placeholder = $field_label;
                    $required = "";
                    ?>
                </div>

                <div class="row mb-3">
                    <?php
                    $field_name = 'average_productivity';
                    $field_label = __('labels.backend.products.fields.average_productivity');
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
                    $field_name = 'average_productivity';
                    $field_placeholder = $field_label;
                    $required = "";
                    ?>
                </div>

                <div class="row mb-3">
                    <?php
                    $field_name = 'average_productivity_each_employee';
                    $field_label = __('labels.backend.products.fields.average_productivity_each_employee');
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
                    $field_name = 'average_productivity_each_employee';
                    $field_placeholder = $field_label;
                    $required = "";
                    ?>
                </div>

                <div class="row mb-3">
                    <?php
                    $field_name = 'total_time';
                    $field_label = __('labels.backend.products.fields.total_time');
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
                    $field_name = 'total_time';
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