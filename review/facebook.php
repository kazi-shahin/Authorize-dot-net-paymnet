<?php 
//composer require facebook/graph-sdk
require_once __DIR__ . '/vendor/autoload.php'; // change path as needed


if(isset($_SERVER['HTTPS'])){
    $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
}
else{
    $protocol = 'http';
}
$baseurl = $protocol . "://" . $_SERVER['HTTP_HOST'] .'/api/facebook.php';
// print_r($baseurl);die;
// $baseurl = $protocol . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];


$facebook = new \Facebook\Facebook([
  'app_id' => '2507551936017541',
  // 'app_id' => '149032236368734',
  'app_secret' => 'e0f95875500bd065c4807186735ec282',
  // 'app_secret' => 'a5b8880bf381f4a1009785ca97fc879e',
  'default_graph_version' => 'v2.10',
  //'default_access_token' => '{access-token}', // optional
]);

  $permissions = ['manage_pages','publish_pages','user_posts']; 
  // $permissions = ['publish_actions','manage_pages','publish_pages','user_posts','user_managed_groups']; 
// Use one of the helper classes to get a Facebook\Authentication\AccessToken entity.
  $fb = $facebook->getRedirectLoginHelper();

  if (isset($_GET['state'])) {
     $fb->getPersistentDataHandler()->set('state', $_GET['state']);
  }


if($_GET['auth-status'] == 'success' &&  $_GET['auth-from'] == 'facebook'){
	echo 'Facebook successfully!';
} 
elseif($_GET['from']=='fb'){
	try {

			$fb_tokens = array();
			$accessToken = $fb->getAccessToken();

			$oAuth2Client = $facebook->getOAuth2Client();

			$longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);

			$fb_tokens['user_token'] = (string) $longLivedAccessToken;

			$facebook->setDefaultAccessToken($longLivedAccessToken);
			$fields = "id,rating_count,created_time,cover,access_token,name,first_name,last_name,age_range,link,gender,locale,picture,timezone,updated_time,verified";

    		// $fb_user = $fb->get('/me?fields='.$fields);
    		$fb_user = $facebook->get('/me/accounts?fields='.$fields)->getGraphEdge();
    		foreach ($fb_user as  $value) { 
    			// echo '<pre>';
    			// print_r($value);
    			// echo '</pre>';
    		 
	    		$access_token = $value['access_token'];
	    		echo 'Page Name: '. $value['name'].'<br>';
	    		echo 'Page Link: '. $value['link'].'<br>';
	    		$page_id = $value['id'];
	    		$overall_star_rating = $facebook->get('/'.$page_id.'?fields=overall_star_rating,rating_count',$access_token)->getGraphNode();
	    		
	    		$fb_user_rating = $facebook->get('/'.$page_id.'/ratings?fields=created_time,rating,has_review,has_rating,recommendation_type,review_text,reviewer,open_graph_story',$access_token)->getGraphEdge();
	    		// echo '<pre>';
    			// print_r($fb_user_rating);
    			// echo '</pre>';
	    		foreach ($fb_user_rating as $rating) {
		    		
		    		$created_time = (($rating['created_time'])->format('Y-m-d H:i:s'));
	    			echo 'Create time: '. $created_time .'<br>';
	    			echo 'Rating: '. $rating['rating'].'<br>';
	    			echo 'Has Rating: '. $rating['has_rating'].'<br>';
	    			echo 'Recommendation type: '. $rating['recommendation_type'].'<br>';
	    			echo 'Has Review: '. $rating['has_review'].'<br>';
	    			echo 'Review Text: '. $rating['review_text'].'<br>';
	    			echo 'Reviewer: '. $rating['reviewer'].'<br>';
	    			echo 'Open graph story: '. $rating['open_graph_story'].'<br>';
		        	
		        	
	    		}
	    		echo 'Overall star rating: '. $overall_star_rating .'<br>';
    			
    		}

			// if (!empty($fb_tokens)) {
			// 	$fb_access_tokens = json_encode($fb_tokens);
			// 	header('Location: '.$baseurl.'?auth-status=success&auth-from=facebook');
			// }

		} catch(Facebook\Exceptions\FacebookResponseException $e) {
		  // When Graph returns an error
		  echo 'Graph returned an error: ' . $e->getMessage();
		  exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
		  // When validation fails or other local issues
		  echo 'Facebook SDK returned an error: ' . $e->getMessage();
		  exit;
		}

	// $me = $response->getGraphUser();
	// echo 'Logged in as ' . $me->getName();
}else{

	$fb_loginUrl = $fb->getLoginUrl($baseurl."?from=fb", $permissions);
	header('Location: '.$fb_loginUrl);
}