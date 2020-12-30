<!-- Edit Modal HTML -->
<div id="update<?php echo $row['transaction_id']; ?>" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="update.php?id=<?php echo $row['transaction_id']; ?>">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Transaction</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>User</label>
                        <input type="text" class="form-control" required name="user_id">
                    </div>
                    <div class="form-group">
                        <label>Item Type</label>
                        <input type="text" class="form-control" required name="item_type">
                    </div>
                    <div class="form-group">
                        <label>Transaction Type</label>
                        <input type="text" class="form-control" required name="transaction_type">
                    </div>
                    <div class="form-group">
                        <label>Datetime</label>
                        <input type="datetime-local" class="form-control" required name="transaction_date">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-secondary" data-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-info" value="Save">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Modal HTML -->
<div id="delete<?php echo $row['transaction_id']; ?>" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Transaction</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete these Records?</p>
                <p class="text-warning"><small>This action cannot be undone.</small></p>
            </div>
            <div class="modal-footer">
                <input type="button" class="btn btn-secondary" data-dismiss="modal" value="Cancel">
                <a href="delete.php?id=<?php echo $row['transaction_id']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete</a>
            </div>
        </div>
    </div>
</div>