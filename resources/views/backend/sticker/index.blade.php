@extends('backend.layouts.app')

@section('title', __('Stickers'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <x-backend.card>
                <x-slot name="header">
                    List of Letters
                    <x-slot name="headerActions">
                        <x-utils.link
                            icon="c-icon cil-plus"
                            class="card-header-action"
                            :href="route('admin.sticker.generate')"
                            :text="__('Create Sticker')"
                        />
                    </x-slot>
                </x-slot>
                <x-slot name="body">
                    {{ $dataTable->table()}}
                </x-slot>
            </x-backend.card>
        </div>
        <div class="col-md-9">
@endsection
@push('after-scripts')
    {{$dataTable->scripts()}}
@endpush
