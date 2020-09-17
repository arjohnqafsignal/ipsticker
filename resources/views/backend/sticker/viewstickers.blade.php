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
                    List of Stickers
                    <x-slot name="headerActions">
                        <button class="btn card-header-action" onClick="openPrintAll()"><i class="c-icon cil-print"></i> Print All</button>
                        <button class="btn card-header-action" data-toggle="modal" data-target="#addSticker"><i class="c-icon cil-plus"></i> Add</button>
                    </x-slot>
                </x-slot>
                <x-slot name="body">
                    <div class="row">
                        @foreach($stickers as $sticker)
                        <div class="col-md-4">
                            <div class="card" style="height:250px;">
                                <button class="btn btn-sm btn-danger" onClick="deleteSticker({{$sticker->id}})" style="position: absolute; top: 10px; right: 10px;"><i class="fas fa-trash"></i></button>
                                <button class="btn btn-sm btn-secondary" onClick="window.open('{{ route('admin.sticker.printsingle', $sticker->id) }}', 'targetWindow', 'toolbar=yes,location=no,status=no,menubar=no,scrollbars=no,resizable=no')" style="position: absolute; top: 10px; right: 45px;"><i class="fas fa-print"></i></button>
                                <div class="card-body">
                                    <div class="sticker" style="">
                                        <div class="head">
                                            <img src="{{ asset('img/qaf.png') }}" alt="">
                                            <div id="title">QATAR ARMED FORCES</div>
                                            <div id="subtitle">Qatar Emiri Signal &amp; Information Technology Corps</div>
                                        </div>
                                        <div class="body">
                                            <div class="serials">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <span class="label">SI: {{ $sticker['serialize'] }} </span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <span class="label">Serial Number: {{ $sticker['serial_number'] }}</span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <span class="label">Letter Number: {{ $letter->letter_number }}</span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <span class="label">Letter Date: {{ $letter->letter_date }}</span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <span class="label">Computer Type: {{ $sticker['sticker_type'] }}</span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <span class="label">Unit Name: {{ $sticker['unit_name'] }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="units">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <span class="label">Person Name: {{ $sticker['person_name'] }}</span>
                                                        </div>
                                                        <div class="row">
                                                            <span class="label">Military Number: {{ $sticker['military_number'] }}</span>
                                                        </div>
                                                        <div class="row">
                                                            <span class="label">Rank: {{ $sticker['rank'] }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($sticker['serialize'], 'C39',1,25)}}" alt="barcode" />
                                                        {{-- <img src="{{ DNS2D::getBarcodePNGPath('4445645656', 'PDF417') }}" alt="barcode" /> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                </x-slot>
            </x-backend.card>
        </div>

        <div class="modal fade" id="addSticker" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <form id="stickerForm" action="{{ route('admin.sticker.addsticker') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Sticker</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label">Computer Type</label>
                                <div class="col-md-8">
                                    <select name="sticker_type" id="sticker_type" class="form-control" onChange="calibrateSerialize()" required>
                                        <option value="">- Select Type -</option>
                                        <option value="HR">HR</option>
                                        <option value="AR">Archive</option>
                                        <option value="SA">Standalone</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label">Serialize</label>

                                <div class="col-md-8">
                                    <input type="text" id="serialize" name="serialize" class="form-control" maxlength="100" required readonly/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label">Serial Number</label>

                                <div class="col-md-8">
                                    <input type="text" name="serialize_number" class="form-control" maxlength="100" required autofocus placeholder="Scan using Barcode Reader"/>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label">Unit Name</label>

                                <div class="col-md-8">
                                    <input type="text" name="unit_name" class="form-control"  maxlength="100" required/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label">Military Number</label>

                                <div class="col-md-8">
                                    <input type="text" name="military_number" class="form-control" maxlength="100" required/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label">Rank</label>

                                <div class="col-md-8">
                                    <input type="text" name="rank" class="form-control" maxlength="100" required/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label">Person Name</label>

                                <div class="col-md-8">
                                    <input type="text" name="person_name" class="form-control" maxlength="100" required/>
                                </div>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="letter_number" id="letter_number">
                        <input type="hidden" name="letter_date" id="letter_date">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" value="Submit" class="btn btn-success" id="formSubmitBtn" />
                    </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
@push('after-scripts')
    <script>
        function openPrintAll(){
            window.open("{{ route('admin.sticker.printall', $letter) }}", 'targetWindow', 'toolbar=yes,location=no,status=no,menubar=no,scrollbars=no,resizable=no');
        }
        function deleteSticker(key) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.value) {
                    window.location.href = "/admin/sticker/deletesticker/" + key
                }
            })
        }

        function calibrateSerialize() {
            let serialize = "";
            let type = $('#sticker_type').val();
            let letterCount = $('#letterCount').val();
            let stickerCount = '{{ $stickers_count }}'
            let letterNumber = '{{$letter->letter_number}}';
            let letterDate = $('#letterDate').val();
            serialize = type + letterCount + letterNumber.toUpperCase() + stickerCount;
            $('#letter_number').val(letterNumber.toUpperCase());
            $('#letter_date').val(letterDate);
            $('#serialize').val(serialize);
        }
    </script>
@endpush
