<!-- user Listing Page -->
<?php
    include_once('header.php');
?>

<div class="row justify-content-md-center custom-header">
    <div class="col-md-6">
        <div class="form-group">
            <h1>Users List</h1>
        </div>
    </div>
    <div class="col-md-6">
        <a href="register" class="btn btn-primary">Register</a>
        <a href="login" class="btn btn-info">Login</a>
    </div>
</div>
<div class="row">
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Email</th>
                <th scope="col">Date of Birth</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                            $userData = UserController::$userList; 
                            if(count($userData) > 0) { 
                            foreach($userData as $user) { ?>
            <tr>
                <th scope="row"><?php echo $user['id'];?></th>
                <td><?php echo $user['first_name'];?></td>
                <td><?php echo $user['last_name'];?></td>
                <td><?php echo $user['email'];?></td>
                <td><?php echo $user['dob'];?></td>
            </tr>
            <?php } }  else { ?>
            <tr>
                <th colspan="5">Nothing to display</th>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php
    include_once('footer.php');
?>