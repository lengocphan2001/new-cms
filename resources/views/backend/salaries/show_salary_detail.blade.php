@extends ('backend.layouts.app')

@section('title') {{ __($module_action) }} {{ __($module_title) }} @endsection

@section('breadcrumbs')
<x-backend.breadcrumbs>
    <x-backend.breadcrumb-item route='{{url()->previous()}}' icon='{{ $module_icon }}'>
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
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <th>{{ __("labels.backend.salary_details.fields.month") }}</th>
                            <td>{{ $$module_name_singular->created_at->format('F Y') }}</td>
                        </tr>

                        <tr>
                            <th>{{ __("labels.backend.salary_details.fields.allowance") }}</th>
                            <td>{{ number_format($$module_name_singular->allowance, 2) }} VND</td>
                        </tr>

                        <tr>
                            <th>{{ __("labels.backend.salary_details.fields.allowances") }}</th>
                            <td>{{ number_format($$module_name_singular->allowances, 2) }} VND</td>
                        </tr>

                        <tr>
                            <th>{{ __("labels.backend.salary_details.fields.product_salary") }}</th>
                            <td>{{ number_format($$module_name_singular->product_salary, 2) }} VND</td>
                        </tr>

                        <tr>
                            <th>{{ __("labels.backend.salary_details.fields.deductions") }}</th>
                            <td>{{ number_format($$module_name_singular->deductions, 2) }} VND</td>
                        </tr>

                        <tr>
                            <th>{{ __("labels.backend.salary_details.fields.total_salary") }}</th>
                            <td><strong>{{ number_format($$module_name_singular->total_salary, 2) }} VND</strong></td>
                        </tr>

                        <tr>
                            <th>{{ __("labels.backend.salary_details.fields.created_at") }}</th>
                            <td>{{ $$module_name_singular->created_at }}<br><small>({{ $$module_name_singular->created_at->diffForHumans() }})</small></td>
                        </tr>

                        <tr>
                            <th>{{ __("labels.backend.salary_details.fields.updated_at") }}</th>
                            <td>{{ $$module_name_singular->updated_at }}<br /><small>({{ $$module_name_singular->updated_at->diffForHumans() }})</small></td>
                        </tr>

                    </table>
                </div>
                <!--table-responsive-->
            </div>
            <!--/.col-->
        </div>
        <!--/.row-->
    </div>

    <div class="card-footer">
        <div class="row">
            <div class="col">
                <small class="float-end text-muted">
                    Updated: {{ $$module_name_singular->updated_at->diffForHumans() }},
                    Created at: {{ $$module_name_singular->created_at->isoFormat('LLLL') }}
                </small>
            </div>
        </div>
    </div>
</div>
@endsection
