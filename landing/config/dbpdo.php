<?php
include 'dbconnect.php';
$conn = OpenCon();
if ($conn instanceof PDO) {
echo "Connected Successfully using PDO";
} else {
echo "Unexpected connection type.";
}
CloseCon($conn);
?>