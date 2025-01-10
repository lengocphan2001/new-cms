@extends('backend.layouts.app')

@section('title') {{ __($module_action) }} {{ __($module_title) }} @endsection

@section('breadcrumbs')
<x-backend.breadcrumbs>
    <x-backend.breadcrumb-item route='{{route("backend.$module_name.index")}}' icon='{{ $module_icon }}'>
        {{ __($module_title) }}
    </x-backend.breadcrumb-item>
    <x-backend.breadcrumb-item route='{{route("backend.$module_name.show", $user->id)}}' icon='{{ $module_icon }}'>
        {{ $user->name }}
    </x-backend.breadcrumb-item>

    <x-backend.breadcrumb-item type="active">{{ __($module_action) }}</x-backend.breadcrumb-item>
</x-backend.breadcrumbs>
@endsection

@section('content')
<x-backend.layouts-edit :data="$user">
    <x-backend.section-header>
        <i class="{{ $module_icon }}"></i> {{ __('Profile') }} <small class="text-muted">{{ __($module_action) }}</small>

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
            {{ html()->modelForm($userprofile, 'PATCH', route('backend.users.profileUpdate', $$module_name_singular->id))->class('form-horizontal')->attributes(['enctype'=>"multipart/form-data"])->open() }}
            <div class="form-group row">
                {{ html()->label(__('labels.backend.users.fields.avatar'))->class('col-md-2 form-control-label')->for('name') }}

                <div class="col-md-5">
                    <img src="{{asset($$module_name_singular->avatar)}}" class="user-profile-image img-fluid img-thumbnail" style="max-height:200px; max-width:200px;" />
                </div>
                <div class="col-md-5">
                    <input id="file-multiple-input" name="avatar" multiple="" type="file">
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-sm-6 mb-3">
                    <div class="form-group">
                        <?php
                        $field_name = 'first_name';
                        $field_label = label_case($field_name);
                        $field_placeholder = $field_label;
                        $required = "required";
                        ?>
                        {{ html()->label($field_label, $field_name)->class('form-label') }} {!! fielf_required($required) !!}
                        {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
                    </div>
                </div>
                <div class="col-12 col-sm-6 mb-3">
                    <div class="form-group">
                        <?php
                        $field_name = 'last_name';
                        $field_label = label_case($field_name);
                        $field_placeholder = $field_label;
                        $required = "required";
                        ?>
                        {{ html()->label($field_label, $field_name)->class('form-label') }} {!! fielf_required($required) !!}
                        {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
                    </div>
                </div>
                <div class="col-12 col-sm-6 mb-3">
                    <div class="form-group">
                        <?php
                        $field_name = 'email';
                        $field_label = label_case($field_name);
                        $field_placeholder = $field_label;
                        $required = "required";
                        ?>
                        {{ html()->label($field_label, $field_name)->class('form-label') }} {!! fielf_required($required) !!}
                        {{ html()->email($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
                    </div>
                </div>
                <div class="col-12 col-sm-6 mb-3">
                    <div class="form-group">
                        <?php
                        $field_name = 'mobile';
                        $field_label = label_case($field_name);
                        $field_placeholder = $field_label;
                        $required = "";
                        ?>
                        {{ html()->label($field_label, $field_name)->class('form-label') }} {!! fielf_required($required) !!}
                        {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-sm-6 mb-3">
                    <div class="form-group">
                        <?php
                        $field_name = 'gender';
                        $field_label = label_case($field_name);
                        $field_placeholder = __("Select an option");
                        $required = "";
                        $select_options = [
                            'Female' => 'Female',
                            'Male' => 'Male',
                            'Other' => 'Other',
                        ];
                        ?>
                        {{ html()->label($field_label, $field_name)->class('form-label') }} {!! fielf_required($required) !!}
                        {{ html()->select($field_name, $select_options)->placeholder($field_placeholder)->class('form-select')->attributes(["$required"]) }}
                    </div>
                </div>

                <div class="col-12 col-sm-6 mb-3">
                    <div class="form-group">
                        <?php
                        $field_name = 'date_of_birth';
                        $field_label = label_case($field_name);
                        $field_placeholder = $field_label;
                        $required = "";
                        ?>
                        {{ html()->label($field_label, $field_name)->class('form-label') }} {!! fielf_required($required) !!}
                        {{ html()->date($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-sm-6 mb-3">
                    <div class="form-group">
                        <?php
                        $field_name = 'address';
                        $field_label = label_case($field_name);
                        $field_placeholder = $field_label;
                        $required = "";
                        ?>
                        {{ html()->label($field_label, $field_name)->class('form-label') }} {!! fielf_required($required) !!}
                        {{ html()->textarea($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
                    </div>
                </div>
                <div class="col-12 col-sm-6 mb-3">
                    <div class="form-group">
                        <?php
                        $field_name = 'bio';
                        $field_label = label_case($field_name);
                        $field_placeholder = $field_label;
                        $required = "";
                        ?>
                        {{ html()->label($field_label, $field_name)->class('form-label') }} {!! fielf_required($required) !!}
                        {{ html()->textarea($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mb-3">
                    <div class="form-group">
                        <?php
                        $field_name = 'url_website';
                        $field_label = label_case($field_name);
                        $field_placeholder = $field_label;
                        $required = "";
                        ?>
                        {{ html()->label($field_label, $field_name)->class('form-label') }} {!! fielf_required($required) !!}
                        {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-6">
                    <x-buttons.save />
                </div>
                <div class="col-6 text-end">
                    <x-buttons.cancel />
                </div>
            </div>
            {{ html()->closeModelForm() }}
        </div>
    </div>
</x-backend.layouts.edit>
@endsection