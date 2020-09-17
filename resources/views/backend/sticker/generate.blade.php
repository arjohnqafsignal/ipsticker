@extends('backend.layouts.app')

@section('title', __('Generate Stickers'))

@section('content')
    <div class="row">
        <div class="col-md-3">
            <x-backend.card>
                <x-slot name="header">
                    Letter Information

                </x-slot>
                <x-slot name="body">
                    <div class="form-group">
                        <label for="name" class="form-label">Letter Number</label>
                        <input type="text" id="letterNumber" class="form-control text-uppercase" maxlength="100" required value="{{ ($letterNumber) ? $letterNumber : null }}" <?= (count($stickers) > 0) ? 'readonly' : '' ?> />
                    </div><!--form-group-->

                    <div class="form-group">
                        <label for="name" class="form-label">Letter Date</label>
                        <input type="date" name="serialize" id="letterDate" class="form-control" value="{{ date('Y-m-d') }}" maxlength="100" required/>
                        <input type="hidden" id="letterCount" value="{{ $letterCode }}">
                        <input type="hidden" id="stickerCount" value="{{ $stickerCount }}">
                    </div><!--form-group-->
                </x-slot>
            </x-backend.card>

        </div>
        <div class="col-md-9">

        <x-backend.card>
                <x-slot name="header">
                    Stickers Information
                    <button class="btn btn-sm btn-secondary float-right" type="button" onclick="addSticker()">@lang('Add Sticker')</button>
                </x-slot>
                <x-slot name="body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Sticker Type</th>
                                <th>Serialize</th>
                                <th>Serial Number</th>
                                <th>Person Name</th>
                                <th>Unit Name</th>
                                <th>Military Number</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($stickers) > 0)
                            @foreach($stickers as $key => $sticker)
                                <tr>
                                    <td>{{ $sticker['sticker_type'] }}</td>
                                    <td>{{ $sticker['serialize'] }}</td>
                                    <td>{{ $sticker['serialize_number'] }}</td>
                                    <td>{{ $sticker['person_name'] }}</td>
                                    <td>{{ $sticker['unit_name'] }}</td>
                                    <td>{{ $sticker['military_number'] }}</td>
                                    <td>
                                        {{-- <button class="btn btn-xs btn-secondary" onClick="editSticker({{$key}})">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button> --}}
                                        <button class="btn btn-xs btn-danger" onClick="removeSticker('{{ $sticker['serialize'] }}')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                    <input type="hidden" id="sticker_type{{ $key }}" value="{{ $sticker['sticker_type'] }}">
                                    <input type="hidden" id="serialize{{ $key }}" value="{{ $sticker['serialize'] }}">
                                    <input type="hidden" id="serialize_number{{ $key }}" value="{{ $sticker['serialize_number'] }}">
                                    <input type="hidden" id="person_name{{ $key }}" value="{{ $sticker['person_name'] }}">
                                    <input type="hidden" id="unit_name{{ $key }}" value="{{ $sticker['unit_name'] }}">
                                    <input type="hidden" id="military_number{{ $key }}" value="{{ $sticker['military_number'] }}">
                                    <input type="hidden" id="rank{{ $key }}" value="{{ $sticker['rank'] }}">
                                </tr>
                            @endforeach
                            @else
                                <tr>
                                    <td colspan="7">
                                        <div class="alert alert-warning">Click Add Sticker to Before Generate.</div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                </x-slot>
                <x-slot name="footer">
                    <form action="{{ route('admin.sticker.savestickers') }}" method="POST">
                        @csrf
                        <button class="btn btn-success float-right ml-2" type="submit" <?= (count($stickers) < 1) ? 'disabled' : '' ?> ><i class="fas fa-save"></i> @lang('Save')</button>
                    </form>
                    <button class="btn btn-primary float-right" onClick="generateStickers()" type="submit" <?= (count($stickers) < 1) ? 'disabled' : '' ?> ><i class="fas fa-print"></i> @lang('Generate')</button>
                </x-slot>
            </x-backend.card>
        </div>
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
                            <label for="name" class="col-md-3 col-form-label">Computer Type</label>
                            <div class="col-md-9">
                                <select name="sticker_type" id="sticker_type" class="form-control" onChange="calibrateSerialize()" required>
                                    <option value="">- Select Type -</option>
                                    <option value="HR">HR</option>
                                    <option value="AR">Archive</option>
                                    <option value="SA">Standalone</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label">Serialize</label>

                            <div class="col-md-9">
                                <input type="text" id="serialize" name="serialize" class="form-control" maxlength="100" required readonly/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label">Serial Number</label>

                            <div class="col-md-9">
                                <input type="text" name="serialize_number" class="form-control" maxlength="100" required autofocus placeholder="Scan using Barcode Reader"/>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label">Unit Name</label>

                            <div class="col-md-9">
                                <input type="text" name="unit_name" class="form-control"  maxlength="100" required/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label">Military Number</label>

                            <div class="col-md-9">
                                <input type="text" name="military_number" class="form-control" maxlength="100" required/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label">Rank</label>

                            <div class="col-md-9">
                                <input type="text" name="rank" class="form-control" maxlength="100" required/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label">Person Name</label>

                            <div class="col-md-9">
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
    <div class="modal fade" id="editSticker" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <form id="updateStickerForm" action="{{ route('admin.sticker.editsticker') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Sticker</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label">Computer Type</label>
                            <div class="col-md-9">
                                <select name="sticker_type" id="editStickerType" class="form-control" disabled required>
                                    <option value="">- Select Type -</option>
                                    <option value="HR">HR</option>
                                    <option value="AR">Archive</option>
                                    <option value="SA">Standalone</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label">Serialize</label>

                            <div class="col-md-9">
                                <input type="text" id="editSerialize" name="serialize" class="form-control" maxlength="100" required readonly/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label">Serial Number</label>

                            <div class="col-md-9">
                                <input type="text" id="editSerializeNumber" name="serialize_number" class="form-control" maxlength="100" required autofocus placeholder="Scan using Barcode Reader"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label">Unit Name</label>

                            <div class="col-md-9">
                                <input type="text" id="editUnitName" name="unit_name" class="form-control"  maxlength="100" required/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label">Military Number</label>

                            <div class="col-md-9">
                                <input type="text" id="editMilitaryNumber" name="military_number" class="form-control" maxlength="100" required/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label">Rank</label>

                            <div class="col-md-9">
                                <input type="text" id="editRank" name="rank" class="form-control" maxlength="100" required/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label">Person Name</label>

                            <div class="col-md-9">
                                <input type="text" id="editPersonName" name="person_name" class="form-control" maxlength="100" required/>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" value="Update" class="btn btn-success" id="formUpdateBtn" />
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('after-scripts')
<script>
    // $('#stickerForm').submit((e)=>{

    //     $('#formSubmitBtn').removeAttr('disabled');
    //     e.preventDefault();
    //     let formData = $('#stickerForm').serializeArray();
    //     var toObject = {};
    //     for (var i = 0; i < formData.length; i++){
    //         toObject[formData[i]['name']] = formData[i]['value'];
    //     }
    //     let stickers = localStorage.getItem('stickers');
    //     if(stickers === null) {
    //         stickers = [];
    //     }
    //     else {
    //         stickers = JSON.parse(stickers);
    //     }

    //     let mergedStickers = stickers.concat(toObject)
    //     localStorage.setItem('stickers', JSON.stringify(mergedStickers));
    //     $('#addSticker').modal('hide');
    //     $('#stickerForm').trigger("reset");


    // });

    function generateStickers() {
        var height = 320 * {{ count($stickers) }}
        window.open("{{ route('admin.sticker.generatesticker') }}", 'targetWindow', 'toolbar=yes,location=no,status=no,menubar=no,scrollbars=no,resizable=no');
    }
    function addSticker() {
        let letterNumber = $('#letterNumber').val();
        if(letterNumber) {
            $('#addSticker').modal('show');
        }
        else {
            Swal.fire(
                'Please provide Letter Number',
                '',
                'error'
            );
        }
    }

    function calibrateSerialize() {
        let serialize = "";
        let type = $('#sticker_type').val();
        let letterCount = $('#letterCount').val();
        let stickerCount = $('#stickerCount').val();
        let letterNumber = $('#letterNumber').val();
        let letterDate = $('#letterDate').val();
        let stickers = (localStorage.getItem('stickers')) ? JSON.parse(localStorage.getItem('stickers')) : [];
        let stickerCode = stickers.length + 1;
        serialize = type + letterCount + letterNumber.toUpperCase() + stickerCount;
        $('#letter_number').val(letterNumber.toUpperCase());
        $('#letter_date').val(letterDate);
        $('#serialize').val(serialize);
    }

    function editSticker(key) {
        $('#editStickerType').val($('#sticker_type' + key).val());
        $('#editSerialize').val($('#serialize' + key).val());
        $('#editSerializeNumber').val($('#serialize_number' + key).val());
        $('#editUnitName').val($('#unit_name' + key).val());
        $('#editMilitaryNumber').val($('#military_number' + key).val());
        $('#editRank').val($('#rank' + key).val());
        $('#editPersonName').val($('#person_name' + key).val());
        $('#editSticker').modal('show');
    }

    function removeSticker(key) {

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
                window.location.href = "/admin/sticker/clearsticker/" + key
            }
        })
    }
</script>
@endpush

