<link rel="stylesheet" href="{{ asset('css/sticker.css') }}">

<div class="sticker">
    <div class="head">
        <img src="{{ asset('img/qaf.png') }}" alt="">
        <div id="title">QATAR ARMED FORCES</div>
        <div id="subtitle">Qatar Emiri Signal &amp; Information Technology Corps</div>
    </div>
    <div class="body">
        <div class="serials">
            <div class="row">
                <div class="column1">

                    <span class="label">User name</span>
                </div>
                <div class="column2">
                    <span class="label">إسم المستخدم</span>
                </div>
                <div class="column3">
                    <span class="label">:  {{ $user_name }}</span>
                </div>
            </div>
            <div class="row">
                <div class="column1">
                    <span class="label">Computer name</span>
                </div>
                <div class="column2">
                    <span class="label">إسم الكمبيوتر</span>
                </div>
                <div class="column3">
                    <span class="label">:  {{ $computer_name }}</span>
                </div>
            </div>
            <div class="row">
                <div class="column1">
                    <span class="label">IP Address</span>
                </div>
                <div class="column2">
                    <span class="label">العنوان الشبكي</span>
                </div>
                <div class="column3">
                    <span class="label">:  {{ $ip_address }}</span>
                </div>
            </div>
            <div class="row">
                <div class="column1">
                    <span class="label">Helpdesk Number</span>
                </div>
                <div class="column2">
                    <span class="label">مركز الإتصال</span>
                </div>
                <div class="column3">
                    <span class="label">:  11100</span>
                </div>
            </div>
        </div>
    </div>
</div>



