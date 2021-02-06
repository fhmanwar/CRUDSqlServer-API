<?php 
session_start();
include 'conn.php';
if (isset($_POST['update'])) {
	$id = $_POST['noteId'];
    $title = $_POST['title'];
    $desc = $_POST['desc'];
    
    // $tsql = 'insert into Note ( Title, DescNote ) values ('.$title.','.$desc.' )';
    $tsql = 'UPDATE Note SET Title = ? , DescNote = ? WHERE NoteId = ?';
    $stmt = sqlsrv_query( $conn, $tsql, [$title,$desc,$id] );

    if ( $stmt ) {    
        $something = '<p class="alert alert-success">Update successful.</p>';
    } else {
        $something = '<p class="alert alert-warning">Update unsuccessful.</p>';
        die( print_r( sqlsrv_errors(), true));    
    }

    $_SESSION['notif'] = $something;

    /* Free statement and connection resources. */    
    sqlsrv_free_stmt( $stmt );    
    sqlsrv_close( $conn );
    header('Location: index.php');
} elseif (isset($_POST['delete'])) {
    $id = $_POST['noteId'];
    
    $tsql = 'DELETE FROM dbo.Note WHERE NoteId = ?';

    $stmt = sqlsrv_query( $conn, $tsql, [$id] );

    if ( $stmt ) {    
        $something = '<p class="alert alert-success">Delete successful.</p>';
    } else {
        $something = '<p class="alert alert-warning">Delete unsuccessful.</p>';
        die( print_r( sqlsrv_errors(), true));    
    }

    $_SESSION['notif'] = $something;

    /* Free statement and connection resources. */    
    sqlsrv_free_stmt( $stmt );    
    sqlsrv_close( $conn );
    header('Location: index.php');
}

function redirect() {
    $url = 'http://localhost/tes/restApiSqlServer/';
    ob_start();
    header('Location: '.$url);
    ob_end_flush();
    die();
}