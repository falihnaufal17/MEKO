<div class="modal fade" id="modal-form-reject" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <input type="hidden" id="idmenu-to-reject"/>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reason Reject Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" onsubmit="reject(event)" id="form-reject">
                    <div class="form-group">
                       <label>Reason</label>
                       <textarea class="form-control" name="reason" placeholder="Why you reject this menu?" required></textarea>
                    </div>
                    <button type="reset" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Reject</button>
                </form>
            </div>
        </div>
    </div>
</div>