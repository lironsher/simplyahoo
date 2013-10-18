 <?php
// if(isset($_POST['zipcode']) && is_numeric($_POST['zipcode'])){
    // $zipcode = $_POST['zipcode'];
// }else{
    // $zipcode = '50644';
// }
function getAnswer($text)
{
//$zipcode = 'London';
$qury = "select * from answers.search where query='$text' and type='resolved'"; //"select * from weather.forecast where woeid in (select woeid from geo.places where text='$zipcode' and placetype='town' limit 1)";
$url = 'http://query.yahooapis.com/v1/public/yql?format=json&q='.urlencode($qury);
//$result = file_get_contents($url);

$session = curl_init($url);  
curl_setopt($session, CURLOPT_RETURNTRANSFER,true);      
$json = curl_exec($session); 


$phpObj =  json_decode($json);  

//print_r($phpObj);
$qObj = $phpObj->query->results->Question; 
// 
//print_r($qObj[0]->ChosenAnswer);
// 
// $val = $qObj->LastTradePriceOnly;
// $name = $qObj->Name; 
// 
// $answer = "Last trade price for $name is $val doller";


// 
// $city = $qObj->location->city;
// 
// $qObj = $qObj->item->forecast[1];
// $day = $qObj->day;
// $text = $qObj->text;
// $high = $qObj->high;
// 
// //
// 
// $answer = "The Forecast for $city for tomorrow is $text. Max temp $high Fahrenheit";

//echo "<br>$answer<br>";
 return $qObj[0]->ChosenAnswer; 
}

//echo getAnswer("What is Apple?");

// 
// $xml = simplexml_load_string($result);
// //echo htmlspecialchars($result, ENT_QUOTES, 'UTF-8');
// print_r($xml);
// $xml->registerXPathNamespace('yweather', 'http://xml.weather.yahoo.com/ns/rss/1.0');
// $location = $xml->channel->xpath('yweather:location');
//  
// if(!empty($location)){
    // foreach($xml->channel->item as $item){
        // $current = $item->xpath('yweather:condition');
        // $forecast = $item->xpath('yweather:forecast');
        // $current = $current[0];
        // $output = <<<END
            // <h1 style="margin-bottom: 0">Weather for {$location[0]['zipcode']}, {$location[0]['region']}</h1>
            // <small>{$current['date']}</small>
            // <h2>Current Conditions</h2>
            // <p>
            // <span style="font-size:72px; font-weight:bold;">{$current['temp']}&deg;F</span>
            // <br/>
            // <img src="http://l.yimg.com/a/i/us/we/52/{$current['code']}.gif" style="vertical-align: middle;"/>&nbsp;
            // {$current['text']}
            // </p>
            // <h2>Forecast</h2>
            // {$forecast[0]['day']} - {$forecast[0]['text']}. High: {$forecast[0]['high']} Low: {$forecast[0]['low']}
            // <br/>
            // {$forecast[1]['day']} - {$forecast[1]['text']}. High: {$forecast[1]['high']} Low: {$forecast[1]['low']}
            // </p>
// END;
    // }
// }else{
    // $output = '<h1>No results found, please try a different zip code.</h1>';
// }
?>
