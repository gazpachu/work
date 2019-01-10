<?php
ini_set('display_errors', 1);
require_once('TwitterAPIExchange.php');

if( isset($_GET['id']))
{
    /** Set access tokens here - see: https://dev.twitter.com/apps/ **/
    $settings = array(
        'oauth_access_token' => "17834376-AJhJLJ6TtGKDhOuz7sBoGVfuVgsast0p6795femHj",
        'oauth_access_token_secret' => "8irJyYMA2toql2GRjV7vYwsubOUmybvf3OAHbyiW4E1ac",
        'consumer_key' => "obNvJaKD6m74AV41tPqn9amxK",
        'consumer_secret' => "Hua1fzyGahp9iRdaYv7rehJmuM8rYs8NEMklxoOdg7Qnqifj2G"
    );

    /** Perform a GET request and echo the response **/
    /** Note: Set the GET field BEFORE calling buildOauth(); **/
    $twitterId = htmlentities($_GET['id']);
    $url = 'https://api.twitter.com/1.1/search/tweets.json';
    $getfield = '?q='. $twitterId;
    $requestMethod = 'GET';
    $twitter = new TwitterAPIExchange($settings);
    $json = $twitter->setGetfield($getfield)
                 ->buildOauth($url, $requestMethod)
                 ->performRequest();

    $tweets = json_decode($json);
    $data_string = "{\"data\": [";

    if( $tweets )
    {
        foreach( $tweets->statuses as $tweet ) {
            //print_r($tweet);
            $data_string .= "{\"text\": \"" . utf8_decode(htmlentities($tweet->text, ENT_QUOTES)) . "\"}, ";
        }
    }

    $data_string = substr($data_string ,0,-2);
    $data_string .= "]}";
    
    //echo $data_string;

    // Check sentiments 
    $ch = curl_init('http://www.sentiment140.com/api/bulkClassifyJson?appid=joanmira@gmail.com');                                                                      
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',                                                                                
        'Content-Length: ' . strlen($data_string))                                                                       
    );                                                                                                                   

    $result = curl_exec($ch);
    
    $sentiments = json_decode($result,true);

    for( $i = 0; $i < count($sentiments["data"]); $i++ )
    {
        $sentiments["data"][$i]["date"] = $tweets->statuses[$i]->created_at;
    }

    header('Content-type: application/json');

    echo json_encode($sentiments);
}
else
{
    echo "please use the querystring: ?id=@twitterid";
}

?>