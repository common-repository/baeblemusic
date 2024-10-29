<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php

$category = $_GET["category"];
$id = $_GET["id"];
$index = $_GET["index"];

// dyanamically grab the right values.
if ($category == "Concerts"){
    $json_url = "https://www.baeblemusic.com/googletv/library5.txt?callback=?";    
    // lets get some data
    $body = file_get_contents("$json_url");
    $json = json_decode($body,true);
    // Need the title, thumbnail, description, page url, video url 
    $title = $json["$category"][$index]['title'];
    $thumbnail = $json["$category"][$index]['thumbnail'];
    $description = $json["$category"][$index]['description'];
    $page_url = $json["$category"][$index]['pageURL'];
    $mp4_url = $json["$category"][$index]['url'];
    $webm_url = str_replace(".mp4",".webm","$mp4_url");
    $videoType = $json["$category"][$index]['videoType'];
    $setlist = "https://www.baeblemusic.com/json/setlist/concert/" . $id . ".txt?callback=?";
} elseif ($category == "Interviews") {
    $json_url = "https://www.baeblemusic.com/googletv/library5.txt?callback=?";        
    $body = file_get_contents("$json_url");
    $json = json_decode($body,true);
    $title = $json["$category"][$index]['title'];
    $thumbnail = $json["$category"][$index]['thumbnail'];
    $description = $json["$category"][$index]['description'];
    $page_url = $json["$category"][$index]['pageURL'];
    $mp4_url = $json["$category"][$index]['url'];
    $webm_url = str_replace(".mp4",".webm","$mp4_url");
    $videoType = $json["$category"][$index]['videoType'];
    $setlist = "https://www.baeblemusic.com/json/setlist/interview/" . $id . ".txt?callback=?";
} elseif ($category == "Music Videos") {
    $json_url = "https://www.baeblemusic.com/googletv/library5.txt?callback=?";            
    $body = file_get_contents("$json_url");
    $json = json_decode($body,true);
    $title = $json["$category"][$index]['title'];
    $thumbnail = $json["$category"][$index]['thumbnail'];
    $description = $json["$category"][$index]['description'];
    $page_url = $json["$category"][$index]['pageURL'];
    $mp4_url = $json["$category"][$index]['url'];
    $webm_url = str_replace(".mp4",".webm","$mp4_url");
    $videoType = $json["$category"][$index]['videoType'];
    $setlist = "https://www.baeblemusic.com/json/setlist/musicvideo/" . $id . ".txt?callback=?";
} elseif ($category == "VIDEOS") {
    $json_url = "https://www.baeblemusic.com/googletv/newestVideoJSON.txt?callback=?";                
    $body = file_get_contents("$json_url");
    $json = json_decode($body,true);
    $title = $json["$category"][$index]['title'];
    $thumbnail = $json["$category"][$index]['thumbnail'];
    $description = $json["$category"][$index]['description'];
    $page_url = $json["$category"][$index]['pageURL'];
    $mp4_url = $json["$category"][$index]['url'];
    $webm_url = str_replace(".mp4",".webm","$mp4_url");
    $videoType = $json["$category"][$index]['videoType'];
    if ($videoType == "concert") {
        $setlist = "https://www.baeblemusic.com/json/setlist/concert/" . $id . ".txt?callback=?";
    } elseif ($videoType == "musicvideo") {
        $setlist = "https://www.baeblemusic.com/json/setlist/musicvideo/" . $id . ".txt?callback=?";
    } elseif ($videoType == "interview") {
        $setlist = "https://www.baeblemusic.com/json/setlist/interview/" . $id . ".txt?callback=?";
    } elseif ($videoType == "guestapt") {
        $setlist = "https://www.baeblemusic.com/json/setlist/session/" . $id . ".txt?callback=?";
    }
} elseif ($category == "Sessions") {
    $json_url = "https://www.baeblemusic.com/googletv/library5.txt";    
    $body = file_get_contents("$json_url");
    $json = json_decode($body,true);
    $title = $json["$category"][$index]['title'];
    $thumbnail = $json["$category"][$index]['thumbnail'];
    $description = $json["$category"][$index]['description'];
    $page_url = $json["$category"][$index]['pageURL'];
    $mp4_url = $json["$category"][$index]['url'];
    $webm_url = str_replace(".mp4",".webm","$mp4_url");
    $videoType = $json["$category"][$index]['videoType'];
    $setlist = "https://www.baeblemusic.com/json/setlist/session/" . $id . ".txt?callback=?";
} elseif ($category == "Overall") {
    $json_url = "https://www.baeblemusic.com/googletv/trendingJSON.txt";
    $body = file_get_contents("$json_url");
    $json = json_decode($body,true);
    $title = $json['Overall'][$index]['title'];
    $thumbnail = $json['Overall'][$index]['thumbnail'];
    $description = $json['Overall'][$index]['description'];
    $page_url = $json['Overall'][$index]['pageURL'];
    $mp4_url = $json['Overall'][$index]['url'];
    $webm_url = str_replace(".mp4",".webm","$mp4_url");
    $videoType = $json['Overall'][$index]['videoType'];
    if ($videoType == "concert") {
        $setlist = "https://www.baeblemusic.com/json/setlist/concert/" . $id . ".txt?callback=?";
    } elseif ($videoType == "musicvideo") {
        $setlist = "https://www.baeblemusic.com/json/setlist/musicvideo/" . $id . ".txt?callback=?";
    } elseif ($videoType == "interview") {
        $setlist = "https://www.baeblemusic.com/json/setlist/interview/" . $id . ".txt?callback=?";
    } elseif ($videoType == "guestapt") {
        $setlist = "https://www.baeblemusic.com/json/setlist/session/" . $id . ".txt?callback=?";
    }
}

// here are going to check for any spaces in the url pointing to our media
$mp4_url = str_replace(" ","_",$mp4_url);
$webm_url = str_replace(" ","_",$webm_url);

// here we are going to swap out and use Secure URLs
$mp4_url_secure = str_replace("http://hwcdn.net/k3r6e6e8/cds/","https://r3i7f6s2.ssl.hwcdn.net/",$mp4_url);
$webm_url_secure = str_replace("http://hwcdn.net/k3r6e6e8/cds/","https://r3i7f6s2.ssl.hwcdn.net/",$webm_url); 

// Get rid of the <br>
$title = str_replace("<br>","",$title);

?>

<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:og="http://ogp.me/ns#">
<head>
<title>Watch exclusive live music concerts and music videos on Baeblemusic.com</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="imagetoolbar" content="no" />
<meta name="MSSmartTagsPreventParsing" content="true" />
<meta name="keywords" content="Live concert, music videos, live music, music blog, music reviews, music features,  free music, rock music, indie music" />
<meta name="description" content="Watch the best live indie music concerts and music videos filmed live at the hottest music clubs around the country.   Discover the best new music acts of today and tomorrow."/>
<link rel="shortcut icon" href="https://www.baeblemusic.com/favicon.ico" type="image/x-icon" />
<meta property="fb:app_id" content="143293702457868">
<script type="text/javascript">
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-1023657-1']);
_gaq.push(['_setDomainName', 'baeblemusic.com']);
_gaq.push(['_trackPageview']);

(function() {
var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
</script>
<script type="text/javascript" src="../jwplayer/jwplayer.js" ></script>
<script type="text/javascript">jwplayer.key="raLfcPj3U9hxNqlA15yxDEG3+1H3v9UXBBCqOw==";</script>
</head>
<body>

<?php
// lets handle the incrementing
if (($videoType == "concert") OR ($videoType == "guestapt")) {
  $url = "http://www.baeblemusic.com/funcs/incrementVideoPlayCount.aspx?inVideoID=$id";    
} elseif (($videoType == "interview") OR ($videoType == "musicvideo")) {
  $url = "http://www.baeblemusic.com/funcs/incrementMusicVideoPlayCount.aspx?inMusicVideoID=$id";     
}
$ch = curl_init( $url );
curl_setopt( $ch, CURLOPT_POST, 1);
curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $ch, CURLOPT_HEADER, 0);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec( $ch );
?>


<div id="myElement">Loading the player...</div>
<script type="text/javascript">
    jwplayer("myElement").setup({
        file: "<?php echo $mp4_url_secure; ?>",
        skin: "../jwplayer/skins/bekle.xml",
        width: 778,
        height: 442,
        autostart: true,
        primary: 'flash',
        logo: {
        file: '../images/baeble_invertedlogo_color.png',
        hide: true,
        position: 'top-left',
        link: 'http://www.baeblemusic.com',
        margin: 8
        },
        abouttext: 'About Baeble Music',
        aboutlink: 'http://www.baeblemusic.com/about.aspx',
    });
</script>


<div id="fb-root"></div>
<script>(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=143293702457868";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>

<!-- Quantcast Tag -->
<script type="text/javascript"> 
  var _qevents = _qevents || [];
  (function() {
  var elem = document.createElement('script');
  elem.src = (document.location.protocol == "https:" ? "https://secure" : "http://edge") + ".quantserve.com/quant.js";
  elem.async = true;
  elem.type = "text/javascript";
  var scpt = document.getElementsByTagName('script')[0];
  scpt.parentNode.insertBefore(elem, scpt);
  })();
  _qevents.push({
  qacct:"p-dfmK3jL4qpdy-"
  });
</script>
<noscript>
<div style="display:none;">
<img src="//pixel.quantserve.com/pixel/p-dfmK3jL4qpdy-.gif" border="0" height="1" width="1" alt="Quantcast"/>
</div>
</noscript>
</body>
</html>
