<div class="col-12 col-md-12 layout-spacing" id="form-edit">
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row align-items-center text-center justify-content-center justify-content-md-between">
                <div class="col-12 col-md-auto">
                    <h4>Edit Table</h4>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area">
            <div>
                <form method="POST" autocomplete="off" aria-autocomplete="none" id="edit-table" onsubmit="submitFormUpdate(event)">
                    <div class="form-group row">
                        <div class="col form-validation" id="table-edit-number">
                            <label>Number*</label>
                            <input autocomplete="off" aria-autocomplete="none" type="number" class="form-control" name="number" />
                        </div>
                    </div>
                    <div class="row align-items-center justify-content-end">
                        <div class="col-auto">
                            <button type="submit" class="btn btn-button-4 btn-rounded mb-3">Submit</button>
                        </div>
                        <div class="col-auto">
                            <button type="reset" onclick="closeForm()" class="btn btn-button-5 btn-rounded md-close mb-3">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>