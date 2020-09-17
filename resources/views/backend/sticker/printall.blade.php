<link rel="stylesheet" href="{{ asset('css/sticker.css') }}">

@foreach($stickers as $key => $sticker)
<?php
    $mt = ($key > 0) ? 'margin-top: 20px' : 'margin-top: 0px';
?>
<div class="sticker" style="{{ $mt }}">
    <div class="head">
        <img src="{{ asset('img/qaf.png') }}" alt="" style="{{ $mt }}">
        <div id="title">QATAR ARMED FORCES</div>
        <div id="subtitle">Qatar Emiri Signal &amp; Information Technology Corps</div>
    </div>
    <div class="body">
        <div class="serials">
            <div class="row">
                <div class="column">
                <span class="label">SI: {{ $sticker['serialize'] }} </span>
                </div>
                <div class="column">
                    <span class="label">Serial Number: {{ $sticker['serialize_number'] }}</span>
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <span class="label">Letter Number: {{ $sticker['letter_number'] }}</span>
                </div>
                <div class="column">
                    <span class="label">Letter Date: {{ $sticker['letter_date'] }}</span>
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <span class="label">Computer Type: {{ $sticker['sticker_type'] }}</span>
                </div>
                <div class="column">
                    <span class="label">Unit Name: {{ $sticker['unit_name'] }}</span>
                </div>
            </div>
        </div>
        <div class="units">
            <div class="row">
                <div class="column">
                    <div class="row">
                        <span class="label">Person Name: {{ $sticker['person_name'] }}</span>
                    </div>
                    <div class="row">
                        <span class="label">Military Number: {{ $sticker['military_number'] }}</span>
                    </div>
                    <div class="row">
                        <span class="label">Rank: {{ $sticker['serialize'] }}</span>
                    </div>
                </div>
                <div class="column">
                    <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($sticker['serialize'], 'C39',1,25)}}" alt="barcode" />
                    {{-- <img src="{{ DNS2D::getBarcodePNGPath('4445645656', 'PDF417') }}" alt="barcode" /> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
