<?php 
header("Content-Type: application/json; charset=UTF-8");

include 'conn.php';

$arr = json_decode(file_get_contents("php://input"));

if (!empty($arr)) {
    echo json_encode($arr);
} else {
    $sql = "SELECT * FROM Note";
    $stmt = sqlsrv_query( $conn, $sql );
    $i = 1;
    while( $row = sqlsrv_fetch_object( $stmt)) { 
        response($row->NoteId, $row->Title, $row->DescNote, 200, 'Success');
    }
}

// $id = $_POST['noteId'];
// $title = $_POST['title'];
// $desc = $_POST['desc'];

// if (isset($_POST['add'])) {
//     $tsql = "insert into Note ( Title, DescNote ) values ('$title','$desc' )";
//     $stmt = sqlsrv_query( $conn, $tsql );

//     if ( $stmt ) {
//         echo json_encode([
//             'status' => 'success', 
//             'msg' => 'Data was created.'
//         ]);
//     } else {
//         echo json_encode([
//             'status' => 'success', 
//             'msg' => 'Unable to create data.'
//         ]);
//     }

//     /* Free statement and connection resources. */    
//     sqlsrv_free_stmt( $stmt );
//     sqlsrv_close( $conn );
// } else if (isset($_POST['update'])) {
//     $tsql = 'UPDATE Note SET Title = ? , DescNote = ? WHERE NoteId = ?';
//     $stmt = sqlsrv_query( $conn, $tsql, [$title,$desc,$id] );

//     if ( $stmt ) {
//         echo json_encode([
//             'status' => 'success', 
//             'msg' => 'Data was Updated.'
//         ]);
//     } else {
//         echo json_encode([
//             'status' => 'success', 
//             'msg' => 'Unable to Update data.'
//         ]);
//     }

//     /* Free statement and connection resources. */    
//     sqlsrv_free_stmt( $stmt );    
//     sqlsrv_close( $conn );
// } elseif (isset($_POST['delete'])) {
//     $tsql = 'DELETE FROM dbo.Note WHERE NoteId = ?';
//     $stmt = sqlsrv_query( $conn, $tsql, [$id] );

//     if ( $stmt ) {
//         echo json_encode([
//             'status' => 'success', 
//             'msg' => 'Data was Deleted.'
//         ]);
//     } else {
//         echo json_encode([
//             'status' => 'success', 
//             'msg' => 'Unable to Delete data.'
//         ]);
//     }

//     /* Free statement and connection resources. */    
//     sqlsrv_free_stmt( $stmt );    
//     sqlsrv_close( $conn );
// } else {
//     $sql = "SELECT * FROM Note";
//     $stmt = sqlsrv_query( $conn, $sql );
//     $i = 1;
//     while( $row = sqlsrv_fetch_object( $stmt)) { 
//         response($row->NoteId, $row->Title, $row->DescNote, 200, 'Success');
//     }
// }

function response($Id, $note, $desc, $code, $msg) {
    echo json_encode([
        'noteId' => $Id, 
        'note' => $note, 
        'desc' => $desc,
        'statusCode' => $code, 
        'msg' => $msg, 
    ]);
}