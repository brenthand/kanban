<?php
$dsn = 'mysql:dbname=quantvk2_kanban2;host=localhost;port=3306';
$username = 'quantvk2_kanban';
$password = 'Okmijnuhbygvtfcrdxesz09';

try {
    $db = new PDO($dsn, $username, $password); // also allows an extra parameter of configuration
} catch(PDOException $e) {
      die('Could not connect to the database:<br/>' . $e);
}
