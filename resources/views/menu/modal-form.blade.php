<div class="md-modal md-effect-3" id="form">
    <div class="md-content">
        <h3 class="pt-4" id="title-modal">Add New Menu</h3>
        <div>
            <form method="POST" onsubmit="submitForm(event)">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Type name of menu" />
                </div>
                <div class="form-group">
                    <label>Stock</label>
                    <input type="number" class="form-control" name="stock" placeholder="Add stock of menu" />
                </div>
                <div class="form-group">
                    <label>Image</label>
                    <input type="file" class="form-control" name="image" />
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <select class="form-control" name="category_id" title="Choose Category">
                        <option>Choose Category</option>
                        <option>Mustard</option>
                        <option>Ketchup</option>
                        <option>Relish</option>
                    </select>
                </div>
                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-button-4 btn-rounded mb-3">Submit</button>
                    </div>
                    <div class="col">
                        <button type="reset" class="btn btn-button-5 btn-rounded md-close mb-3">Cancel</button>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
</div>