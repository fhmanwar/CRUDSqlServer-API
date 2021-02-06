<?php
$serverName = "(localdb)\MSSQLLocalDB";
$connectionInfo = ["Database" => "TutorialDb",];

//Establishes the connection
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if($conn) {
    $_SESSION['Conn'] = '<p class="alert alert-success">Connection successful!.</p>';
} else {
    $_SESSION['Conn'] = '<p class="alert alert-success">Not Connected!.</p>';
}

// phpinfo();