<?php

	error_reporting( E_NOTICE );
	
	require_once 'dbconfig.php';
	
	if(isset($_GET['edit_id']) && !empty($_GET['edit_id']))
	{
		$id = $_GET['edit_id'];
		$stmt_edit = $DB_con->prepare('SELECT title, description, picture FROM tbl_banners WHERE ID =:uid');
		$stmt_edit->execute(array(':uid'=>$id));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);
	}
	else
	{
		header("Location: index.php");
	}
	
	
	
	if(isset($_POST['btn_save_updates']))
	{
		$title = $_POST['banner_title'];
		$description = $_POST['banner_description'];
			
		$imgFile = $_FILES['user_image']['name'];
		$tmp_dir = $_FILES['user_image']['tmp_name'];
		$imgSize = $_FILES['user_image']['size'];
					
		if($imgFile)
		{
			$upload_dir = $UPLOAD_DIR; // upload directory	
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION));
			$valid_extensions = array('tif', 'jpg', 'psd', 'ai');
			$picture = rand(1000,1000000).".".$imgExt;
			if(in_array($imgExt, $valid_extensions))
			{			
				if($imgSize < 5000000)
				{
					unlink($upload_dir.$edit_row['picture']);
					move_uploaded_file($tmp_dir,$upload_dir.$picture);
				}
				else
				{
					$errMSG = "Sorry, your file is too large it should be less then 5MB";
				}
			}
			else
			{
				$errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";		
			}	
		}
		else
		{
			// if no image selected the old image remain as it is.
			$picture = $edit_row['picture'];
		}	
						
		
		// if no error occured, continue ....
		if(!isset($errMSG))
		{
			$stmt = $DB_con->prepare('UPDATE tbl_banners 
									     SET title=:title, 
										     description=:description, 
										     picture=:picture 
								       WHERE ID=:uid');
			$stmt->bindParam(':title',$title);
			$stmt->bindParam(':description',$description);
			$stmt->bindParam(':picture',$picture);
			$stmt->bindParam(':uid',$id);
				
			if($stmt->execute()){
				?>
                <script>
				alert('Successfully Updated ...');
				window.location.href='index.php';
				</script>
                <?php
			}
			else{
				$errMSG = "Sorry Data Could Not Updated !";
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

<!-- custom stylesheet -->
<link rel="stylesheet" href="style.css">

<!-- Latest compiled and minified JavaScript -->
<script src="bootstrap/js/bootstrap.min.js"></script>

<script src="jquery-1.11.3-jquery.min.js"></script>
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
    	<h1 class="h2">update profile. <a class="btn btn-default" href="index.php"> all Banners </a></h1>
    </div>

<div class="clearfix"></div>

<form method="post" enctype="multipart/form-data" class="form-horizontal">
	
    
    <?php
	if(isset($errMSG)){
		?>
        <div class="alert alert-danger">
          <span class="glyphicon glyphicon-info-sign"></span> &nbsp; <?php echo $errMSG; ?>
        </div>
        <?php
	}
	?>
   
    
	<table class="table table-bordered table-responsive">
	
    <tr>
    	<td><label class="control-label">Banner name(title) :</label></td>
        <td><input class="form-control" type="text" name="banner_title" value="<?php echo $title; ?>" required /></td>
    </tr>
    
    <tr>
    	<td><label class="control-label">Banner description :</label></td>
        <td><input class="form-control" type="text" name="banner_description" value="<?php echo $description; ?>" required /></td>
    </tr>
    
    <tr>
    	<td><label class="control-label">Image of banner :</label></td>
        <td>
        	<p><img src="user_images/<?php echo $picture; ?>" height="150" width="150" /></p>
        	<input class="input-group" type="file" name="user_image" accept="image/*" />
        </td>
    </tr>
    
    <tr>
        <td colspan="2"><button type="submit" name="btn_save_updates" class="btn btn-default">
        <span class="glyphicon glyphicon-save"></span> Update
        </button>
        
        <a class="btn btn-default" href="index.php"> <span class="glyphicon glyphicon-backward"></span> cancel </a>
        
        </td>
    </tr>
    
    </table>
    
</form>


<div class="alert alert-info">
     <strong>Demo application !</strong>
</div>

</div>
</body>
</html>
