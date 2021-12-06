<div class="modal fade" id="modal-change-stock" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <input type="hidden" id="idmenu_change_status"/>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Status Stock</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" onsubmit="changeStatusStock(event)" id="form-change-status">
                        <div class="form-group">
                            <label>Status Stock</label>
                            <select name="status_stock" class="form-control">
                                <option value="">Choose status</option>
                                <option value="1">Ready Stock</option>
                                <option value="0">Out Of Stock</option>
                            </select>
                        </div>
                        <button type="reset" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>