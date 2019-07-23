<!-- Login Page -->
<?php
    include_once('header.php');
?>

<form class="well form-horizontal" action="" method="post">
    <fieldset>


        <legend>
            <center>
                <h2><b>Login Form</b></h2>
            </center>
        </legend><br>

        <input type="hidden" name="csrf_token" value="<?php echo UserController::$csrftoken; ?>">

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
            <label class="col-md-4 control-label">Password</label>
            <div class="col-md-4 inputGroupContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input name="password" placeholder="Password" class="form-control" type="password" id="password"
                        required>
                </div>
            </div>
        </div>

        <?php if(isset($_SESSION['errorMsg']) && $_SESSION['errorMsg']!='' && $_SERVER['REQUEST_METHOD'] == 'POST') { ?>
        <div class="alert alert-danger" role="alert">
            <i class="glyphicon glyphicon-thumbs-up"></i><?php echo $_SESSION['errorMsg']; ?>
        </div>
        <?php } ?>

        <?php if(isset($_SESSION['validation']) && $_SESSION['validation']==1 && $_SERVER['REQUEST_METHOD'] == 'POST') { ?>
        <div class="alert alert-danger" role="alert">
            <i class="glyphicon glyphicon-thumbs-up"></i>All fileds are required
        </div>
        <?php } ?>

        <!-- Button -->
        <div class="form-group">
            <label class="col-md-4 control-label"></label>
            <div class="col-md-4"><br>
                <button type="submit" class="btn btn-warning">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspLOGIN <span
                        class="glyphicon glyphicon-send"></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</button>
                <a class="btn btn-info" href='users'>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspCancel <span
                        class="glyphicon glyphicon-send"></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</a>
            </div>
        </div>

    </fieldset>
</form>
</div>

<?php
    include_once('footer.php');
?>