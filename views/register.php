<!-- registration page -->
<?php
    include_once('header.php');
?>

<form class="well form-horizontal" action="" method="post">
    <fieldset>

        <legend>
            <center>
                <h2><b>Registration Form</b></h2>
            </center>
        </legend><br>

        <input type="hidden" name="csrf_token" value="<?php echo UserController::$csrftoken; ?>">

        <div class="form-group">
            <label class="col-md-4 control-label">First Name</label>
            <div class="col-md-4 inputGroupContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input name="first_name" placeholder="First Name" class="form-control" type="text" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">Last Name</label>
            <div class="col-md-4 inputGroupContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input name="last_name" placeholder="Last Name" class="form-control" type="text" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">Email</label>
            <div class="col-md-4 inputGroupContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                    <input name="email" placeholder="Email" class="form-control" type="email" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">Date Of Birth</label>
            <div class="col-md-4 inputGroupContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                    <input name="dob" placeholder="dd/mm/yy" class="form-control" type="date" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">Password</label>
            <div class="col-md-4 inputGroupContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input name="password" placeholder="Password" class="form-control" type="password" id="password"
                        required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">Confirm Password</label>
            <div class="col-md-4 inputGroupContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input name="confirm_password" placeholder="Confirm Password" class="form-control" type="password"
                        oninput="check(this)" required>
                </div>
                <span id="password-confirmation-message" style="display:none;color:red">
                    Password Must be Matching.
                </span>
            </div>
        </div>

        <?php if(isset($_SESSION['errorMsg']) && $_SESSION['errorMsg']!='' && $_SERVER['REQUEST_METHOD'] == 'POST') { ?>
        <div class="alert alert-danger" role="alert">
            <i class="glyphicon glyphicon-thumbs-up"></i><?php echo $_SESSION['errorMsg']; ?>
        </div>
        <?php } ?>


        <!-- Button -->
        <div class="form-group">
            <label class="col-md-4 control-label"></label>
            <div class="col-md-4"><br>
                <button type="submit" class="btn btn-warning">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspRegister <span
                        class="glyphicon glyphicon-send"></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</button>
                <a class="btn btn-info" href='users'>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspCancel <span
                        class="glyphicon glyphicon-send"></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</a>
            </div>
        </div>
        </div>
    </fieldset>
</form>
</div>

<?php
    include_once('footer.php');
?>