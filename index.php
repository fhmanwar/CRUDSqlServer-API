<?php 
    session_start(); 
    include 'conn.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
</head>
<body>
    <h1 class="text-center">Test</h1>

    <hr>
    <div class="container">
        <?php 
        if (isset($_SESSION['Conn'])) {
            echo $_SESSION['Conn'];
        } 
        ?>
        <hr>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-outline-success dataToggle" data-toggle="modal" data-target="#AddData" data-placement="bottom" title="Add Data">
            <i class="fas fa-plus"></i>
        </button>
        <!-- Add Modal -->
        <div class="modal fade" id="AddData" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group col-lg-12">
                            <div class="col-lg-12">
                                <font color="brown" style="font-weight:bold;font-size:16px;">Title</font>
                            </div>
                            <div class="col-lg-12">
                                <input class="form-control form-group" type="text" name="title" placeholder="Input Title" />
                            </div>
                        </div>
                        <div class="form-group col-lg-12">
                            <div class="col-lg-12">
                                <font color="brown" style="font-weight:bold;font-size:16px;">Describe</font>
                            </div>
                            <div class="col-lg-12">
                                <Textarea class="form-control form-group" name="desc" placeholder="Input Describe"></Textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-info" name="add" >Save changes</button>
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Modal -->
        <hr>

        <?php 
            if (isset($_SESSION['notif']) ) {
                echo $_SESSION['notif'];
                // remove all session variables
                session_unset();

                // destroy the session
                session_destroy();
            }
            
            if (isset($_POST['add'])) {
                $title = $_POST['title'];
                $desc = $_POST['desc'];
                
                // $tsql = "insert into Note (Who, What, Votes) values ('$who','$what','10')";
                $tsql = "insert into Note ( Title, DescNote ) values ('$title','$desc' )";
                $stmt = sqlsrv_query( $conn, $tsql );

                if ( $stmt ) {    
                    $something = '<p class="alert alert-success">Submission successful.</p>';
                } else {
                    $something = '<p class="alert alert-warning">Submission unsuccessful.</p>';
                    die( print_r( sqlsrv_errors(), true));    
                }

                $_SESSION['notif'] = $something;
                /* Free statement and connection resources. */    
                sqlsrv_free_stmt( $stmt );

                header('Location: index.php');
                // header("Location: index.php");
                // exit;
                // print_r([$title, $desc]);
                // echo 'Title - Desc';
                // echo '<br>';
                // echo $title.' - '.$desc;

                // echo '<br><br>';
                // echo 'ini echo';
                // echo '<br>';
                // printf('ini printf');
            }
        ?>

        <br><br>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Describe</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $sql = "SELECT * FROM Note";
                $stmt = sqlsrv_query( $conn, $sql );
                $i = 1;
                while( $row = sqlsrv_fetch_object( $stmt)) { 
                ?>
                <tr>
                    <!-- <td><?php echo $row->NoteId ?></td> -->
                    <td><?php echo $i ?></td>
                    <td><?php echo $row->NoteId ?></td>
                    <td><?php echo $row->Title ?></td>
                    <td><?php echo $row->DescNote ?></td>
                    <td><?php include 'modal.php'; ?> </td>
                </tr>
                <?php 
                $i++;}
                sqlsrv_close( $conn );
                ?>
            </tbody>
        </table>
    </div> 
    <!-- End Container -->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" integrity="sha512-F5QTlBqZlvuBEs9LQPqc1iZv2UMxcVXezbHzomzS6Df4MZMClge/8+gXrKw2fl5ysdk4rWjR0vKS7NNkfymaBQ==" crossorigin="anonymous"></script>
    <script>
        $(function () {
            // $('[data-toggle="tooltip"]').tooltip()
            $('.dataToggle').tooltip()
        })
    </script>
</body>
</html>

