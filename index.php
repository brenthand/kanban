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
$dsn = 'mysql:dbname=agileboard;host=localhost;port=3306';
$username = 'root';
$password = 'Xyzqwe12';
try {
    $db = new PDO($dsn, $username, $password); // also allows an extra parameter of configuration
	if(isset($_REQUEST['action'])){
		if($_REQUEST['action']=='newtask') {
			$stmnt = $db->prepare('INSERT INTO tasks (title, status, assignedto, size, description, sprint) VALUES( :title, :status, :assignedto, :size, :description, :sprint);');
			$stmnt->bindParam(':title', $_REQUEST['title'], PDO::PARAM_STR);
			$stmnt->bindParam(':status', $_REQUEST['status'], PDO::PARAM_STR);
			$stmnt->bindParam(':assignedto', $_REQUEST['assignedto'], PDO::PARAM_STR);
			$stmnt->bindParam(':size', $_REQUEST['size'], PDO::PARAM_STR);
			$stmnt->bindParam(':description', $_REQUEST['description'], PDO::PARAM_STR);
			$stmnt->bindParam(':sprint', $_REQUEST['sprint'], PDO::PARAM_STR);
			$stmnt->execute();
		}
	}
	echo "<script>$('#confirm').modal('show');</script>";
} catch(PDOException $e) {
    die('Could not connect to the database:<br/>' . $e);
}



?>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="agile-board.html"">Agile Board v0.1</a>
            </div>
            <!-- /.navbar-header -->

            
        </nav>

		<div id="confirm" class="modal fade" role="dialog">
						  <div class="modal-dialog">

							<!-- Modal content-->
							<div class="modal-content">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Success!</h4>
							  </div>
							  <div class="modal-body">
								<h4> Updated task!</h4>
							  </div>
							  <div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							  </div>
							</div>

						  </div>
						</div>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tasks</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#newtask">Add new task <span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
                        </div>
						<!-- New TAsk modal start -->
						<div id="newtask" class="modal fade" role="dialog">
						  <div class="modal-dialog">

							<!-- Modal content-->
							<div class="modal-content">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">New Task</h4>
							  </div>
							  <div class="modal-body">
								<form action="index.php?action=newtask" method="post">
									<div class="form-group">
										<label for="title">Title</label>
										<input name="title" type="text" class="form-control" id="title" placeholder="title...">
									</div>
									<div class="form-group">
										<label for="status">Status</label>
										<input name="status" type="text" class="form-control" id="status" placeholder="Status...">
									</div>
									<div class="form-group">
										<label for="assignedto">Assigned To</label>
										<input name="assignedto" type="text" class="form-control" id="assignedto" placeholder="Name...">
									</div>
									<div class="form-group">
										<label for="size">Size</label>
										<input name="size" type="number" class="form-control" id="size" >
									</div>
									<div class="form-group">
										<label for="Description">Description</label>
										<input name="description" type="text" class="form-control" id="Description" placeholder="Description...">
									</div>
									<div class="form-group">
										<label for="Sprint`">Sprint</label>
										<input name="sprint" type="number" class="form-control" id="Sprint">
									</div>
									<button type="submit" class="btn btn-success">Submit</button>
								</form>
							  </div>
							  <div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							  </div>
							</div>

						  </div>
						</div>

<!-- New task Modal content end -->
						
						
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
											<th>Title</th>
                                            <th>Status</th>
                                            <th>Assigned To</th>
                                            <th>Size</th>
                                            <th>Description</th>
                                            <th>Sprint</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
										
										$tasks = $db->query('SELECT * FROM tasks');
									
										foreach($tasks->FetchAll() as $task) {
											
											echo '<tr class="odd gradeX">';
                                            echo '<td><a href="#">' . $task['title'] . '</a></td>';
                                            echo '<td>' . $task['status'] . '</td>';
                                            echo '<td>' . $task['assignedto'] . '</td>';
                                            echo '<td class="center">' . $task['size'] . '</td>';
											echo '<td>' . $task['description'] . '</td>';
                                            echo '<td class="center">' . $task['sprint'] . '</td>';
											echo '</tr>';
										}
									?>
                                        <tr class="odd gradeX">
                                            <td><a href="#">Issue 1</a></td>
                                            <td>Not Started</td>
                                            <td>tom</td>
                                            <td class="center">4</td>
											<td>Issue with program</td>
                                            <td class="center">2</td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                            
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
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

</body>

</html>
