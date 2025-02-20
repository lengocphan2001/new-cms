@extends('backend.layouts.app')

@section('title') {{ __('Chi tiết lương') }} @endsection

@section('breadcrumbs')
<x-backend.breadcrumbs>
    <x-backend.breadcrumb-item type="active" icon="fas fa-money-bill-wave">{{ __('Chi tiết lương') }}</x-backend.breadcrumb-item>
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
                @if(auth()->user()->hasRole('super admin'))
                <x-buttons.create route='{{ route("backend.$module_name.salary_details.create", $user) }}' title="{{__('Create')}} {{ ucwords(Str::singular($module_name)) }}" />
                @endif
            </x-slot>
        </x-backend.section-header>

        <div class="row mt-4">
            <div class="col">
        
                <table class="table table-hover table-responsive-sm">
                    <thead>
                        <tr>
                            <th>{{ __("STT") }}</th>
                            <th>{{ __("Tháng") }}</th>
                            <th>{{ __("Năm") }}</th>
                            <th class="text-end">{{ __("Hành động") }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($salaries as $salary)
                        <tr>
                            <td>
                                <strong>
                                    {{ $loop->index + 1 }}
                                </strong>
                            </td>
                            <td>{{ $salary->month }}</td>
                            <td>{{ $salary->year }}</td>
                            <td class="text-end">
                                <a href="{{ route("backend.$module_name.salary_details.show", $salary) }}" class="btn btn-info btn-sm">{{ __('Xem chi tiết') }}</a>
                                @if(auth()->user()->hasRole('super admin'))
                                <a href='{{route("backend.$module_name.destroy", $salary)}}' class="btn btn-danger" data-method="DELETE" data-token="{{csrf_token()}}" data-toggle="tooltip" title="{{__('Delete')}}"><i class="fas fa-trash-alt"></i></a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
            
    </div>
</div>
@endsection
