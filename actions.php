<!-- Edit Modal HTML -->

<!-- Parse row id to modal element -->
<div id="update<?php echo $row['trans_id']; ?>" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <!-- Parse row id to update.php file -->
            <form method="POST" action="update.php?id=<?php echo $row['trans_id']; ?>">
            
                <!-- Modal Title -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Transaction</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    
                    <!-- User ID Field -->
                    <div class="form-group">
                        <label for="user">User</label>
                        <select id="user" class="form-control" required name="user_id">
                            <option value="1">Jógvan</option>
                            <option value="2">Sveinur</option>
                        </select>
                    </div>
                    
                    <!-- Item Type Field -->
                    <div class="form-group">
                        <label>Item Type</label>
                        <input type="text" class="form-control" required name="item_type" value="<?php echo $row['item_type']; ?>">
                    </div>
                    
                    <!-- Transaction Type Field -->
                    <div class="form-group">
                        <label for="type">Transaction Type</label>
                        <select id="type" class="form-control" required name="transaction_type">
                            <option value="Deposit">Deposit</option>
                            <option value="Withdraw">Withdraw</option>
                        </select>
                    </div>
                    
                    <!-- Datetime Input Field -->
                    <div class="form-group">
                        <label>Datetime</label>
                        <input type="datetime-local" class="form-control" required name="transaction_date">
                    </div>
                </div>
                
                <!-- Cancel and Submit buttons  -->
                <div class="modal-footer">
                    <input type="button" class="btn btn-secondary" data-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-info" value="Save">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Modal HTML -->

<!-- Parse row id to modal element -->
<div id="delete<?php echo $row['trans_id']; ?>" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <!-- Parse row id to delete.php file -->
            <div class="modal-header">
                <h4 class="modal-title">Delete Transaction</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            
            <!-- Delete warning message -->
            <div class="modal-body">
                <p>Are you sure you want to delete these Records?</p>
                <p class="text-warning"><small>This action cannot be undone.</small></p>
            </div>
            
            <!-- Cancel button -->
            <div class="modal-footer">
                <input type="button" class="btn btn-secondary" data-dismiss="modal" value="Cancel">
                
                <!-- Parse row id to delete.php file -->
                <a href="delete.php?id=<?php echo $row['trans_id']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete</a>
            </div>
        </div>
    </div>
</div>
