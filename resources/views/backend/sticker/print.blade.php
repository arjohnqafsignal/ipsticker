<link rel="stylesheet" href="{{ asset('css/sticker.css') }}">

@foreach($stickers as $key => $sticker)
<?php
    $mt = ($key > 0) ? 'margin-top: 10px' : 'margin-top: 0px';
?>
<div class="sticker" style="">
    <div class="head">
        <img src="{{ asset('img/qaf.png') }}" alt="" style="{{ $mt }}">
        <div id="title">QATAR ARMED FORCES</div>
        <div id="subtitle">Qatar Emiri Signal &amp; Information Technology Corps</div>
    </div>
    <div class="body">
        <div class="serials">
            <div class="row">
                <div class="column">
                    <span class="label">Serial Number: {{ $sticker['serialize_number'] }}</span>
                </div>
                <div class="column">
                    <span class="label">Computer Type: {{ $sticker['sticker_type'] }}</span>
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
                    <span class="label">Unit Name: {{ $sticker['unit_name'] }}</span>
                </div>
                <div class="column">
                    <span class="label">Person Name: {{ $sticker['person_name'] }}</span>
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <span class="label">Military Number: {{ $sticker['military_number'] }}</span>
                </div>
                <div class="column">
                    <span class="label">Rank: {{ $sticker['rank'] }}</span>
                </div>
            </div>
        </div>
        <div class="units">
            <div class="row">
                <div class="column">
                    <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($sticker['serialize'], 'C39',1,35,array(1,1,1), true)}}" alt="barcode" style="margin-left: 50px;" />
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
