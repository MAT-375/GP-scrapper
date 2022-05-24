<!-- $hello = 'world';

$result = shell_exec('/path/to/python /path/to/your/script.py ' . $hello);
$result = shell_exec('C:\Office\test_environment\get_var.py ' . $hello);


-->

<?php

// $queries = array();
// parse_str($_SERVER['QUERY_STRING'], $queries);

// $arg1 = $_GET['q'];

$indicesServer = array(
'QUERY_STRING');

echo '<table cellpadding="10">' ;
foreach ($indicesServer as $arg) {
    if (isset($_SERVER[$arg])) {
        // echo '<tr><td>'.$arg.'</td><td>' . $_SERVER[$arg] . '</td></tr>' ;
        $arg1 = $_SERVER[$arg] ;
        $command = "python3.6 /home/appswindowspc/public_html/download_scripts/googleplay-api-master/test/down_app.py \"$_SERVER[$arg]\" ";
        // echo $arg1;
        $result = shell_exec($command);
    }
    else {
        echo '<tr><td>'.$arg.'</td><td>-</td></tr>' ;
    }
}
echo '</table>' ;
echo '<br><br><br>.';
echo $result;
?>



<!--// $arg2 = "com.bodunov.galileo";-->
<!--// $command = "python3.8 /home/appsvista/public_html/gpapi/googleplay-api-master/test/down_app.py \"$arg2\" ";-->
<!--// $command = "python3.8 /home/appsvista/public_html/gpapi/googleplay-api-master/test/down_app.py \"$arg1\" ";-->



<!-- 
$(document).ready(function(){
        var app_play_id = '<?php echo $rwDt['app_play_id']; ?>';
        $(document).on('click','#ap-dw',function(){
            var counter = 30;
            var furl = "<?php echo $home_url.'fdown.php' ?>";
            var download_url = '<?php echo $home_url."apks/".$rwDt['app_play_id'].".apk"; ?>';
            $.post(furl,
            {
                app_play_id:app_play_id
            },function(data){
                // console.log(data);
            });
            var url = 'https://play.google.com/store/apps/details?id=<?php echo $rwDt['app_play_id']; ?>';
            var interval = setInterval(function(){
                counter--;
                $('.apC-dw').attr("id","");
                $('.apC-dw').html("Please wait for "+counter+" sec");
                if (counter <= 0) {
                        clearInterval(interval);
                        $.get(download_url)
                        .done(function() { 
                            window.location = download_url;
                        }).fail(function() { 
                            window.location.href = url;
                        })
                        // window.location = download_url;
                        // window.location.href = url;
                    return;
                }
            }, 1000);
        });
    }); -->