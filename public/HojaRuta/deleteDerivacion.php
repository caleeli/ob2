<?php
$connection = require('connection.php');

if (empty($_REQUEST['id'])) {
} else {
    $stmt = $connection->prepare('delete from derivacion '
        .' where id = ?');

    $stmt->execute([
        $_REQUEST['id']
    ]);
}
echo '[]';
