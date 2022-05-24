<?php
if(isset($_POST['app_play_id'])){
    $play_id = $_POST['app_play_id'];
    $command = "python3.6 /home/appswindowspc/public_html/download_scripts/googleplay-api-master/test/down_app.py \"$play_id\" ";
    $result = exec($command,$output,$status);
    echo "status is : ".$status;
}
?>