<?php

	error_reporting( E_NOTICE ); 
	
	require_once 'dbconfig.php';
	
	if(isset($_POST['btnsave']))
	{
		$title = $_POST['banner_title'];
		$description = $_POST['banner_description'];
		
		$imgFile = $_FILES['banner_image']['name'];
		$tmp_dir = $_FILES['banner_image']['tmp_name'];
		$imgSize = $_FILES['banner_image']['size'];
		
		if(empty($title)){
			$errMSG = "Please Enter banner title.";
		}
		else if(empty($description)){
			$errMSG = "Please Enter description of banner.";
		}
		else if(empty($imgFile)){
			$errMSG = "Please Select Image File.";
		}
		else
		{
			$upload_dir = $UPLOAD_DIR;
	
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); 
		
			// valid image extensions
			$valid_extensions = array('tif', 'jpg', 'psd', 'ai');
			// rename uploading image
			$picture = rand(1000,1000000).".".$imgExt;
			// allow valid image file formats
			if(in_array($imgExt, $valid_extensions)){			
				// Check file size '5MB'
				if($imgSize < 5000000){
					move_uploaded_file($tmp_dir,$upload_dir.$picture);
				}
				else{
					$errMSG = "Sorry, your file is too large.";
				}
			}
			else{
				$errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";		
			}
		}
		
		// if no error occured, continue ....
		if(!isset($errMSG))
		{
			$stmt = $DB_con->prepare('INSERT INTO tbl_banners(title,description,picture) VALUES(:title, :description, :picture)');
			$stmt->bindParam(':title',$title);
			$stmt->bindParam(':description',$description);
			$stmt->bindParam(':picture',$picture);
			
			if($stmt->execute())
			{
				$successMSG = "new record succesfully inserted ...";
				header("refresh:5;index.php"); // redirects image view page after 5 seconds.
			}
			else
			{
				$errMSG = "error while inserting....";
			}
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Demo application - Vuk Vukasinovic</title>

<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">

</head>
<body>

<div class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container">
 
        <div class="navbar-header">
			<a class="navbar-brand" href="http://jquery.com/">jQuery</a>
            <a class="navbar-brand" href="http://www.wordpress.org" title='Wordpress blogging'>Wordpress Blog</a>
            <a class="navbar-brand" href="https://www.youtube.com/">Youtube</a>
            <a class="navbar-brand" href="https://www.instagram.com/">Instagram</a>
        </div>
 
    </div>
</div>

<div class="container">


	<div class="page-header">
    	<h1 class="h2">add new banner. <a class="btn btn-default" href="index.php"> <span class="glyphicon glyphicon-eye-open"></span> &nbsp; view all </a></h1>
    </div>
    

	<?php
	if(isset($errMSG)){
			?>
            <div class="alert alert-danger">
            	<span class="glyphicon glyphicon-info-sign"></span> <strong><?php echo $errMSG; ?></strong>
            </div>
            <?php
	}
	else if(isset($successMSG)){
		?>
        <div class="alert alert-success">
              <strong><span class="glyphicon glyphicon-info-sign"></span> <?php echo $successMSG; ?></strong>
        </div>
        <?php
	}
	?>   

<form method="post" enctype="multipart/form-data" class="form-horizontal">
	    
	<table class="table table-bordered table-responsive">
	
    <tr>
    	<td><label class="control-label">Banners name(title) :</label></td>
        <td><input class="form-control" type="text" name="banner_title" placeholder="Enter title of banner" value="<?php echo $title; ?>" /></td>
    </tr>
    
    <tr>
    	<td><label class="control-label">Banners description :</label></td>
        <td><input class="form-control" type="text" name="banner_description" placeholder="Your banner description" value="<?php echo $description; ?>" /></td>
    </tr>
    
    <tr>
    	<td><label class="control-label">Image of banner :</label></td>
        <td><input class="input-group" type="file" name="banner_image" accept="image/*" /></td>
    </tr>
    
    <tr>
        <td colspan="2"><button type="submit" name="btnsave" class="btn btn-default">
        <span class="glyphicon glyphicon-save"></span> &nbsp; save
        </button>
        </td>
    </tr>
    
    </table>
    
</form>



<div class="alert alert-info">
    <strong>Demo application !</strong>
</div>

    

</div>



	


<!-- Latest compiled and minified JavaScript -->
<script src="bootstrap/js/bootstrap.min.js"></script>


</body>
</html>
