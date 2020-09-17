<template>
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    Letter Information
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name" class="form-label">Letter Number</label>
                        <input type="text" id="letterNumber" class="form-control" maxlength="100" required/>
                    </div><!--form-group-->

                    <div class="form-group">
                        <label for="name" class="form-label">Letter Date</label>
                        <input type="date" name="serialize" class="form-control"  maxlength="100" required/>
                    </div><!--form-group-->
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    Stickers Information
                    <button class="btn btn-success float-right" v-on:click="toggleModal(true)">Create</button>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Sticker Type</th>
                                <th>Serialize</th>
                                <th>Serial Number</th>
                                <th>Person Name</th>
                                <th>Unit Name</th>
                                <th>Military Number</th>
                                <th>Rank</th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary float-right" type="submit">Generate</button>
                </div>
            </div>
        </div>

    <div class="modal fade" id="addSticker" tabindex="-1" role="dialog"  aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Sticker</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                        <label for="name" class="col-md-3 col-form-label">Serial Number</label>

                        <div class="col-md-9">
                            <input type="text" name="serialize" class="form-control" maxlength="100" required autofocus/>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-3 col-form-label">Sticker Type</label>

                        <div class="col-md-9">
                            <select name="sticker_type" id="sticker_type" class="form-control">
                                <option value="">- Select Type -</option>
                                <option value="">HR</option>
                                <option value="">Archive</option>
                                <option value="">Standalone</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-3 col-form-label">Unit Name</label>

                        <div class="col-md-9">
                            <input type="text" name="serialize" class="form-control" maxlength="100" required/>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-3 col-form-label">Military Number</label>

                        <div class="col-md-9">
                            <input type="text" name="serialize" class="form-control" maxlength="100" required/>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-3 col-form-label">Rank</label>

                        <div class="col-md-9">
                            <input type="text" name="serialize" class="form-control" maxlength="100" required/>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-3 col-form-label">Person Name</label>

                        <div class="col-md-9">
                            <input type="text" name="serialize" class="form-control" maxlength="100" required/>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-3 col-form-label">Serialize</label>

                        <div class="col-md-9">
                            <input type="text" name="serialize" class="form-control" maxlength="100" required readonly value="001-022"/>
                        </div>
                    </div>
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
        </div>
    </div>
</template>

<script>

</script>
