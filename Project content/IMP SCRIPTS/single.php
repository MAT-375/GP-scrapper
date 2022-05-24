<?php
include("inc/header.php"); ?>
<div class="container" style="margin-top:8rem;">
    <div class="row left">
        <div class="col-lg-8 col-md-12 col-sm-12">
            <div class="box">
                <div class="title bread-crumbs">
                    <a href="<?php echo $home_url; ?>">Home</a> »  <a href="<?php echo $home_url; ?>category/<?php echo $rwDt['app_genre_slug']; ?>/"><?php echo $rwDt['app_genre']; ?></a> » <span
                        itemprop="name"><?php echo $rwDt['app_title_play']; ?></span>
                    <!-- <div class="addthis-menu">
                        <a class="addthis-custom"></a>
                    </div> -->
                </div>
                <dl class="ny-dl ny-dl-n">
                    <dt>
                        <div class="icon"><img title="<?php echo $rwDt['app_title_play']; ?> icon" alt="<?php echo $rwDt['app_title_play']; ?> icon" src="<?php echo $rwDt['app_icon_play']; ?>">
                        </div>
                    </dt>
                    <dd>
                        <div class="title-like">
                            <h1><?php echo $rwDt['app_title_play']; ?></h1>
                        </div>
                        <!-- <div class="details-sdk"><span itemprop="version">219.0.0.12.117 </span>for Android</div> -->
                        <div class="details-rating">
                            <div class="stars"><span class="score" title="<?php echo $rwDt['app_title_play']; ?> average rating"
                                    style="width:<?php echo $rating_avg; ?>"></span><span class="star"></span> </div>
                            <div class="rating-info">
                            <?php echo $rwDt['app_rating_play']; ?>
                                <span class="details-delimiter"> | </span>
                                <span class="details-to-bottom" data-type="reviews"><?php echo $rwDt['app_downloads']; ?> Downloads</span>
                            </div>
                        </div>
                        <div class="details-author">
                            <p itemprop="publisher">
                                <a href="<?php echo $home_url."developer/".$rwDt['app_dev_slug']."/"; ?>" title="<?php echo $rwDt['app_developer']; ?>"><?php echo $rwDt['app_developer']; ?></a>
                            </p>
                        </div>
                        <div class="ny-down">
                            <div class="div-box" style="display: inline-block">
                                <span class="da apC-dw" id="ap-dw" style="cursor:pointer;" title="Download <?php echo $rwDt['app_title_play']; ?> latest version apk">Download
                                    APK<span class="fsize">(<span><?php echo $rwDt['app_size']; ?></span>)</span></span>

                                <div class="other-btn-box mr-24">
                                </div>
                            </div>
                        </div>
                    </dd>
                </dl>
                <div class="describe">
                    <div class="describe-line"></div>
                    <div class="describe-img">
                        <div id="slide-box">
                            <div class="det-pic-out">
                                <ul class="pa det-pic-list" style="left: 0px;">
                                    <li class="amagnificpopup">
                                        <?php 
                                        $s_Shot = explode(",",$rwDt['app_screenshots_play']);
                                        // if($rwDt['app_video'] != ""){
                                        //     echo "<iframe id='apTvd' style='border-style: none;width: 480px; height: 355px;vertical-align: middle;' src='".$rwDt['app_video']."' alt='".$rwDt['app_title_play']." video'></iframe>";
                                        // }
                                        $ss_counter = 0; 
                                        foreach($s_Shot as $ss){
                                            $ss_counter = $ss_counter+1;
                                            // $s_shot = str_replace("=w1440-h620","=w1440-h620-rw",$ss);
                                            ?>
                                            <a class="mpopup" target="_blank"
                                                href="<?php echo $ss; ?>"
                                                title="<?php echo $rwDt['app_title_play']; ?>">
                                                <img alt="<?php echo $rwDt['app_title_play']; ?> screenshot <?php echo $ss_counter; ?>" height="355" src="<?php echo $ss."-rw"; ?>">
                                            </a>
                                            <?php
                                        }
                                        ?>
                                        
                                    </li>
                                </ul>
                            </div>
                            <a href="javascript:void(0)" class="det-pic-control" id="prev" go=""
                                style="opacity: 0; display: inline;"></a>
                            <a href="javascript:void(0)" class="det-pic-control go" id="next" go=""></a>
                        </div>
                    </div>
                    <div class="describe-line"></div>
                    <div id="describe" style="height:auto !important;">
                        <div class="description">
                            <div class="content" itemprop="description">
                            <?php 
                            $rep = array('\n','\r','\t','\\','<h2>Description</h2>');
                            echo str_replace($rep,"",$rwDt['app_description']);
                            ?>
                            <div class="d-flex">
                                <div class="p-2 flex-fill">
                                    <?php
                                        if(trim($rwDt['app_advantages'])!=""){
                                            echo "<h3> Pros:</h3>";
                                            $advt = explode(",",$rwDt['app_advantages']);
                                            echo "<ul class='pc_list p-0'>";
                                            foreach($advt as $adv){
                                                echo "<li><i class='fa fa-chevron-right mr-2'></i> ".str_replace($rep,"",$adv)." </li>";
                                            }
                                            echo "</ul>";
                                        }
                                    ?>
                                </div>
                                <div class="p-2 flex-fill">
                                    <?php
                                        if(trim($rwDt['app_disadvantages'])!=""){
                                            echo "<h3> Cons:</h3>";
                                            $dadvt = explode(",",$rwDt['app_disadvantages']);
                                            echo "<ul class='pc_list2 p-0'>";
                                            foreach($dadvt as $dadv){
                                                echo "<li><i class='fa fa-chevron-right mr-2'></i> ".str_replace($rep,"",$dadv)."</li>";
                                            }
                                            echo "</ul>";
                                        }
                                    ?>
                                </div>
                            </div>
                            <?php
                            ?>
                            
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="describe-line"></div>
                <div class="tag">
                    <h2><?php $rwDt['app_title_play'] ?> Tags</h2>
                    <div class="tag_wrap">
                        <ul class="tag_list">
                            <?php
                            $tags = explode(",",$rwDt['app_tags']);
                            foreach($tags as $tag){
                                $replace = array(" ","_"," &amp; ","&amp;","(",")");
                                $tag = trim($tag);
                                $tag_slug = strtolower(str_replace($replace,"-",$tag));
                                $tag_slug = preg_replace('/--+/', '-', $tag_slug);
                                // $tag_slug_new = strtolower(str_replace(" ","-",trim($tag)));
                                echo "<li><a href='".$home_url."tag/".$tag_slug."'>$tag</a></li>";
                            } 
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="describe-line"></div>
                <div class="additional">
                    <h2>Additional App Information</h2>
                    <ul>
                        <li>
                            <p><strong>Category:</strong></p>
                            <p><a title="Download more Social apps" href="<?php echo $home_url."category/".$rwDt['app_genre_slug']; ?>/"><?php echo $rwDt['app_genre']; ?></a></p>
                        </li>
                        <li>
                            <p><strong>Latest Version:</strong></p>
                            <p><?php echo $rwDt['app_version']; ?></p>
                        </li>
                        <!-- <li>
                            <p><strong>Publish Date:</strong></p>
                            <p itemprop="datePublished"><?php echo date('F j, Y',strtotime($rwDt['app_created'])); ?></p>
                        </li> -->
                        <li>
                            <p><strong>Developer:</strong></p>
                            <p><a href="<?php echo $home_url."developer/".$rwDt['app_dev_slug']."/"; ?>"><?php echo $rwDt['app_developer']; ?></a></p>
                        </li>
                        <li>
                            <p><strong>Available on:</strong></p>
                            <p><a class="ga"
                                    title="Get <?php echo $rwDt['app_title_play']; ?> on Google Play" rel="nofollow"
                                    href="https://play.google.com/store/apps/details?id=<?php echo $rwDt['app_play_id']; ?>"
                                    target="_blank"><img alt="Get <?php echo $rwDt['app_title_play']; ?> on Google Play"
                                        src="<?php echo $home_url; ?>img/gp_logo.png" height="16"></a>
                            </p>
                        </li>
                        <li>
                            <p><strong>Requirements:</strong></p>
                            <p>Android <?php echo $rwDt['app_android_version']; ?></p>
                            <meta itemprop="operatingSystem" content="ANDROID">
                        </li>
                    </ul>
                </div>
                <!-- <div class="comment_section p-3">
                    <h3>Leave a Comment</h3>
                    <div class="comment-fields">
                        <form action="" method="post">
                            <div class="form-group mt-2">
                                <input type="text" class="form-control" name="comment_name" placeholder="Name" required>
                            </div>
                            <div class="form-group mt-2">
                                <input type="email" class="form-control" name="comment_email" placeholder="Email" required>
                            </div>
                            <div class="form-group mt-2">
                                <textarea class="form-control" name="comment_text" id="comment_text" cols="30" rows="6" placeholder="Write Comment Here..."></textarea>
                            </div>
                        </form>
                    </div>
                </div> -->
                <div id="disqus_thread" class="p-3"></div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12">
            <div class="box">
                <div class="title">
                    <div class="tit">Discover App</div>
                    <div class="more"><a href="<?php echo $home_url; ?>">More »</a></div>
                </div>
                <ul class="index-left-ul index-left-ul-s">
                <?php
                $main_category = $rwDt['app_category'];
                $qy = mysqli_query($conn, "SELECT * FROM apps_trans_data WHERE app_category='$main_category' AND status=2 AND app_rating_play!='' ORDER BY RAND() LIMIT 10");
                if(mysqli_num_rows($qy)>0){
                    while ($row = mysqli_fetch_assoc($qy)) {
                        $rating_avg = ($row['app_rating_play']/5*100)."%";
                        ?>

                        <li>
                        <a href="<?php echo $home_url.$row['app_slug']; ?>/" title="<?php echo $row['app_title_play']; ?>">
                            <div class="app-icon"><img alt="<?php echo $row['app_title_play']; ?>" src="<?php echo str_replace("=s360-rw","=s75-rw",$row['app_icon_play']); ?>" class="loaded"></div>
                            <div class="app-text">
                                <p class="app-text-title"><?php echo $row['app_title_play']; ?></p>
                                <p><?php echo $row['app_version']; ?></p>
                                <p class="app-text-developer"><?php echo $row['app_developer']; ?></p>
                            </div>
                        </a>
                    </li>
                        <?php
                    }
                }
                ?>
                </ul>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>
<?php include("inc/footer.php");?>
<script>
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
    });
</script>