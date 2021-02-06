<?php 
header("Content-Type: application/json; charset=UTF-8");

include 'conn.php';

$arr = json_decode(file_get_contents("php://input"));

if (!empty($arr)) {

    $tsql = 'UPDATE Note SET Title = ? , DescNote = ? WHERE NoteId = ?';
    $stmt = sqlsrv_query( $conn, $tsql, [$arr->title, $arr->desc, $arr->noteId] );

    if ( $stmt ) {
        echo json_encode([
            'status' => 200, 
            'msg' => 'Data was Updated.'
        ]);
    } else {
        echo json_encode([
            'status' => 500, 
            'msg' => 'Unable to Update data.'
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