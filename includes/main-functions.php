<?php

function test_ajax_load_scripts() {
    
    global $bm_options;

    // load our jquery file that sends the $.post request
    wp_enqueue_script('ajax-test', BM_BASE_URL . 'includes/js/baeble-music-plugin.js', array( 'jquery' ) );
    
    // make the ajaxurl var available to the above script
    wp_localize_script( 'ajax-test', 'the_ajax_script', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
    
    if (is_single()) {
        $page_state = 'single';    
        $length = $bm_options['thumbs_append'];            
    } else {
        $page_state =  'standalone';   
        $length = $bm_options['thumbs_stand_alone'];
    }
    
    // make another variable local
    wp_localize_script( 'ajax-test', 'tiles', array( 'length' => "$length" ) );
    
    // make another variable local
    wp_localize_script( 'ajax-test', 'testvariable', array( 'name' => "$page_state" ) );
    
    
    // load our jquery file that sends the $.post request
    wp_enqueue_script('fancy-test', BM_BASE_URL . 'includes/js/jquery.fancybox.js', array( 'jquery' ) );
    
    // make the ajaxurl var available to the above script
    wp_localize_script( 'fancy-test', 'the_ajax_script', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
    
    // add the toggle script
    wp_enqueue_script('toggle', BM_BASE_URL . 'includes/js/toggle.js', array( 'jquery' ) );
    

}

// Add it
add_action('wp_print_scripts', 'test_ajax_load_scripts');

// Get the JSON data and be ready to display
function text_ajax_process_request() {
    
    //now time to enable/disable the sections
    global $bm_options;
    
    // Put new conditional here and adjust below
    // need to know if we are on the post or the page
    

    // first check if data is being sent and that it is the data we want
    if ($_POST["post_var"] == "trending" ) {
        $body = file_get_contents("https://www.baeblemusic.com/googletv/trendingJSON.txt");
        $json = json_decode($body,true);
        $total = count($json['Overall']);

       // echo $_POST["page_state"];
        
        // define number of entries per page
        if ($_POST["page_state"] == "single") {
        $per_page = $bm_options['thumbs_append'];            
        } elseif ($_POST["page_state"] == "standalone") {
        $per_page = $bm_options['thumbs_stand_alone'];
        }
       
        // $per_page = 3;

        
        // And the current page
        if (isset($_POST["current_page"])) {
            $current_page = $_POST["current_page"];
        } else {
            $current_page = 0;
        }

        // get the other pages
        $next_page = $current_page + 1;
        $previous_page = ($current_page - 1);
        for ($i=0; $i < $per_page; $i++) {
            // The multiplier
            $m = ($current_page * $per_page) + $i;
            $bandName = $json['Overall'][$m]['bandName'];
            $playCount = number_format($json['Overall'][$m]['playCount']);
            $videoType = ucfirst($json['Overall'][$m]['videoType']);
            $thumbnail = $json['Overall'][$m]['thumbnail'];
            $url = $json['Overall'][$m]['url'];
            $title = $json['Overall'][$m]['title'];
            $id = $json['Overall'][$m]['id'];
            $category = "Overall";
            $index = $m;
            $pageURL =  $json['Overall'][$m]['pageURL'];
                    
            // We need to remove any <br> from the title
            $title = str_replace("<br/>","",$title);

            // We also need to remove the band name from the title
            $title = str_replace("$bandName","",$title);
  
            // If this is a music video, then we want to include the song title as well
            if ($videoType == "Musicvideo") {
                $bandName = "$bandName - $title";
                $videoType = "Music Video";
            }
 
            if ($videoType == "Guestapt") {
                $videoType = "Session";
            }
                    
            // let's make the thumbnail secure
            $thumbnail = "https://canvas.baeblemusic.com/secureimage.php?url=" . $thumbnail;
               
            $video_url = "video.php?category=$category&id=$id&index=$index";
            $video_url = BM_BASE_URL . 'includes/php/' . $video_url;

            // share image
             $share_image = BM_BASE_URL . 'includes/images/share.png';
            
            // html for the tiles        
            $html .= "<li class=\"tiles\"><div class=\"media-thumb-container\">
            <a title=\"$title\" class=\"image fancybox fancybox.iframe\" href=\"$video_url\" onclick=\"setURL('$pageURL');\">
            <span class=\"roll\"></span>
            <img src=\"$thumbnail\">
            </a></div>
            <div class=\"media-info\">
            <a class=\"media-link tile_link fancybox fancybox.iframe\" title=\"$title\" href=\"$video_url\" onclick=\"setURL('$pageURL');\">$bandName, $videoType</a>
            </div>
            <div class=\"media-meta\">
            <div class=\"social_buttons\">
            <iframe src=\"//www.facebook.com/plugins/like.php?href=$pageURL&amp;send=false&amp;layout=button_count&amp;width=80&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21&amp;appId=143293702457868\" scrolling=\"no\" frameborder=\"0\" style=\"border:none; overflow:hidden; width:80px; height:21px;\" allowTransparency=\"true\"></iframe> <a href=\"javascript:void(0)\" onclick=\"window.open('http://www.facebook.com/sharer/sharer.php?u=$pageURL','share_window','width=700,height=400')\"><img src=\"$share_image\"></a>
            </div>
            <div class=\"views\">Views $playCount</div>
            </div>
            </li>";
            
        }
        
        // Add the heading    
        $html = "<div class=\"heading\">Trending</div><ul>" . $html . "</ul>";
        $response = $html;
        echo $response;
        
    }
    
    
    
    // Let's start the new section - Newest
    if ($_POST["post_var"] == "newest") {
        $body = file_get_contents("https://www.baeblemusic.com/googletv/newestVideoJSON.txt");
        $json = json_decode($body,true);
        // get number of entries
        $total = count($json['VIDEOS']);

        // define number of entries per page
        if ($_POST["page_state"] == "single") {
        $per_page = $bm_options['thumbs_append'];            
        } elseif ($_POST["page_state"] == "standalone") {
        $per_page = $bm_options['thumbs_stand_alone'];
        }
        
        // And the current page
        if (isset($_POST["current_page_newest"])) {
            $current_page_newest = $_POST["current_page_newest"];
        } else {
            $current_page_newest = 0;
        }
        
        // get the other pages
        $next_page = $current_page_newest + 1;
        $previous_page = ($current_page_newest - 1);

        for ($i=0; $i < $per_page; $i++) {
            // The multiplier
            $m = ($current_page_newest * $per_page) + $i;
            $bandName = $json['VIDEOS'][$m]['bandName'];
            $playCount = number_format($json['VIDEOS'][$m]['playCount']);
            $videoType = ucfirst($json['VIDEOS'][$m]['videoType']);
            $thumbnail = $json['VIDEOS'][$m]['thumbnail'];
            $url = $json['VIDEOS'][$m]['url'];
            $title = $json['VIDEOS'][$m]['title'];
            $id = $json['VIDEOS'][$m]['id'];
            $pageURL =  $json['VIDEOS'][$m]['pageURL'];
            $category = "VIDEOS";
            $index = $m;
            
            // We need to remove any <br> from the title
            $title = str_replace("<br/>","",$title);

            // We also need to remove the band name from the title
            $title = str_replace("$bandName","",$title);
  
            // If this is a music video, then we want to include the song title as well
            if ($videoType == "Musicvideo") {
                $bandName = "$bandName - $title";
                $videoType = "Music Video";
            }
 
            if ($videoType == "Guestapt") {
                $videoType = "Guest Apartment";
            }
            
            $thumbnail = "https://canvas.baeblemusic.com/secureimage.php?url=" . $thumbnail;

            $video_url = "video.php?category=$category&id=$id&index=$index";
            $video_url = BM_BASE_URL . 'includes/php/' . $video_url;
            
            // share image
             $share_image = BM_BASE_URL . 'includes/images/share.png';
            
            $html .= "<li class=\"tiles\"><div class=\"media-thumb-container\">
            <a title=\"$title\" class=\"image fancybox fancybox.iframe\" href=\"$video_url\" onclick=\"setURL('$pageURL');\">
            <span class=\"roll\"></span>
            <img src=\"$thumbnail\">
            </a></div>
            <div class=\"media-info\">
            <a class=\"media-link tile_link fancybox fancybox.iframe\" title=\"$title\" href=\"$video_url\" onclick=\"setURL('$pageURL');\">$bandName, $videoType</a>
            </div>
            <div class=\"media-meta\">
            <div class=\"social_buttons\">
            <iframe src=\"//www.facebook.com/plugins/like.php?href=$pageURL&amp;send=false&amp;layout=button_count&amp;width=80&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21&amp;appId=143293702457868\" scrolling=\"no\" frameborder=\"0\" style=\"border:none; overflow:hidden; width:80px; height:21px;\" allowTransparency=\"true\"></iframe> <a href=\"javascript:void(0)\" onclick=\"window.open('http://www.facebook.com/sharer/sharer.php?u=$pageURL','share_window','width=700,height=400')\"><img src=\"$share_image\"></a>
            </div>
            <div class=\"views\">Views $playCount</div>
            </div>
            </li>";
        }
        
        // Add the heading    
        $html = "<div class=\"heading\">Newest</div><ul>" . $html . "</ul>";
        $response = $html;
        echo $response;

    }
    // Let's start the new section - Concerts
    if ($_POST["post_var"] == "concerts") {
        $body = file_get_contents("https://www.baeblemusic.com/googletv/library5.txt");
        $json = json_decode($body,true);
        // get number of entries
        $total = count($json['Concerts']);

    
        // define number of entries per page
        if ($_POST["page_state"] == "single") {
        $per_page = $bm_options['thumbs_append'];            
        } elseif ($_POST["page_state"] == "standalone") {
        $per_page = $bm_options['thumbs_stand_alone'];
        }
        
        // And the current page
        if (isset($_POST["current_page_concerts"])) {
            $current_page_concerts = $_POST["current_page_concerts"];
        } else {
            $current_page_concerts = 0;
        }
        
        // get the other pages
        $next_page = $current_page_concerts + 1;
        $previous_page = ($current_page_concerts - 1);
        
        for ($i=0; $i < $per_page; $i++) {
            // The multiplier
            $m = ($current_page_concerts * $per_page) + $i;
            $bandName = $json['Concerts'][$m]['bandName'];
            $playCount = number_format($json['Concerts'][$m]['playCount']);
            $videoType = ucfirst($json['Concerts'][$m]['videoType']);
            $thumbnail = $json['Concerts'][$m]['thumbnail'];
            $url = $json['Concerts'][$m]['url'];
            $title = $json['Concerts'][$m]['title'];
            $id = $json['Concerts'][$m]['id'];
            $pageURL =  $json['Concerts'][$m]['pageURL'];
            $category = "Concerts";
            $index = $m;

            $title = ucfirst($title);            
            
            $thumbnail = "https://canvas.baeblemusic.com/secureimage.php?url=" . $thumbnail;
            
            $video_url = "video.php?category=$category&id=$id&index=$index";
            $video_url = BM_BASE_URL . 'includes/php/' . $video_url;
            
            // share image
            $share_image = BM_BASE_URL . 'includes/images/share.png';
            
            $html .= "<li class=\"tiles\"><div class=\"media-thumb-container\">
            <a title=\"$title\" class=\"image fancybox fancybox.iframe\" href=\"$video_url\" onclick=\"setURL('$pageURL');\">
            <span class=\"roll\"></span>
            <img src=\"$thumbnail\">
            </a></div>
            <div class=\"media-info\">
            <a class=\"media-link tile_link fancybox fancybox.iframe\" title=\"$title\" href=\"$video_url\" onclick=\"setURL('$pageURL');\">$bandName, $videoType</a>
            </div>
            <div class=\"media-meta\">
            <div class=\"social_buttons\">
            <iframe src=\"//www.facebook.com/plugins/like.php?href=$pageURL&amp;send=false&amp;layout=button_count&amp;width=80&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21&amp;appId=143293702457868\" scrolling=\"no\" frameborder=\"0\" style=\"border:none; overflow:hidden; width:80px; height:21px;\" allowTransparency=\"true\"></iframe> <a href=\"javascript:void(0)\" onclick=\"window.open('http://www.facebook.com/sharer/sharer.php?u=$pageURL','share_window','width=700,height=400')\"><img src=\"$share_image\"></a>
            </div>
            <div class=\"views\">Views $playCount</div>
            </div>
            </li>";
        }
        
         // Add the heading    
        $html = "<div class=\"heading\">Concerts</div><ul>" . $html . "</ul>";
        $response = $html;
        echo $response;
       
    }
    
    // Lets start the new section - Sessions
    if ($_POST["post_var"] == "sessions") {
        $body = file_get_contents("https://www.baeblemusic.com/googletv/library5.txt");
        $json = json_decode($body,true);
        // get number of entries
        $total = count($json['Sessions']);

        // define number of entries per page
        if ($_POST["page_state"] == "single") {
        $per_page = $bm_options['thumbs_append'];            
        } elseif ($_POST["page_state"] == "standalone") {
        $per_page = $bm_options['thumbs_stand_alone'];
        }
        
        // And the current page
        if (isset($_POST["current_page_sessions"])) {
            $current_page_sessions = $_POST["current_page_sessions"];
        } else {
            $current_page_sessions = 0;
        }
        
        // get the other pages
        $next_page = $current_page_sessions + 1;
        $previous_page = ($current_page_sessions - 1);
        
        for ($i=0; $i < $per_page; $i++) {
            // The multiplier
            $m = ($current_page_sessions * $per_page) + $i;
            $bandName = $json['Sessions'][$m]['bandName'];
            $playCount = number_format($json['Sessions'][$m]['playCount']);
            $videoType = ucfirst($json['Sessions'][$m]['videoType']);
            $thumbnail = $json['Sessions'][$m]['thumbnail'];
            $url = $json['Sessions'][$m]['url'];
            $title = $json['Sessions'][$m]['title'];
            $id = $json['Sessions'][$m]['id'];
            $pageURL =  $json['Sessions'][$m]['pageURL'];
            $category = "Sessions";
            $index = $m;

           // Rewrite the video type
            $videoType = "Session";        
            
            $thumbnail = "https://canvas.baeblemusic.com/secureimage.php?url=" . $thumbnail;
            
            $video_url = "video.php?category=$category&id=$id&index=$index";
            $video_url = BM_BASE_URL . 'includes/php/' . $video_url;
            
            // share image
            $share_image = BM_BASE_URL . 'includes/images/share.png';
            
            $html .= "<li class=\"tiles\"><div class=\"media-thumb-container\">
            <a title=\"$title\" class=\"image fancybox fancybox.iframe\" href=\"$video_url\" onclick=\"setURL('$pageURL');\">
            <span class=\"roll\"></span>
            <img src=\"$thumbnail\">
            </a></div>
            <div class=\"media-info\">
            <a class=\"media-link tile_link fancybox fancybox.iframe\" title=\"$title\" href=\"$video_url\" onclick=\"setURL('$pageURL');\">$bandName, $videoType</a>
            </div>
            <div class=\"media-meta\">
            <div class=\"social_buttons\">
            <iframe src=\"//www.facebook.com/plugins/like.php?href=$pageURL&amp;send=false&amp;layout=button_count&amp;width=80&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21&amp;appId=143293702457868\" scrolling=\"no\" frameborder=\"0\" style=\"border:none; overflow:hidden; width:80px; height:21px;\" allowTransparency=\"true\"></iframe> <a href=\"javascript:void(0)\" onclick=\"window.open('http://www.facebook.com/sharer/sharer.php?u=$pageURL','share_window','width=700,height=400')\"><img src=\"$share_image\"></a>
            </div>
            <div class=\"views\">Views $playCount</div>
            </div>
            </li>";
        }
         // Add the heading    
        $html = "<div class=\"heading\">Sessions</div><ul>" . $html . "</ul>";
        $response = $html;
        echo $response;
        
    }
    // Lets start the new section - Interviews
    if ($_POST["post_var"] == "interviews") {
        $body = file_get_contents("https://www.baeblemusic.com/googletv/library5.txt");
        $json = json_decode($body,true);
        // get number of entries
        $total = count($json['Interviews']);

        // define number of entries per page
        if ($_POST["page_state"] == "single") {
        $per_page = $bm_options['thumbs_append'];            
        } elseif ($_POST["page_state"] == "standalone") {
        $per_page = $bm_options['thumbs_stand_alone'];
        }
        
         // And the current page
        if (isset($_POST["current_page_interviews"])) {
            $current_page_interviews = $_POST["current_page_interviews"];
        } else {
            $current_page_interviews = 0;
        }
        
        // get the other pages
        $next_page = $current_page_interviews + 1;
        $previous_page = ($current_page_interviews - 1);
        
        for ($i=0; $i < $per_page; $i++) {
            // The multiplier
            $m = ($current_page_interviews * $per_page) + $i;
            $bandName = $json['Interviews'][$m]['bandName'];
            $playCount = number_format($json['Interviews'][$m]['playCount']);
            $videoType = ucfirst($json['Interviews'][$m]['videoType']);
            $thumbnail = $json['Interviews'][$m]['thumbnail'];
            $url = $json['Interviews'][$m]['url'];
            $title = $json['Interviews'][$m]['title'];
            $id = $json['Interviews'][$m]['id'];
            $pageURL =  $json['Interviews'][$m]['pageURL'];
            $category = "Interviews";
            $index = $m;

            $thumbnail = "https://canvas.baeblemusic.com/secureimage.php?url=" . $thumbnail;
            
            $video_url = "video.php?category=$category&id=$id&index=$index";
            $video_url = BM_BASE_URL . 'includes/php/' . $video_url;
            
            // share image
            $share_image = BM_BASE_URL . 'includes/images/share.png';

            $html .= "<li class=\"tiles\"><div class=\"media-thumb-container\">
            <a title=\"$title\" class=\"image fancybox fancybox.iframe\" href=\"$video_url\" onclick=\"setURL('$pageURL');\">
            <span class=\"roll\"></span>
            <img src=\"$thumbnail\">
            </a></div>
            <div class=\"media-info\">
            <a class=\"media-link tile_link fancybox fancybox.iframe\" title=\"$title\" href=\"$video_url\" onclick=\"setURL('$pageURL');\">$bandName, $videoType</a>
            </div>
            <div class=\"media-meta\">
            <div class=\"social_buttons\">
            <iframe src=\"//www.facebook.com/plugins/like.php?href=$pageURL&amp;send=false&amp;layout=button_count&amp;width=80&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21&amp;appId=143293702457868\" scrolling=\"no\" frameborder=\"0\" style=\"border:none; overflow:hidden; width:80px; height:21px;\" allowTransparency=\"true\"></iframe> <a href=\"javascript:void(0)\" onclick=\"window.open('http://www.facebook.com/sharer/sharer.php?u=$pageURL','share_window','width=700,height=400')\"><img src=\"$share_image\"></a>
            </div>
            <div class=\"views\">Views $playCount</div>
            </div>
            </li>";
        }
         // Add the heading    
        $html = "<div class=\"heading\">Interviews</div><ul>" . $html . "</ul>";
        $response = $html;
        echo $response;
        
    }
    // Lets start the new section - Music Videos
    if ($_POST["post_var"] == "music") {
        $body = file_get_contents("https://www.baeblemusic.com/googletv/library5.txt");
        $json = json_decode($body,true);
        // get number of entries
        $total = count($json['Music Videos']);

        // define number of entries per page
        if ($_POST["page_state"] == "single") {
        $per_page = $bm_options['thumbs_append'];            
        } elseif ($_POST["page_state"] == "standalone") {
        $per_page = $bm_options['thumbs_stand_alone'];
        }
        
         // And the current page
        if (isset($_POST["current_page_music"])) {
            $current_page_music = $_POST["current_page_music"];
        } else {
            $current_page_music = 0;
        }
        
        // get the other pages
        $next_page = $current_page_music + 1;
        $previous_page = ($current_page_music - 1);
        
        for ($i=0; $i < $per_page; $i++) {
            // The multiplier
            $m = ($current_page_music * $per_page) + $i;
            $bandName = $json['Music Videos'][$m]['bandName'];
            $playCount = number_format($json['Music Videos'][$m]['playCount']);
            $videoType = ucfirst($json['Music Videos'][$m]['videoType']);
            $thumbnail = $json['Music Videos'][$m]['thumbnail'];
            $url = $json['Music Videos'][$m]['url'];
            $title = $json['Music Videos'][$m]['title'];
            $id = $json['Music Videos'][$m]['id'];
            $pageURL =  $json['Music Videos'][$m]['pageURL'];
            $category = "Music Videos";
            $index = $m;

            // We need to remove any <br> from the title
            $title = str_replace("<br/>","",$title);

            // We also need to remove the band name from the title
            $title = str_replace("$bandName","",$title);
    
            // If this is a music video, then we want to include the song title as well
            $bandName = "$bandName - $title";
            $videoType = "Music Video";
            
            $thumbnail = "https://canvas.baeblemusic.com/secureimage.php?url=" . $thumbnail;
            
            $video_url = "video.php?category=$category&id=$id&index=$index";
            $video_url = BM_BASE_URL . 'includes/php/' . $video_url;
            
            // share image
            $share_image = BM_BASE_URL . 'includes/images/share.png';
            
            $html .= "<li class=\"tiles\"><div class=\"media-thumb-container\">
            <a title=\"$title\" class=\"image fancybox fancybox.iframe\" href=\"$video_url\" onclick=\"setURL('$pageURL');\">
            <span class=\"roll\"></span>
            <img src=\"$thumbnail\">
            </a></div>
            <div class=\"media-info\">
            <a class=\"media-link tile_link fancybox fancybox.iframe\" title=\"$title\" href=\"$video_url\" onclick=\"setURL('$pageURL');\">$bandName, $videoType</a>
            </div>
            <div class=\"media-meta\">
            <div class=\"social_buttons\">
            <iframe src=\"//www.facebook.com/plugins/like.php?href=$pageURL&amp;send=false&amp;layout=button_count&amp;width=80&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21&amp;appId=143293702457868\" scrolling=\"no\" frameborder=\"0\" style=\"border:none; overflow:hidden; width:80px; height:21px;\" allowTransparency=\"true\"></iframe> <a href=\"javascript:void(0)\" onclick=\"window.open('http://www.facebook.com/sharer/sharer.php?u=$pageURL','share_window','width=700,height=400')\"><img src=\"$share_image\"></a>
            </div>
            <div class=\"views\">Views $playCount</div>
            </div>
            </li>";
        }
         // Add the heading    
        $html = "<div class=\"heading\">Music Videos</div><ul>" . $html . "</ul>";
        $response = $html;
        echo $response;
        
    }
    die();
    
    
}

// Hook in the function
add_action('wp_ajax_nopriv_test_response', 'text_ajax_process_request');
add_action('wp_ajax_test_response', 'text_ajax_process_request');


// Add the content to the end of a post
function display_link($content) {
        
    // Get the current page title
    $current_page_title = get_the_title();
    $current_page_id = $_GET['page_id'];
    
    
    // using database instead
    $post_id = get_option('plugin_page_id');
    
    // Put new conditional here and adjust below
    if((!is_single()) AND ($current_page_id != $post_id)) {
        return $content;
    }

    ob_start();
    
    
    // Trending
    
       
    global $bm_options;
    
    
    
    if (is_single()) {
        
        // We know the page state, thus we know which column to grab numbers from $bm_options['thumbs_append'];
        
        
        
        if (($bm_options['activate'] == "Yes") AND ($bm_options['Trending'] == 1) AND ($bm_options['post_appending'] == "Yes")) {
            echo '<div id="display_trending"></div>';
            echo '<input type="button" id="driver" value="" />';
            echo '<input type="button" id="driver2" value="" />';
            echo '<input type="hidden" id="current_page" name="current_page" value="0" />';
        }
    
        // Newest
        
        if (($bm_options['activate'] == "Yes") AND ($bm_options['Newest'] == 1) AND ($bm_options['post_appending'] == "Yes")){
            echo '<div id="display_newest"></div>';
            echo '<input type="button" id="driver_newest" value="" />';
            echo '<input type="button" id="driver2_newest" value="" />';
            echo '<input type="hidden" id="current_page_newest" name="current_page_newest" value="0" />';
        }
    
        // Concerts
    
        if (($bm_options['activate'] == "Yes") AND ($bm_options['Concerts'] == 1) AND ($bm_options['post_appending'] == "Yes")){
            echo '<div id="display_concerts"></div>';
            echo '<input type="button" id="driver_concerts" value="" />';
            echo '<input type="button" id="driver2_concerts" value="" />';
            echo '<input type="hidden" id="current_page_concerts" name="current_page_concerts" value="0" />';
        }
    
        // Sessions
        if (($bm_options['activate'] == "Yes") AND ($bm_options['Sessions'] == 1) AND ($bm_options['post_appending'] == "Yes")) {
            echo '<div id="display_sessions"></div>';
            echo '<input type="button" id="driver_sessions" value="" />';
            echo '<input type="button" id="driver2_sessions" value="" />';
            echo '<input type="hidden" id="current_page_sessions" name="current_page_sessions" value="0" />';
        }
    
        // Interviews
        if (($bm_options['activate'] == "Yes") AND ($bm_options['Interviews'] == 1) AND ($bm_options['post_appending'] == "Yes")){
            echo '<div id="display_interviews"></div>';
            echo '<input type="button" id="driver_interviews" value="" />';
            echo '<input type="button" id="driver2_interviews" value="" />';
            echo '<input type="hidden" id="current_page_interviews" name="current_page_interviews" value="0" />';
        }

        // Music Videos
         if (($bm_options['activate'] == "Yes") AND ($bm_options['Music Videos'] == 1) AND ($bm_options['post_appending'] == "Yes")) {
            echo '<div id="display_music"></div>';
            echo '<input type="button" id="driver_music" value="" />';
            echo '<input type="button" id="driver2_music" value="" />';
            echo '<input type="hidden" id="current_page_music" name="current_page_music" value="0" />';
        }
    } elseif($current_page_id == $post_id) {
        
        if (($bm_options['activate'] == "Yes") AND ($bm_options['Trending_2'] == 1) AND ($bm_options['standalone'] == "Yes")) {
            echo '<div id="display_trending"></div>';
            echo '<input type="button" id="driver" value="" />';
            echo '<input type="button" id="driver2" value="" />';
            echo '<input type="hidden" id="current_page" name="current_page" value="0" />';
        }
    
        // Newest
        
        if (($bm_options['activate'] == "Yes") AND ($bm_options['Newest_2'] == 1) AND ($bm_options['standalone'] == "Yes")){
            echo '<div id="display_newest"></div>';
            echo '<input type="button" id="driver_newest" value="" />';
            echo '<input type="button" id="driver2_newest" value="" />';
            echo '<input type="hidden" id="current_page_newest" name="current_page_newest" value="0" />';
        }
    
        // Concerts
    
        if (($bm_options['activate'] == "Yes") AND ($bm_options['Concerts_2'] == 1) AND ($bm_options['standalone'] == "Yes")){
            echo '<div id="display_concerts"></div>';
            echo '<input type="button" id="driver_concerts" value="" />';
            echo '<input type="button" id="driver2_concerts" value="" />';
            echo '<input type="hidden" id="current_page_concerts" name="current_page_concerts" value="0" />';
        }
    
        // Sessions
        if (($bm_options['activate'] == "Yes") AND ($bm_options['Sessions_2'] == 1) AND ($bm_options['standalone'] == "Yes")) {
            echo '<div id="display_sessions"></div>';
            echo '<input type="button" id="driver_sessions" value="" />';
            echo '<input type="button" id="driver2_sessions" value="" />';
            echo '<input type="hidden" id="current_page_sessions" name="current_page_sessions" value="0" />';
        }
    
        // Interviews
        if (($bm_options['activate'] == "Yes") AND ($bm_options['Interviews_2'] == 1) AND ($bm_options['standalone'] == "Yes")){
            echo '<div id="display_interviews"></div>';
            echo '<input type="button" id="driver_interviews" value="" />';
            echo '<input type="button" id="driver2_interviews" value="" />';
            echo '<input type="hidden" id="current_page_interviews" name="current_page_interviews" value="0" />';
        }

        // Music Videos
         if (($bm_options['activate'] == "Yes") AND ($bm_options['Music Videos_2'] == 1) AND ($bm_options['standalone'] == "Yes")) {
            echo '<div id="display_music"></div>';
            echo '<input type="button" id="driver_music" value="" />';
            echo '<input type="button" id="driver2_music" value="" />';
            echo '<input type="hidden" id="current_page_music" name="current_page_music" value="0" />';
        }
    }

    
    $content = $content . ob_get_clean();
    return $content;

}
    
// Hook in the function
add_filter('the_content', 'display_link');

// Function to handle the styling
function wptuts_styles_with_the_lot() {

    // Register the style like this for a plugin:
    wp_register_style( 'custom-style', BM_BASE_URL . 'includes/css/baeble-music-plugin.css', array(), '20120208', 'all' );
    wp_enqueue_style( 'custom-style' );
    wp_register_style( 'fancy-style', BM_BASE_URL . 'includes/css/jquery.fancybox.css', array(), '20120208', 'all' );
    wp_enqueue_style( 'fancy-style' );

}

// Hook in the function 
add_action( 'wp_enqueue_scripts', 'wptuts_styles_with_the_lot' );

