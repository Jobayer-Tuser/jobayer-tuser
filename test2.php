<?php
//Calling Controller
include("app/Http/Controllers/Controller.php");

//Calling Model or Query Builder
include("app/Models/Eloquent.php");

$control = new Controller;
$eloquent = new Eloquent;

# Load Category List
$columnName = "*";
$tableName = "categories";
$categoryList = $eloquent->selectData($columnName, $tableName);

//Create Products
if(isset($_POST['create_product']))
{
	$filename = "PRODUCT_" . date("YmdHis") . "_" . $_FILES['product_master_image']['name'];

	$imageResult = $control->checkImage(
        $_FILES['product_master_image']['type'], 
		$_FILES['product_master_image']['size'], 
		$_FILES['product_master_image']['error']
	);
	
	
	if($imageResult == 1)
	{
        $tableName = $columnValue = null;
        
		$tableName = "products";
		$columnValue["category_id"] = $_POST['category_id'];
		$columnValue["subcategory_id"] = $_POST['subcategory_id'];
		$columnValue["product_name"] = $_POST['product_name'];
		$columnValue["product_price"] = $_POST['product_price'];
		$columnValue["product_quantity"] = $_POST['product_quantity'];
		$columnValue["product_summary"] = $_POST['product_summary'];
		$columnValue["product_details"] = $_POST['product_details'];
		$columnValue["tags"] = $_POST['product_tag'];
		$columnValue["product_status"] = $_POST['product_status'];
		$columnValue["product_master_image"] = $filename;
		$columnValue["created_at"] = date("Y-m-d H:i:s");
        
		$productResult = $eloquent->insertData($tableName, $columnValue);
		
		if($productResult > 0)
			move_uploaded_file($_FILES['product_master_image']['tmp_name'], $GLOBALS['PRODUCT_DIRECTORY'] . $filename);	
	}
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
				<li class="active">Create Product</li>
			</ul>
			<!--breadcrumbs end -->

			<section class="panel">
				<header class="panel-heading">
					CREATE PRODUCTS
				</header>
				<div class="panel-body">

					<?php 
					if(isset($_POST['create_product'])) 
					{
						if(@$productResult > 0)
							echo "<div class='alert alert-success'>New Product is created successfully!</div>";
						else
							echo "<div class='alert alert-danger'>Something went wrong while adding the Product! Please recheck.</div>";
					}
					?>
					

					<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
						<div class="form-group ">
							<label for="ProductStatus" class="control-label col-lg-2">Category</label>
							<div class="col-lg-8">
									<select name="category_id" id="category_id" class="form-control m-bot15">
										<option value="">Select a Category</option> 
										<?php
										foreach($categoryList AS $eachRow)
										{
											echo '<option value="'.$eachRow['id'].'">' . $eachRow['category_name'] . '</option>';
										}
										?>
									</select>
							</div>
							</div>
						<div class="form-group ">
							<label for="ProductStatus" class="control-label col-lg-2">Subcategory</label>
							<div class="col-lg-8">	
									<select name="subcategory_id" id="subcategory_id" class="form-control m-bot15">
										<option value="">Select a Subcategory</option>
									</select>
								
							</div>
						</div>
						<div class="form-group">
							<label for="ProductName" class="col-lg-2 col-sm-10 control-label">Product Name</label>
							<div class="col-lg-8">
								<input type="text" name="product_name" class="form-control" id="product_name">
							</div>
						</div>
						<div class="form-group">
							<label for="ProductQuantity" class="col-lg-2 col-sm-10 control-label">Product Quantity</label>
							<div class="col-lg-8">
								<input type="number" name="product_quantity" class="form-control" id="product_quantity">
							</div>
						</div>								
						<div class="form-group">
							<label for="ProductPrice" class="col-lg-2 col-sm-2 control-label">Product Price</label>
							<div class="col-lg-8">
								<input type="number" name="product_price" class="form-control" id="product_price">
							</div>
						</div>
														
						<div class="form-group">
                            <label for="Productsummery" class="col-lg-2 col-sm-2 control-label">Product Summary</label>
                            <div class="col-lg-10">
                                <div class="form-group">
                                    <div class="col-md-10">
                                        <textarea name="product_summary" id="summerOne" rows="10"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>	
							
                        <div class="form-group">
                            <label for="ProductDetails" class="col-lg-2 col-sm-2 control-label">Product Details</label>
                            <div class="col-lg-10">
                            	<div class="form-group">
                               		<div class="col-md-10">
                                        <textarea name="product_details" id="summerTwo" rows="10"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
						
                        <div class="form-group">
							<label for="ProductName" class="col-lg-2 col-sm-10 control-label">Product Tags</label>
                            <div class="col-lg-8">
                              <input type="text" name="product_tag" id="tag-input"/>
                            </div>
                        </div>
						<div class="form-group ">
							<label for="ProductStatus" class="control-label col-lg-2">Product Status</label>
							<div class="col-lg-8">
								<div class="btn-group col-lg-8">
									<select name="product_status" class="form-control m-bot15">
										<option value="In Stock">In Stock</option>
										<option value="Out Of Stock">Out Of Stock</option>
									</select>
								</div>
							</div>
						</div>
						<div class="form-group">
                            <label for="inputimage" class="col-lg-2 col-sm-2 control-label">Product Image</label>
                            <div class="col-lg-6">
                                <div name="" class="fileupload fileupload-new" data-provides="fileupload" required />
                                    <div name="" class="fileupload-new thumbnail" style="width: 300px; height: auto;" required />
                                        <img src="public/images/noimage.jpg" alt="" />
                            </div>
                            <div class="fileupload-preview fileupload-exists thumbnail" style="width: 300px; height: auto; line-height: 20px;"></div>
                            <div>
                                <span class="btn btn-default btn-file">
                                    <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                    <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                    <input name="product_master_image" type="file" class="default" required />
                                 </span>
                                 <a href="" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                            </div>
                        </div>
						<br/>
						<div class="form-group">
								<div class="col-lg-8">
									<button name="create_product" class="btn btn-success" type="submit">Save</button>
									<button name="name" class="btn btn-primary" type="reset">Reset</button>
								</div>
						</div>
			
					</form>
				</div>
			</section>
		</div>
	</div>
</div>
<!--body wrapper end-->

<!-- ---------- AJAX CODE TO LOAD SUBCATEGORY AGAINST CATEGORY ---------- -->
<script src="public/js/jquery-1.10.2.min.js"></script>
<script>
    $(document).ready(function(){
        $("#category_id").change(function() {
			
            var cat_id = $(this).val();
			
            if(cat_id != "")
			{
                $.ajax({
                    url:"ajax.php",
                    data:{
						ajax_create_product: "YES",
						category_id:cat_id
					},
                    type:'POST',
                    success:function(response) 
					{
                        var resp = $.trim(response);
                        $("#subcategory_id").html(resp);

                        if(resp == "")
                            $("#subcategory_id").html("<option value=''>No Subcategory Found</option>");
                    }
                });
            }
            else 
			{
                $("#subcategory_id").html("<option value=''>Select a Subcategory</option>");
            }
        })
    });
</script>