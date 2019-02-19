<hr>
    <h4>Contact Details</h4>
<br>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h5>Name : <?php echo $_SESSION['user_name']; ?></h5>
        </div>
        <div class="panel-body">

            <div class="form-group">
                <h5 class="col-md-3">Address </h5>
                <div class="col-md-9">
                    <input class="form-control" type="text" name="address" placeholder="Address" maxlength="200" required>
                </div>

            </div>
            <div class="form-group">
                <h5 class="col-md-3">Email </h5>
                <div class="col-md-6">
                    <input class="form-control" type="email" name="email" value="<?php echo $_SESSION['email'] ?>"  inputmode="email" placeholder="Email" maxlength="80" required>
                </div>

            </div>
            <div class="form-group">
                <h5 class="col-md-3">Telephone Number </h5>
                <div class="col-md-3">
                    <input class="form-control" type="text" name="telephone" minlength="10" placeholder="Telephone Number" pattern="^[0-9]+$" maxlength="15" title="Please Use 0711234567 or 94759546823 Format" required>
                </div>
            </div>
            <input type="hidden" name="new_tp" value="">
        </div>
    </div>

