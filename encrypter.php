<?php

require 'db.php';

$files = glob('/var/www/html/videos/movies/*.mp4'); //scan directory for any .mp4 files
    foreach($files as $file) {
        $name = str_replace('/var/www/html/videos/movies/', '', $file);//file minus path

$result = $mysqli->query("SELECT filename FROM movies WHERE filename = '$name'") or die ($mysqli->error);
            if(mysqli_num_rows($result)>=1) {
                //
            } else {

//$options = ['cost' =>20,];//uncomment if your paranoid
//$paranoid = password_hash($name, PASSWORD_DEFAULT, $options);//uncomment this line as well
$hash = md5($name);//change $name to $paranoid if you uncommented the 2 lines above

$sql = "INSERT INTO movies (filename, hash_name) " 
            . "VALUES  ('$name', '$hash')";
$mysqli->query($sql);

copy($file,$hash);

$gpg = '/usr/bin/gpg';
$recipient = 'ENTER-EMAIL-ADDRESS';
echo shell_exec("$gpg -e -r $recipient $hash");

unlink($hash);
}
}
?>
