<?php 
header("Content-Type: application/json; charset=UTF-8");

include 'conn.php';

$arr = json_decode(file_get_contents("php://input"));

if (!empty($arr)) {
    // echo json_encode($arr);
    // echo $arr->title;

    $title = $arr->title;
    $desc = $arr->desc;
    $tsql = "insert into Note ( Title, DescNote ) values ('$title','$desc' )";
    $stmt = sqlsrv_query( $conn, $tsql );

    if ( $stmt ) {
        echo json_encode([
            'status' => 200, 
            'msg' => 'Data was created.'
        ]);
    } else {
        echo json_encode([
            'status' => 500, 
            'msg' => 'Unable to create data.'
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