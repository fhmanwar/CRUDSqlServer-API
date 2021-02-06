<?php 
header("Content-Type: application/json; charset=UTF-8");

include 'conn.php';

$arr = json_decode(file_get_contents("php://input"));

if (!empty($arr)) {
    
    $tsql = 'DELETE FROM dbo.Note WHERE NoteId = ?';
    $stmt = sqlsrv_query( $conn, $tsql, [$arr->noteId] );

    if ( $stmt ) {
        echo json_encode([
            'status' => 200, 
            'msg' => 'Data was Deleted.'
        ]);
    } else {
        echo json_encode([
            'status' => 500, 
            'msg' => 'Unable to Delete data.'
        ]);
    }

    /* Free statement and connection resources. */    
    sqlsrv_free_stmt( $stmt );    
    sqlsrv_close( $conn );
} else {
    echo json_encode([
        'status' => 400, 
        'msg' => 'Error.'
    ]);
}