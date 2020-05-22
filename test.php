<?php
    
    # CALLING CONTROLLER
    include("app/Http/Controllers/AdminController.php");
    
    # CALLING MODEL / QUERY BUILDER
    include("app/Models/Eloquent.php");
    
    $create = new AdminController;
    
    @$adminName =  $_POST['admin_name'];
    @$adminEmail = $_POST['admin_email'];
    @$adminType = $_POST['admin_type'];
    @$adminPassword = sha1($_POST['admin_password']);
    @$adminStatus = $_POST['admin_status'];
    @$createDate = date("Y-m-d H:i:s");
    
    if(isset($_POST['create_admin'])){
        
        $saveAdmin = $create->createAdmin($adminName, $adminEmail, $adminType, $adminPassword, $adminStatus,$createDate);
        
    }
?>
<!--body wrapper start-->
<div class="wrapper">
    <div class="row">
        <div class="col-lg-12">
        
        <!--breadcrumbs start -->
			<ul class="breadcrumb panel">
				<li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
				<li><a href="dashboard.php">Dashboard</a></li>
				<li class="active">Create Admin</li>
			</ul>
			<!--breadcrumbs end -->
            
            <?php
                
                if(isset($_POST['create_admin'])){
                    if($saveAdmin > 0)
                    echo'<div class= "alert alert-success">  The Admin Saved Successfully ! </div>';
                    else
                    echo '<div class= "alert alert-danger">  Something Wrong Please Rechecck! </div>';
                }
                
            ?>
            <section class="panel">
                <header class="panel-heading">
                    New Admin Registration Form
                </header>
                <div class="panel-body">
                    <div class="form">
                        
                        <form class="cmxform form-horizontal adminex-form" id="signupForm" method="post" action="">
                            
                            <div class="form-group ">
                                <label for="firstname" class="control-label col-lg-2">Admin Name</label>
                                <div class="col-lg-10">
                                    <input class=" form-control" id="firstname" name="admin_name" type="text" required />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="email" class="control-label col-lg-2">Admin Email</label>
                                <div class="col-lg-10">
                                    <input class="form-control " id="email" name="admin_email" type="email" required />
                                </div>
                            </div>
                            
                             <div class="form-group ">
                                <label for="admin_status" class="control-label col-lg-2">Admin Type</label>
                                <div class="col-lg-10">
                                    <select name="admin_type" class="form-control m-bot15">
                                        <option> Select Admin Type </option>
                                        <option value="Root Admin"> Root Admin </option>
                                        <option value="Technical Operator"> Technical Operator </option>
                                        <option value="Content Manager"> Content Manager </option>
                                        <option value="Sales Manager"> Sales Manager </option>
                                    </select>
                                    
                                </div>
                            </div>
                           
                            <div class="form-group ">
                                <label for="password" class="control-label col-lg-2">Admin Password</label>
                                <div class="col-lg-10">
                                    <input class="form-control " id="password" name="admin_password" type="password" required />
                                </div>
                            </div>
                            
                            <div class="form-group ">
                                <label for="admin_status" class="control-label col-lg-2">Admin Status</label>
                                <div class="col-lg-10">
                                    <select name="admin_status" class="form-control m-bot15">
                                        <option value="active"> Active </option>
                                        <option value="inactive"> Inactive </option>
                                    </select>
                                    
                                </div>
                            </div>
                           
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button name="create_admin" class="btn btn-success" type="submit">Save</button>
                                <button name="reset"class="btn btn-primary" type="reset">Reset</a></button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
</div>
<!--body wrapper end-->