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
                <x-buttons.create route='{{ route("backend.stage_users.create") }}' title="{{__('Create')}} {{ ucwords(Str::singular($module_name)) }}" />
            </x-slot>
        </x-backend.section-header>
        <form method="GET" action="{{ route("backend.stage_users.index") }}">
            <div class="row mb-3 mt-3">
                <div class="col-md-4">
                    <input type="text" name="search_name" class="form-control" placeholder="{{ __('Tên sản phẩm/tên công đoạn') }}" value="{{ request('search_name') }}">
                </div>
                <div class="col-md-4">
                    <input type="date" name="search_date" class="form-control" value="{{ request('search_date') }}">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">{{ __('Tìm kiếm') }}</button>
                    <a href="{{ route("backend.stage_users.index") }}" class="btn btn-secondary">{{ __('Cài lại') }}</a>
                </div>
            </div>
        </form>
        <div class="row mt-4">
            <div class="col">
                <table class="table table-hover table-responsive-sm">
                    <thead>
                        <tr>
                            <th>{{ __("labels.backend.stage_users.fields.stt") }}</th>
                            <th>{{ __("labels.backend.stage_users.fields.product") }}</th>
                            <th>{{ __("labels.backend.stage_users.fields.stage") }}</th>
                            <th>{{ __("labels.backend.stage_users.fields.group_stage") }}</th>
                            <th>{{ __("labels.backend.stage_users.fields.quantity") }}</th>
                            <th>{{ __("labels.backend.stage_users.fields.created_at") }}</th>
                            <th class="text-end">{{ __("labels.backend.action") }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($module_name as $module_name_singular)
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
                                    {{ $module_name_singular->stageGroup->name ?? null }}
                                </strong>
                            </td>
                            <td>
                                <strong>
                                    {{ $module_name_singular->total }}
                                </strong>
                            </td>
                            <td>
                                <strong>
                                    {{ $module_name_singular->created_at->format('d/m/Y') }}
                                </strong>
                            </td>
                            
                            <td class="text-end">
                                @can('edit_stage_users')
                                <x-buttons.edit route='{!!route("backend.stage_users.edit", $module_name_singular)!!}' title="{{__('Edit')}} " small="true" />
                                @endcan
                                <x-buttons.show route='{!!route("backend.stage_users.show", $module_name_singular)!!}' title="{{__('Show')}} " small="true" />
                                @can('delete_stage_users')
                                <a href='{{route("backend.stage_users.destroy", $module_name_singular)}}' class="btn btn-danger" data-method="DELETE" data-token="{{csrf_token()}}" data-toggle="tooltip" title="{{__('Delete')}}"><i class="fas fa-trash-alt"></i></a>
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
                    {!! $module_name->total() !!} {{ __('labels.backend.total') }}
                </div>
            </div>
            <div class="col-5">
                <div class="float-end">
                    {!! $module_name->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection