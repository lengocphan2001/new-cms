@extends('backend.layouts.app')

@section('title') {{ __($module_action) }} {{ __($module_title) }} @endsection

@section('breadcrumbs')
<x-backend.breadcrumbs>
    <x-backend.breadcrumb-item type="active" icon='{{ $module_icon }}'>{{ __($module_title) }}</x-backend.breadcrumb-item>
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
                <x-buttons.create route='{{ route("backend.$module_name.create") }}' title="{{__('Create')}} {{ ucwords(Str::singular($module_name)) }}" />
            </x-slot>
        </x-backend.section-header>
        <form method="GET" action="{{ route("backend.$module_name.index") }}">
            <div class="row mb-3 mt-3">
                <div class="col-md-4">
                    <input type="text" name="search_name" class="form-control" placeholder="{{ __('Search by Name') }}" value="{{ request('search_name') }}">
                </div>
                <div class="col-md-4">
                    <input type="date" name="search_date" class="form-control" value="{{ request('search_date') }}">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">{{ __('Search') }}</button>
                    <a href="{{ route("backend.$module_name.index") }}" class="btn btn-secondary">{{ __('Reset') }}</a>
                </div>
            </div>
        </form>
        <div class="row mt-4">
            <div class="col">
                <table class="table table-hover table-responsive-sm">
                    <thead>
                        <tr>
                            <th>{{ __("labels.backend.$module_name.fields.stt") }}</th>
                            <th>{{ __("labels.backend.$module_name.fields.product") }}</th>
                            <th>{{ __("labels.backend.$module_name.fields.stage") }}</th>
                            <th>{{ __("labels.backend.$module_name.fields.user") }}</th>
                            <th>{{ __("labels.backend.$module_name.fields.quantity") }}</th>
                            <th class="text-end">{{ __("labels.backend.action") }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($$module_name as $module_name_singular)
                        <tr>
                            <td>
                                <strong>
                                    {{ $loop->index + 1}}
                                </strong>
                            </td>
                            <td>
                                <strong>
                                    {{ $module_name_singular->product->name }}
                                </strong>
                            </td>
                            <td>
                                <strong>
                                    {{ $module_name_singular->stage->name }}
                                </strong>
                            </td>
                            <td>
                                <strong>
                                    {{ $module_name_singular->user->name }}
                                </strong>
                            </td>
                            <td>
                                <strong>
                                    {{ $module_name_singular->total }}
                                </strong>
                            </td>
                            <td class="text-end">
                                @can('edit_'.$module_name)
                                <x-buttons.edit route='{!!route("backend.$module_name.edit", $module_name_singular)!!}' title="{{__('Edit')}} " small="true" />
                                @endcan
                                <x-buttons.show route='{!!route("backend.$module_name.show", $module_name_singular)!!}' title="{{__('Show')}} " small="true" />
                                @can('delete_'.$module_name)
                                <a href='{{route("backend.$module_name.destroy", $module_name_singular)}}' class="btn btn-danger" data-method="DELETE" data-token="{{csrf_token()}}" data-toggle="tooltip" title="{{__('Delete')}}"><i class="fas fa-trash-alt"></i></a>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                    {!! $$module_name->total() !!} {{ __('labels.backend.total') }}
                </div>
            </div>
            <div class="col-5">
                <div class="float-end">
                    {!! $$module_name->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection