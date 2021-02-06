<?php 
header("Content-Type: application/json; charset=UTF-8");

include 'conn.php';

$sql = "SELECT * FROM Note";
$stmt = sqlsrv_query( $conn, $sql );
// echo json_encode(sqlsrv_fetch_object( $stmt));
$i = 1;
while( $row = sqlsrv_fetch_object( $stmt)) { 
    $data[] = [
        'noteId' => $row->NoteId, 
        'note' => $row->Title, 
        'desc' => $row->DescNote,
        'statusCode' => 200, 
        'msg' => 'Success', 
    ];
    // echo json_encode([
        //     'noteId' => $row->NoteId, 
        //     'note' => $row->Title, 
        //     'desc' => $row->DescNote,
        //     'statusCode' => 200, 
        //     'msg' => 'Success', 
        // ]);
}
echo json_encode($data);