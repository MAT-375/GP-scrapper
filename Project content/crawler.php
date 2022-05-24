<?php
global $wpdb;
use \Statickidz\GoogleTranslate;
require_once ('../vendor/autoload.php');
require_once("../wp-load.php");
// include("../wp-admin/includes/file.php");
//     include("../wp-admin/includes/media.php");
    include("../wp-admin/includes/image.php");
require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
include 'simple_html_dom.php';
$i=1;
set_time_limit(300);
$row_data = $wpdb->get_results("SELECT * FROM wp_crawl WHERE status='0'  LIMIT 3 ");
if(!$row_data) {
    echo 'Crawler is Hungry, Feed me Links !!!';
}
else{
    foreach($row_data as $row_sub11){
    $url = $row_sub11->url;
    $id = $row_sub11->id;
    // $url = str_replace("http","https",$url);
    // var_dump($url);
    echo $id;
    echo '<br>';
        $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  //curl_setopt($ch,CURLOPT_FOLLOWLOCATION,true);
  $data = curl_exec ($ch);
  curl_close ($ch);

  $html = new simple_html_dom();
  $html->load($data);

  if($html){
         $title_dom1 = $html->find('h1#detail-app-name', 0);
      $title_dom1=trim($title_dom1->plaintext);
        // var_dump($title_dom1);
        echo $title_dom1;
    if(!empty($title_dom1)){
       echo "find ";
           echo '<br>';
            $gadget=OpenURL($url,$wpdb,$id,$i);
    if($i=='6'){
        $i=1;
    }
    
    
         }
         else{
          echo "not find ";
           $update=$wpdb->update('wp_crawl', array('status_post'=>'1','status'=>'5'), array('id'=>$id));
      if($update){
        echo "updated ";
        echo "<br>";
    }
         }
       }
  sleep(5);
  $i++;
    }
}
function OpenURL($url,$wpdb,$id,$i){
    echo $id;
    $post_title_name=$title_dom1=$img=$dev_name=$version=$category_name=$image1=$rating=$total_ratings=$last_updated=$size=$Installs=$Current_Version=$Req_Android="";
        $g_id=$content="";
    $br_id=$id;
    $url=$url;
    $category=4;
    $i=$i;
    $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	//curl_setopt($ch,CURLOPT_FOLLOWLOCATION,true);
	$data = curl_exec ($ch);
	curl_close ($ch);

	$html = new simple_html_dom();
	$html->load($data);

	if($html){
         $title_dom1 = $html->find('h1#detail-app-name', 0);
	    $title_dom1=trim($title_dom1->plaintext);
        // var_dump($title_dom1);
        echo $title_dom1;
	 echo "find ";
           echo '<br>';
	$description = $html->find('div.text-description', 0);
    $description=trim($description->plaintext);
      $content = str_replace("Publicidad       ", "", $description); 
      // $content = str_replace("Advertisement", "", $content);
      $source = 'es';
          $target = 'en';
          $trans = new GoogleTranslate();
          if(!empty($content)){
              $content = $trans->translate($source, $target, $content);
          }
      
      // var_dump($content);
      
       
      
       $g_id_error=false;
       $g_id_0=$html->find('div.full div', 0);
       $g_id_0=trim($g_id_0->plaintext);
       if( $g_id_0=="Nombre de paquete" || $g_id_0=="Package Name"){
      $g_id = $html->find('div.full div', 1);
      $g_id=trim($g_id->plaintext);
      }
      else{
          $g_id_error=true;
          $g_id= "";
      }
      // var_dump($g_id);
     

		$g_url = "https://play.google.com/store/apps/details?id=".$g_id;

		$chr = curl_init();
		curl_setopt($chr, CURLOPT_URL, $g_url);
		curl_setopt ($chr, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($chr, CURLOPT_FOLLOWLOCATION, 0);
		curl_setopt($chr, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($chr, CURLOPT_SSL_VERIFYPEER, 0);
		//curl_setopt($ch,CURLOPT_FOLLOWLOCATION,true);
		$p_data = curl_exec ($chr);
		curl_close ($chr);


		$play_html = new simple_html_dom();
		$play_html->load($p_data);

		//echo $play_html;


		$typ_error='';
        foreach($play_html->find('div[id=error-section]') as $error)
        {
       
           $typ_error = $error->plaintext;
        }

           

		if($typ_error == "We're sorry, the requested URL was not found on this server." || $g_id_error==true){  //=====  fetch Data from UPTODOWN
            echo 'UPTODOWN';
            echo '<br>';
            echo $g_id;
            echo '<br>';
            echo $g_id_error;
              $ch=0;
          $dow=0;
          $new_string="";
          $last_updat = $html->find('.content', 2);
      $last_updat = trim($last_updat->plaintext);
          $words = explode(" ", $last_updat);
              foreach ($words as $w) {
                  if($dow==1){
                      $Installs.=$w;
                  }
                  if($ch==1){
                      $last_updated.=$w." ";
                  }
                  
                  if($w=="Downloads" || $w=="Descargas"){
                      $dow++;
                  }
                  if($w=="Date" || $w=="Fecha"){
                      $ch++;
                      $dow++;
                  }
              }
              $source = 'es';
              $target = 'en';
              $trans = new GoogleTranslate();
                  $last_updated = $trans->translate($source, $target, $last_updated);
              echo $last_updated;
              echo '<br>';
              $Installs = str_replace("Date", "", $Installs);
              $Installs = str_replace("Fecha", "", $Installs);                
              $Installs=trim($Installs);
              echo $Installs;
              $last_updated=trim($last_updated);
              echo '<br>';
                $version = $html->find('.version', 0);
		    $Current_Version = trim($version->plaintext);
            // var_dump("version is: ".$version); 
			$image1 = $html->find('div.icon img', 0);
			$image1 = trim($image1->src);
            // var_dump($img);
            

			$dev_name = $html->find('div.autor', 0);
		    $dev_name = trim($dev_name->plaintext);
            // var_dump("autor is: ".$dev_name);
           
			$rating = $html->find('div.score', 0);
	    $rating=trim($rating->plaintext);
        $rating=substr($rating, 0, strrpos($rating, ' '));

        $total_ratings = $html->find('span[id=more-comments-rate-section] ', 0);
	    	$total_ratings=trim($total_ratings->plaintext);
            $total_ratings=substr($total_ratings, 0, strrpos($total_ratings, ' '));

			$category_name = $html->find('.breadcrumb a span', 2);
            $category_name = trim($category_name->plaintext);
            if($category_name=="PLATAFORMA" || $category_name=="JUEGOS DE CARTAS" || $category_name=="GUÍAS" || $category_name=="ACCIÓN Y AVENTURAS" || $category_name=="NIÑOS" || $category_name=="CASUAL" || $category_name=="ROL" || $category_name=="ARCADE" || $category_name=="ESTRATEGIA" || $category_name=="DEPORTES" || $category_name=="OTROS" || $category_name=="EMULADORES" || $category_name=="ESTRATEGIA" || $category_name=="PUZZLE" ){
                if($i=='1'){
                    $post_title_name="How to play $title_dom1 on PC (Windows/Mac)";
                }
                elseif($i=='2'){
                    $post_title_name="$title_dom1 Review & How To Get For Mobile & PC";
                }
                elseif($i=='3'){
                    $post_title_name="$title_dom1 for PC – Windows 7, 8, 10 – Free Download";
                }
                elseif($i=='4'){
                    $post_title_name="Download, Install & play $title_dom1 NAME on PC (Windows & Mac)";
                }
                elseif($i=='5'){
                    $post_title_name="$title_dom1  For PC (Windows 10, 8, 7)";
                }
                else {
                    $post_title_name="$title_dom1  On Your PC (Windows And Mac)";
                    $i=1;
                }
            }
            else{
               
                if($i=='1'){
                    $post_title_name="How to use  $title_dom1 on PC (Windows/Mac)";
                }
                elseif($i=='2'){
                    $post_title_name="$title_dom1 Review & How To Get For Mobile & PC";
                }
                elseif($i=='3'){
                    $post_title_name="$title_dom1 for PC – Windows 7, 8, 10 – Free Download";
                }
                elseif($i=='4'){
                    $post_title_name="Download, Install & Use $title_dom1 on PC (Windows & Mac)";
                }
                elseif($i=='5'){
                    $post_title_name="$title_dom1  For PC (Windows 10, 8, 7)";
                }
                else {
                    $post_title_name="$title_dom1  On Your PC (Windows And Mac)";
                    $i=1;
                }
            }
            // var_dump("Category is: ".$category_name);
          if($content==""){

                $content="Download $title_dom1 for PC/Mac/Windows 7,8,10 and have the fun experience of using the smartphone Apps on Desktop or personal computers.
                New and rising App, <b><em>$title_dom1</em></b> developed by <b><em>$dev_name</em></b> for Android is available for free in the Play Store. <em>$title_dom1</em> has the latest version of $Current_Version. Before we move toward the installation guide of <em>$title_dom1 on PC</em> using Emulators, you can go on official Play store to see what they are offering, You can read the Complete Features and Description of the App there.";
             }

			
$content_final = "<p style='text-align: justify;'><img src='$image1' class='alignright' alt='$title_dom1' width='100' height='100' /></p>
			$content<br>";
					///                
	        $args = array( 'posts_per_page' => 1, 'orderby' => 'rand' );
	        $rand_posts = get_posts( $args );
	        foreach ( $rand_posts as $post ) : 
	        setup_postdata( $post );?>
	        <?php $id = $post->id ?>
	        <?php $content_final .="See more: <strong><a href='".post_permalink($id)."'>".$post->post_title." </a></strong></b>.<br>"; ?>
	        <?php endforeach;
	        wp_reset_postdata();
	        
	        $content_final.="
<h3>$title_dom1 Details</h3>
<table>
<tbody>";
if(!empty($title_dom1)){
    $content_final.="<tr>
    <td>Name:</td>
    <td>$title_dom1</td>
    </tr>";
}
if(!empty($dev_name)){
    $content_final.="<tr>
    <td>Developers:</td>
    <td>$dev_name</td>
    </tr>";
}
if(!empty($Current_Version)){
    $content_final.="<tr>
    <td>Current Version:</td>
    <td>$Current_Version</td>
    </tr>";
}
if(!empty($g_id)){
    $content_final.="<tr>
    <td>Google Play-URL:</td>
    <td><a href='$g_url' target='_blank' rel='nofollow noopener noreferrer'><img class='align-center wp-image-62' src='https://www.techwikies.com/wp-content/uploads/2019/03/gp_logo.png' alt='google play' width='110' height='25' /></a></td>
    </tr>";
}
$content_final.="
</tbody>
</table>
Here we will show you today How can you Download and Install <strong><em> $title_dom1 on PC</em></strong> running any OS including <strong><em>Windows and MAC</em></strong> variants, however, if you are interested in other apps, visit our site about <strong><em>Android Apps on PC</em></strong> and locate your favorite ones, without further ado, let us continue .
<h2><strong>$title_dom1</strong> on PC (Windows / MAC)</h2>
<ul>
 	<li>Download and install <a href='https://www.techwikies.com/reviews/android-emulators-for-pc/' target='_blank' rel='noopener noreferrer'>Android Emulator for PC</a> of your choice from the list we provided.</li>
 	<li>Open the installed Emulator and open the Google Play Store in it.</li>
 	<li>Now search for “<strong><em>$title_dom1</em></strong>” using the Play Store.</li>
 	<li>Install the game and open the app drawer or all apps in the emulator.</li>
 	<li>Click <strong><em>$title_dom1</em></strong> icon to open it, follow the on-screen instructions to play it.</li>
 	<li>You can also download <strong>$title_dom1 APK</strong> and installs via APK in the BlueStacks Android emulator.</li>
 	<li>You can also try other Emulators to install <strong><em>$title_dom1 for PC.</em></strong></li>
</ul>
That’s All for the guide on <strong><em><a>$title_dom1 For PC (Windows &amp; MAC)</a></em></strong>, follow our Blog on social media for more Creative and juicy Apps and Games. For Android and iOS please follow the links below to Download the Apps on respective OS. [appbox googleplay $g_id]";
echo '<br>';
		}

		else{ // URL IS LIVE ON PLAY STORE
            echo 'Play store';
            echo '<br>';
			$title_dom1 = $play_html->find('h1.AHFaub span', 0);
	    	$title_dom1=trim($title_dom1->plaintext);
	    	$title_dom1 = preg_replace('/[^0-9a-zA-Z -,:!#)(]/', "",$title_dom1);
            // var_dump("Name: ".$title_dom1);
           

	        $dev_name = $play_html->find('a[class=hrTbp R8zArc]', 0);
	    	$dev_name=trim($dev_name->plaintext);
	    	//var_dump("Developer: ".$dev_name);
            
	    
	    	$images_dom = $play_html->find('img[alt=Cover art]', 0); $image = false;
	    	if($images_dom){
	    		$image1=trim($images_dom->src);
	    		}
	    	$image_par= explode('=', $image1);
	    	$image2= "http:".$image_par[0]."=w300";
	    	$image_par2= explode('/', $image2);
            $image = "https://".$image_par2[2]."/". $image_par2[3];
            
                if (strpos($image1,'180') !== false) { //first we check if the url contains the string 'en-us'
                    $image1 = str_replace('180', '300', $image1); //if yes, we simply replace it with en
                }

			$category_name = $play_html->find('a[itemprop=genre]', 0);
            $category_name=trim($category_name->plaintext);
            if($category_name=="Word" || $category_name=="Action" || $category_name=="Adventure" || $category_name=="Arcade" || $category_name=="Board" || $category_name=="Card" || $category_name=="Casino" || $category_name=="Educational" || $category_name=="Music" || $category_name=="Racing" || $category_name=="Role Playing" || $category_name=="Simulation" || $category_name=="Sports" || $category_name=="Strategy" || $category_name=="Trivia" ){
                
                if($i=='1'){
                    $post_title_name="How to play $title_dom1 on PC (Windows/Mac)";
                }
                elseif($i=='2'){
                    $post_title_name="$title_dom1 Review & How To Get For Mobile & PC";
                }
                elseif($i=='3'){
                    $post_title_name="$title_dom1 for PC – Windows 7, 8, 10 – Free Download";
                }
                elseif($i=='4'){
                    $post_title_name="Download, Install & play $title_dom1 NAME on PC (Windows & Mac)";
                }
                elseif($i=='5'){
                    $post_title_name="$title_dom1  For PC (Windows 10, 8, 7)";
                }
                else {
                    $post_title_name="$title_dom1  On Your PC (Windows And Mac)";
                    $i=1;
                }
            }
            else{
               
                if($i=='1'){
                    $post_title_name="How to use  $title_dom1 on PC (Windows/Mac)";
                }
                elseif($i=='2'){
                    $post_title_name="$title_dom1 Review & How To Get For Mobile & PC";
                }
                elseif($i=='3'){
                    $post_title_name="$title_dom1 for PC – Windows 7, 8, 10 – Free Download";
                }
                elseif($i=='4'){
                    $post_title_name="Download, Install & Use $title_dom1 on PC (Windows & Mac)";
                }
                elseif($i=='5'){
                    $post_title_name="$title_dom1  For PC (Windows 10, 8, 7)";
                }
                else {
                    $post_title_name="$title_dom1  On Your PC (Windows And Mac)";
                    $i=1;
                }
            }
	    	//var_dump("Category: ".$category_name);
           
	    
	    	$rating = $play_html->find('div[class=BHMmbe]', 0);
	    	$rating=trim($rating->innertext);
	    	//var_dump("Rating: ".$rating);
           	
	    	$total_ratings = $play_html->find('span[class=EymY4b] span', 1);
	    	$total_ratings=trim($total_ratings->plaintext);
	    	//var_dump("Total Ratings: ".$total_ratings);
            	
	    	$chk = $play_html->find('div[class=BgcNfc]', 0);
                    $mychk=trim($chk->plaintext);

                    if($mychk=="Updated")
                    {
                        $lasts_updated = $play_html->find('span[class=htlgb]', 0);
                        $last_updated=trim($lasts_updated->plaintext);

                        // echo "IF Last date = ".$last_updated;
                        // echo'<br>';
                    }

                    else
                    {
                        $lasts_updated = $play_html->find('span[class=htlgb]',2);
                        $last_updated=trim($lasts_updated->plaintext);
                    }

            $last_updated = strip_tags($last_updated);
            // var_dump($last_updated);
           
	    	$size = $play_html->find('span[class=htlgb]', 2);
	    	$size=trim($size->plaintext);
	    	//var_dump("size: ".$size);
           
	    	$Installs = $play_html->find('span[class=htlgb]', 4);
	    	$Installs = trim($Installs->plaintext);
	    	//var_dump("Installs: ".$Installs);
           
	    	$Current_Version = $play_html->find('span[class=htlgb]', 6);
	    	$Current_Version= trim($Current_Version->plaintext);
	    	//var_dump("Current Version: ".$Current_Version);
           
	    	$Req_Android = $play_html->find('span[class=htlgb]', 8);
	    	$Req_Android=trim($Req_Android->plaintext);
	    	//var_dump("Req Android: ".$Req_Android);
           
	    	$Content_Rating = $play_html->find('span[class=htlgb]', 10);
            $Content_Rating=trim($Content_Rating->plaintext);
            $Content_Rating = str_replace("Learn more", "", $Content_Rating);
	    	//var_dump("Content Rating: ".$Content_Rating);
            if($content==""){

                $content="Download $title_dom1 for PC/Mac/Windows 7,8,10 and have the fun experience of using the smartphone Apps on Desktop or personal computers.
                New and rising App, <b><em>$title_dom1</em></b> developed by <b><em>$dev_name</em></b> for Android is available for free in the Play Store. <em>$title_dom1</em> has the latest version of $Current_Version. Before we move toward the installation guide of <em>$title_dom1 on PC</em> using Emulators, you can go on official Play store to see what they are offering, You can read the Complete Features and Description of the App there.";
             }

             $content_final = "<p style='text-align: justify;'><img class='alignright' src='$image1' alt='$title_dom1' width='200' height='200' /></p>
             $content<br>
             ";
                                 ///                
                         $args = array( 'posts_per_page' => 1, 'orderby' => 'rand' );
                         $rand_posts = get_posts( $args );
                         foreach ( $rand_posts as $post ) : 
                         setup_postdata( $post );?>
                         <?php $id = $post->id ?>
                         <?php $content_final .="<p>See more: <strong><a href='".post_permalink($id)."'>".$post->post_title." </a></strong></b>.<br></p>"; ?>
                         <?php endforeach;
                         
                         wp_reset_postdata();
                         
                         $content_final.="<h3>$title_dom1 Details</h3>
             <table>
             <tbody>
             <tr>
             <td>Name:</td>
             <td>$title_dom1</td>
             </tr>
             <tr>
             <td>Developers:</td>
             <td>$dev_name</td>
             </tr>
             <tr>
             <td>Category:</td>
             <td>$category_name</td>
             </tr>";
             if(!empty($rating)){
                 $content_final.="<tr>
                 <td>Score:</td>
                 <td>$rating/5</td>
                 </tr>";
             }
             if(!empty($Current_Version)){
                 $content_final.="<tr>
                 <td>Version:</td>
                 <td>$Current_Version</td>
                 </tr>";
             }
             if(!empty($last_updated)){
                 $content_final.="<tr>
                 <td>Updated:</td>
                 <td>$last_updated</td>
                 </tr>";
             }
             if(!empty($total_ratings)){
                 $content_final.="<tr>
                 <td>Total Rating:</td>
                 <td>$total_ratings</td>
                 </tr>";
             }
             if(!empty($Installs)){
                 $content_final.="<tr>
                 <td>Downloads:</td>
                 <td>$Installs</td>
                 </tr>";
             }
             if(!empty($g_id)){
                 $content_final.="<tr>
                 <td>Google Play-URL:</td>
                 <td><a href='$g_url' target='_blank' rel='nofollow noopener noreferrer'><img class='align-center wp-image-62' src='https://www.techwikies.com/wp-content/uploads/2019/03/gp_logo.png' alt='google play' width='110' height='25' /></a></td>
                 </tr>";
             }
             if(!empty($Req_Android)){
                $content_final.="<tr>
                <td>Require Android Version:</td>
                <td>$Req_Android</td>
                </tr>";
            }
             $content_final.="
             
             
             </tbody>
             </table>
             Here we will show you today How can you Download and Install <strong><em>$category_name $title_dom1 on PC</em></strong> running any OS including <strong><em>Windows and MAC</em></strong> variants, however, if you are interested in other apps, visit our site about <strong><em>Android Apps on PC</em></strong> and locate your favorite ones, without further ado, let us continue .
             <h2><strong>$title_dom1</strong> on PC (Windows / MAC)</h2>
             <ul>
                  <li>Download and install <a href='https://www.techwikies.com/reviews/android-emulators-for-pc/' target='_blank' rel='noopener noreferrer'>Android Emulator for PC</a> of your choice from the list we provided.</li>
                  <li>Open the installed Emulator and open the Google Play Store in it.</li>
                  <li>Now search for “<strong><em>$title_dom1</em></strong>” using the Play Store.</li>
                  <li>Install the game and open the app drawer or all apps in the emulator.</li>
                  <li>Click <strong><em>$title_dom1</em></strong> icon to open it, follow the on-screen instructions to play it.</li>
                  <li>You can also download <strong>$title_dom1 APK</strong> and installs via APK in the BlueStacks Android emulator.</li>
                  <li>You can also try other Emulators to install <strong><em>$title_dom1 for PC.</em></strong></li>
             </ul>
             That’s All for the guide on <strong><em><a>$title_dom1 For PC (Windows &amp; MAC)</a></em></strong>, follow our Blog on social media for more Creative and juicy Apps and Games. For Android and iOS please follow the links below to Download the Apps on respective OS. [appbox googleplay $g_id]";
             
                     
         
 echo '<br>';
		}
		 echo '<br>';
    echo $content_final;
    echo '<br>';
    echo '<h1> New Post </h1>';
    echo '<br>';
    echo "Post Name";
    echo '<br>';
    echo $post_title_name;
    echo '<br>';
    $postType = 'post'; // set to post or page
    
    $userID = 9; // set to user id
    $postStatus = 'publish';  // set to future, draft, or publish
    $timeStamp = $minuteCounter = 0;  // set all timers to 0;
    $iCounter = 1; // number use to multiply by minute increment;
    $minuteIncrement = 2; // increment which to increase each post time for future schedule
    $adjustClockMinutes = 0; // add 1 hour or 60 minutes - daylight savings
    
    // CALCULATIONS
    $minuteCounter = $iCounter * $minuteIncrement; // setting how far out in time to post if future.
    $minuteCounter = $minuteCounter + $adjustClockMinutes; // adjusting for server timezone
    
    $timeStamp = date('Y-m-d H:i:s', strtotime("+$minuteCounter min"));
   
    $new_post = array(
        'post_title' => $post_title_name,
        'post_content' => $content_final,
        'post_status' => $postStatus,
        'post_date' => $timeStamp,
        'post_author' => $userID,
        'post_type' => $postType,
        'post_category' => array($category)
        );
        $post_id = wp_insert_post($new_post);
        $tags = array($title_dom1,$title_dom1.' android', $title_dom1.' for mac', $title_dom1.'   PC' , $title_dom1. ' for windows', $title_dom1. ' on PC', $title_dom1. ' on PC', $title_dom1. '  online'); // Array of Tags to add
        wp_set_post_tags( $post_id, $tags);
        $data=upload_image($image1,$title_dom1,1);
        $thumbnail_id =$data;
        set_post_thumbnail( $post_id, $thumbnail_id );
        update_post_meta($data, '_wp_attachment_image_alt', $title_dom1);
        $meta=get_post_meta($data, '_wp_attachment_image_alt', true);
        echo "meta: ".$meta;
        /*******************************************************
        ** SIMPLE ERROR CHECKING
        *******************************************************/
        
        $finaltext = '';
        
        if($post_id)
        {
        
        $finaltext .= 'Yay, I made a new post.<br>';
        
        }
        else
        {
        
        $finaltext .= 'Something went wrong and I didn\'t insert a new post.<br>';
        
        }
        
        echo $finaltext;
                                  $update=$wpdb->update('wp_crawl', array('post_id'=>$post_id,'status_post'=>'1'), array('id'=>$br_id));
      if($update){
        echo "updated ";
        echo "<br>";
      }

	}
	else{
		echo "no HTML found";
    }
   
   
}

function upload_image($url,$title_dom1, $post_id) {
     echo "<br>".$url;
   
    $image_url        = $url; // Define the image URL here
        $image_name       = $title_dom1.'.png';
        $upload_dir       = wp_upload_dir(); // Set upload folder
        $image_data       = file_get_contents($image_url); // Get image data
        $unique_file_name = wp_unique_filename( $upload_dir['path'], $image_name ); // Generate unique name
        $filename         = basename( $unique_file_name ); // Create image file name
        // Check folder permission and define file location
        if( wp_mkdir_p( $upload_dir['path'] ) ) {
            $file = $upload_dir['path'] . '/' . $filename;
        } else {
            $file = $upload_dir['basedir'] . '/' . $filename;
        }
        // echo "<br>image data".$image_data."<br>";
        // Create the image  file on the server
        file_put_contents( $file, file_get_contents($image_url) );
        // Check image file type
        $wp_filetype = wp_check_filetype( $filename, null );
        // Set attachment data
        $attachment = array(
            'post_author'    => '1',
            'post_mime_type' => $wp_filetype['type'],
            'post_title'     => sanitize_file_name( $filename ),
            'post_content'   => '',
            'post_status'    => 'inherit'
        );
        // Create the attachment
        $attach_id = wp_insert_attachment( $attachment, $file, $post_id );
        // Include image.php
        require_once(ABSPATH . 'wp-admin/includes/image.php');
        // Define attachment metadata
        $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
        // Assign metadata to attachment
        wp_update_attachment_metadata( $attach_id, $attach_data );
        $image_url = wp_get_attachment_url($attach_id);
        echo $image_url."<br>";
        return $attach_id;
}
?>