@extends('backend.layouts.app')

@section('title', __('Stickers'))

@section('breadcrumb-links')
    @include('backend.sticker.includes.breadcrumbs')
@endsection

@section('content')
<link rel="stylesheet" href="{{ asset('css/sticker.css') }}">
    <div class="row">
        <div class="col-md-12">
            <x-backend.card>
                <x-slot name="header">
                    View Letter
                </x-slot>
                <x-slot name="body">
                    <div id="dwtcontrolContainer"></div>
                </x-slot>
            </x-backend.card>
        </div>

@endsection
@push('after-scripts')
<script type="text/javascript" src="{{ asset('Resources/dynamsoft.webtwain.initiate.js') }}"></script>
<script type="text/javascript" src="{{ asset('Resources/dynamsoft.webtwain.config.js') }}"></script>
    <script>
        var console = window['console'] ? window['console'] : { 'log': function () { } };

        Dynamsoft.WebTwainEnv.RegisterEvent('OnWebTwainReady', Dynamsoft_OnReady); // Register OnWebTwainReady event. This event fires as soon as Dynamic Web TWAIN is initialized and ready to be used

        var DWObject;

        function Dynamsoft_OnReady() {
            DWObject = Dynamsoft.WebTwainEnv.GetWebTwain('dwtcontrolContainer'); // Get the Dynamic Web TWAIN object that is embeded in the div with id 'dwtcontrolContainer'
            if (DWObject) {
                var count = DWObject.SourceCount; // Get how many sources are installed in the system

                for (var i = 0; i < count; i++)
                    document.getElementById("source").options.add(new Option(DWObject.GetSourceNameItems(i), i)); // Add the sources in a drop-down list

                // The event OnPostTransfer fires after each image is scanned and transferred
                DWObject.RegisterEvent("OnPostTransfer", function () {
                    setTimeout(updatePageInfo,20);
                });

                // The event OnPostLoad fires after the images from a local directory have been loaded into the control
                DWObject.RegisterEvent("OnPostLoad", function () {
                    setTimeout(updatePageInfo,20);
                });

                // The event OnMouseClick fires when the mouse clicks on an image on Dynamic Web TWAIN viewer
                DWObject.RegisterEvent("OnMouseClick", function () {
                updatePageInfo();
                });

                // The event OnTopImageInTheViewChanged fires when the top image currently displayed in the viewer changes
                DWObject.RegisterEvent("OnTopImageInTheViewChanged", function (index) {
                    DWObject.CurrentImageIndexInBuffer = index;
                    updatePageInfo();
                });
            }
        }
    </script>
@endpush
