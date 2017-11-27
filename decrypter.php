<?php
require 'db.php';

$files = glob('/var/www/html/backup/*.gpg'); //scan directory for any .gpg files
    foreach($files as $file) {
	$name = str_replace('/var/www/html/backup/', '', $file);//file minus path
	$noExt = str_replace('.gpg', '', $name);//file minus ext

$gpg = '/usr/bin/gpg';
    $passphrase = 'YOUR-GPG-EMAIL-PASSPHRASE'; 
    echo shell_exec("echo $passphrase | $gpg --passphrase-fd 0 -o $noExt -d $name");

unlink($file);

$result = $mysqli->query("SELECT * FROM backup WHERE hash_name = '$noExt'") or die ($mysqli->error);

while($row = $result->fetch_assoc()) {
    $rows[] = $row;


$test = $row["filename"];

rename($noExt,$test);
}
}
?>
