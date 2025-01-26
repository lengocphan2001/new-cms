@extends ("backend.layouts.app")

@section('title') {{ __($module_action) }} {{ __($module_title) }} @endsection

@section('breadcrumbs')
<x-backend.breadcrumbs>
    <x-backend.breadcrumb-item route='{{route("backend.$module_name.index")}}' icon='{{ $module_icon }}'>
        {{ __($module_title) }}
    </x-backend.breadcrumb-item>

    <x-backend.breadcrumb-item type="active">{{ __($module_action) }}</x-backend.breadcrumb-item>
</x-backend.breadcrumbs>
@endsection

@section("content")
<div class="card">
    <div class="card-body">
        <x-backend.section-header>
            <i class="{{ $module_icon }}"></i> {{ __($module_title) }} <small class="text-muted">{{ __($module_action) }}</small>

            <x-slot name="subtitle">
                @lang(":module_name Management Dashboard", ['module_name'=>__(Str::title($module_name))])
            </x-slot>
            <x-slot name="toolbar">
                <x-buttons.return-back />
                <x-buttons.show route='{!!route("backend.$module_name.show", $$module_name_singular)!!}' title="{{__('Show')}} {{ ucwords(Str::singular($module_name)) }}" class="ms-1" />
            </x-slot>
        </x-backend.section-header>

        <hr>
        <div class="row mt-4">
            <div class="col">
                {{ html()->modelForm($$module_name_singular, 'POST', route("backend.$module_name.post_assign_stages", $$module_name_singular->id))->class('form-horizontal')->open() }}

                <div class="form-group row mb-3">
                    {{ html()->label('Công đoạn')->class('col-sm-2 mb-2 form-control-label') }}
                    @if ($stage_groups->count())
                    @foreach ($stage_groups as $stage_group)
                    <div class="row">
                        <div class="row mb-3">
                            <div class="col">
                                <div class="card card-accent-primary">
                                    <div class="card-header">
                                        {{ html()->label(html()->checkbox('stage_groups[]', false, $stage_group->id)->id('stage_group-'.$stage_group->id) . ' ' . $stage_group->name)->for('stage_group-'.$stage_group->id) }}
                                    </div>
                                    <div class="card-body">
                                        <div class="card-body">
                                            @if ($stage_group->stages->count())
                                            @foreach($stage_group->stages as $stage)
                                            <div class="checkbox">
                                                {{ html()->label(html()->checkbox('stages[]', false, $stage->id)->id('stage-'.$stage->id) . ' ' . $stage->name)->for('stage-'.$stage->id) }}
                                            </div>
                                            @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>

                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <x-buttons.save />
                        </div>
                    </div>

                    <div class="col-8">
                        <div class="float-end">
                            <a href="{{route("backend.$module_name.destroy", $$module_name_singular)}}" class="btn btn-danger" data-method="DELETE" data-token="{{csrf_token()}}" data-toggle="tooltip" title="{{__('labels.backend.delete')}}"><i class="fas fa-trash-alt"></i></a>
                            <x-buttons.return-back>Cancel</x-buttons.return-back>
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
                    Updated: {{$$module_name_singular->updated_at->diffForHumans()}},
                    Created at: {{$$module_name_singular->created_at->isoFormat('LLLL')}}
                </small>
            </div>
        </div>
    </div>
</div>

@endsection