<?php
require_once('common.php');
require_once('authenticate.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Agile Board</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<!-- MetisMenu CSS -->
    <link href="css/metisMenu.min.css" rel="stylesheet">


    <!-- DataTables CSS -->
    <link href="plugins/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="plugins/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">

	<!-- jQuery -->
    <script src="js/jquery.min.js"></script>

	<!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Custom Fonts -->
    <!--<link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">-->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<?php

	if(isset($_REQUEST['action'])){
		if($_REQUEST['action']=='update') {
      $stmnt = $db->prepare('UPDATE tasks SET title=:title, status=:status, assignedto=:assignedto, size=:size, description=:description, sprint=:sprint WHERE id=:id;');
			$stmnt->bindParam(':title', $_REQUEST['title'], PDO::PARAM_STR);
			$stmnt->bindParam(':status', $_REQUEST['status'], PDO::PARAM_STR);
			$stmnt->bindParam(':assignedto', $_REQUEST['assignedto'], PDO::PARAM_STR);
			$stmnt->bindParam(':size', $_REQUEST['size'], PDO::PARAM_STR);
			$stmnt->bindParam(':description', $_REQUEST['description'], PDO::PARAM_STR);
			$stmnt->bindParam(':sprint', $_REQUEST['sprint'], PDO::PARAM_STR);
      $stmnt->bindParam(':id', $_REQUEST['id'], PDO::PARAM_STR);
			$stmnt->execute();

      header('Location: '.'item.php?taskid='.$_REQUEST['id']);
      die();
		}
    else if($_REQUEST['action']=='remove') {
      $stmnt = $db->prepare('DELETE FROM tasks WHERE id=:id;');

      $stmnt->bindParam(':id', $_REQUEST['id'], PDO::PARAM_STR);
			$stmnt->execute();

      header('Location: '.'index.php');
      die();
		}



	}

	echo "<script>$('#confirm').modal('show');</script>";




?>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default">
    <div class="container-fluid">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Kanban Board v1.0</a>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="http://quantumwebsystems.com">QWS<span class="sr-only">(current)</span></a></li>
        <li><a href="logout.php">Logout</a></li>
        <!--<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>-->

      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Task Details</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">

                  <form action="item.php?action=update" method="post">
							<?php
								$statement = $db->prepare('SELECT * FROM tasks WHERE id = :taskid;');
								$statement->bindParam(':taskid', $_REQUEST['taskid'], PDO::PARAM_INT);
								$statement->execute();
								$item = $statement->Fetch();
								/*$item = $db->query('SELECT * FROM tasks WHERE taskid = $_REQUEST[taskid];'); */



							?>
              <div class="col-md-1"></div>
              <div class="col-md-6">
									<div class="form-group">
										<label for="title">Title</label>
										<input name="title" type="text" class="form-control" id="title" value="<?php echo $item['title'];  ?>">
									</div>
									<div class="form-group">
										<label for="status">Status</label>
										<input name="status" type="text" class="form-control" id="status" value="<?php echo $item['status'];  ?>">
									</div>
									<div class="form-group">
										<label for="assignedto">Assigned To</label>
										<input name="assignedto" type="text" class="form-control" id="assignedto" value="<?php echo $item['assignedto'];  ?>">
									</div>
									<div class="form-group">
										<label for="size">Size</label>
										<input name="size" type="number" class="form-control" id="size" value="<?php echo $item['size'];  ?>">
									</div>
									<div class="form-group">
										<label for="Description">Description</label>
										<input name="description" type="text" class="form-control" id="Description" value="<?php echo $item['description'];  ?>">
									</div>
									<div class="form-group">
										<label for="Sprint`">Sprint</label>
										<input name="sprint" type="number" class="form-control" id="Sprint" value="<?php echo $item['sprint'];  ?>">
									</div>


									<button type="submit" class="btn btn-success">Submit</button>

								</form>
                <div style="float: right">
                <form action="item.php?action=remove" method="post">
                  <input type="hidden" name="id" value="<?php echo $item['id'];  ?>">
                  <button class="btn btn-danger">Remove</button>
                </form>

              </div>
              </div>

            </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->





    <!-- Metis Menu Plugin JavaScript -->
    <script src="js/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="plugins/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/sb-admin-2.js"></script>
<script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>

    <footer class="footer">
      <div class="footer-container">
        <p>QWS&copy;</p>
      </div>
    </footer>
</body>

</html>
