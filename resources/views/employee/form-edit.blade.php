<div class="col-12 col-md-12 layout-spacing" id="form-edit">
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row align-items-center text-center justify-content-center justify-content-md-between">
                <div class="col-12 col-md-auto">
                    <h4>Edit Employee</h4>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area">
            <div>
                <form method="POST" autocomplete="off" aria-autocomplete="none" id="edit-employee" onsubmit="submitDataUpdate(event)">
                    <input type="hidden" name="imageUrl">
                    <div class="form-group row">
                        <div class="col form-validation" id="employee-edit-name">
                            <label>Name*</label>
                            <input autocomplete="off" aria-autocomplete="none" type="text" class="form-control" name="name" />
                        </div>
                        <div class="col form-validation" id="employee-edit-birth_date">
                            <label>Birth Date*</label>
                            <input autocomplete="off" aria-autocomplete="none" type="date" class="form-control" name="birth_date">
                        </div>
                        <div class="col form-validation" id="employee-edit-birth_place">
                            <label>Birth Place*</label>
                            <input autocomplete="off" aria-autocomplete="none" type="text" class="form-control" name="birth_place">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col form-validation" id="employee-edit-role_id">
                            <label>Role*</label>
                            <select class="form-control" name="role_id" title="Choose Role">
                                <option value="">Choose Role</option>
                                <option value="1">Admin</option>
                                <option value="2">Cashier</option>
                            </select>
                        </div>
                        <div class="col form-validation" id="employee-edit-gender">
                            <label>Gender*</label>
                            <select class="form-control" name="gender" title="Choose Gender">
                                <option value="">Choose Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="col form-validation" id="employee-edit-phone">
                            <label>Phone*</label>
                            <input autocomplete="off" aria-autocomplete="none" type="tel" class="form-control" name="phone">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col form-validation" id="employee-edit-email">
                            <label>Email*</label>
                            <input autocomplete="off" aria-autocomplete="none" type="email" class="form-control" name="email">
                        </div>
                        <div class="col form-validation" id="employee-edit-address">
                            <label>Address*</label>
                            <textarea class="form-control" name="address"></textarea>
                        </div>
                        <div class="col">
                            <label>Image*</label>
                            <input type="file" class="form-control" name="image" onchange="onChangeFile(event)" />
                            <div class="mt-3">
                                <img class="img-thumbnail" id="preview-edit" />
                            </div>
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