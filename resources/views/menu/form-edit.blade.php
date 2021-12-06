<div class="col-12 col-md-12 layout-spacing" id="form-edit">
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row align-items-center text-center justify-content-center justify-content-md-between">
                <div class="col-12 col-md-auto">
                    <h4>Edit Menu</h4>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area">
            <div>
                <form method="POST" autocomplete="off" aria-autocomplete="none" id="edit-menu" onsubmit="submitForm(event)">
                    <div class="form-group row">
                        <div class="col form-validation" id="menu-name">
                            <label>Name*</label>
                            <input autocomplete="off" aria-autocomplete="none" type="text" class="form-control" name="name" />
                        </div>
                        <div class="col form-validation" id="menu-status_stock">
                            <label>Status Stock*</label>
                            <select class="form-control" name="status_stock">
                                <option value="">Choose Status Stock</option>
                                <option value="1">Ready stock</option>
                                <option value="0">Out of stock</option>
                            </select>
                        </div>
                        <div class="col form-validation" id="menu-price">
                            <label>Price (IDR)*</label>
                            <input autocomplete="off" aria-autocomplete="none" type="number" class="form-control" name="price">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col form-validation" id="menu-image">
                            <label>Image*</label>
                            <input type="file" class="form-control" name="image" />
                        </div>
                        <div class="col form-validation" id="menu-category_id">
                            <label>Category*</label>
                            <select class="form-control" name="category_id" title="Choose Category">
                                <option value="">Choose Category</option>
                            </select>
                        </div>
                        <div class="col form-validation" id="menu-description">
                            <label>Description*</label>
                            <textarea class="form-control" name="description"></textarea>
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