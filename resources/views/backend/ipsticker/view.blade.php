@inject('model', '\App\Domains\Auth\Models\User')

@extends('backend.layouts.app')

@section('title', __('View Sticker'))

@section('content')
    <x-forms.post :action="route('admin.ipsticker.update', $id)">
        <x-backend.card>
            <x-slot name="header">
                @lang('View IP Sticker')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.ipsticker.index')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">
                <div>
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label">@lang('User Name')</label>

                        <div class="col-md-10">
                            <input type="text" name="user_name" id="user_name" class="form-control" placeholder="{{ __('User Name') }}" value="{{ old('user_name', $user_name) }}" maxlength="100" required />
                        </div>
                    </div><!--form-group-->
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label">@lang('Computer Name')</label>

                        <div class="col-md-10">
                            <input type="text" name="computer_name" id="computer_name"  class="form-control" placeholder="{{ __('Computer Name') }}" value="{{ old('computer_name', $computer_name) }}" maxlength="100" required />
                        </div>
                    </div><!--form-group-->
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label">@lang('IP Address')</label>

                        <div class="col-md-10">
                            <input type="text" name="ip_address" id="ip_address"  class="form-control" placeholder="{{ __('IP Address') }}" value="{{ old('ip_address', $ip_address) }}" maxlength="100" required />
                        </div>
                    </div><!--form-group-->
                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right ml-2" type="submit">@lang('Save Sticker')</button>
                <button class="btn btn-sm btn-secondary float-right" type="button" onclick="generateSticker()">@lang('Generate Sticker')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.post>
@endsection
@push('after-scripts')
    <script>
        function generateSticker(){
            var user_name = $('#user_name').val();
            var computer_name = $('#computer_name').val();
            var ip_address = $('#ip_address').val();
            window.open("{{ route('admin.ipsticker.generate') }}/?user_name="+user_name+"&computer_name="+computer_name+"&ip_address="+ip_address, 'targetWindow', 'toolbar=yes,location=no,status=no,menubar=no,scrollbars=no,resizable=no');
        }
    </script>
@endpush
