<?php
/**
 * @package Yahoo Answer
 * @author The HungryCoder
 * @link http://hungrycoder.xenexbd.com/?p=953
 * @version 1.0
 * @license GPL, This class does not come with any expressed or implied warranties! Use at your own risks!  
 */

class yahooAnswer{
    var $appID;
    var $searchQuestionURL = 'http://answers.yahooapis.com/AnswersService/V1/questionSearch?';
    var $getQuestionURL = 'http://answers.yahooapis.com/AnswersService/V1/getQuestion?';

    private $numResults = 10;
    private $numStart = 0;
    
    function  __construct($appid) {
        
        $this->appID=$appid;
    }

    function set_numResults($num_results){
        $this->numResults = $num_results;
    }

    /**
     * Search for questions for the given keywords. Returned results can be associative array or XML
     * @param <string> $kewyord
     * @return <string> Returns the results set either in XML format or associative array. 
     */

    function search_questions($params){
        if(!is_array($params)){
            throw new Exception('The parameters must be an array!');
        }
        $defaults = array(
            'search_in'     =>  '',
            'category_name' =>  '',
            'date_range'    =>  '', //7, 7-30, 30-60, 60-90, more90
            'sort'          =>  'relevance', //relevance, date_desc, date_asc
            'type'          =>  'all',
            'output'        =>  'php',
            'results'       =>  $this->numResults,
            'start'         =>  $this->numStart,
            'region'        =>  'us',
            'appid'         =>  $this->appID,
        );
        $params = array_merge($defaults,$params);

        if(!$params['appid']){
            throw new Exception('APP ID is empty!', 404);
        }
        if(!$params['query']) {
            throw new Exception('Query is not set!', '404');
        }
       
        $req_params = $this->array2query_string($params);

        $url = $this->searchQuestionURL.$req_params;
        $results = $this->make_call($url);
        if($params['output']=='php'){
            $results = unserialize($results);
            return $results['Questions'];
        }
        return $results;
                    
    }


    /**
     * Get all answers of a given question ID
     * @param <array> $params keys are: question_id, output, appid
     * @return <string> Returns all answers in expected format. default format is php array
     */

    function get_question($params){
        
         if(!is_array($params)){
            throw new Exception('The parameter must be an array!');
        }
        $defaults = array(
            'question_id'   =>  '',
            'output'        =>  'php',
            'appid'         =>  $this->appID,
        );
        $params = array_merge($defaults,$params);

        
        
        if(!$params['appid']){
            throw new Exception('APP ID is empty!', 404);
        }
        if(!$params['question_id']) {
            throw new Exception('Question ID is not set!', '404');
        }


        $req_params = $this->array2query_string($params);


        $url = $this->getQuestionURL.$req_params;
        $results = $this->make_call($url);
        if($params['output']=='php'){
            $results = unserialize($results);
            return $results['Questions'][0];
        }
        return $results;
    }

        

    protected function make_call($url){
        if(function_exists('curl_init')){
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
            curl_setopt($ch, CURLOPT_TIMEOUT,60);

            $result = curl_exec($ch);
            curl_close($ch);
            return $result;
        } else if(function_exists('file_get_contents')) {
            return file_get_contents($url);
        } else {
            throw new Exception('No method available to contact remote server! We must need cURL or file_get_contents()!', '500');
        }
    }

    protected  function array2query_string($array){
        if(!is_array($array)) throw new Exception('Parameter must be an array', '500');
        $params ='';
        foreach($array as $key=>$val){
            $params .= "$key=$val&";
        }
        return $params;
    }
}
/*

$appid = '';
$params = array(
    'query'     =>      'keyword',   //enter your keyword here. this will be searched on yahoo answer
    'results'   =>      10,         //number of questions it should return
    'type'      =>      'resolved',  //only resolved questiosn will be returned. other values can be all, open, undecided
    'output'    =>      'php',      //result will be PHP array. Other values can be xml, json, rss
);
$query  = 'yoga'; //enter your keyword here to search for
$yn = new yahooAnswer($appid);
//search questions
try{
    $questions = $yn->search_questions($params);
} catch (Exception $e){
    echo ($e->getMessage());
}


foreach ($questions as $question) {
    //now get the answers for the question_id;
    try{
        $answers = $yn->get_question(array('question_id'=>$question_id));
        echo '<pre>';
        print_r($answers);
        echo '<pre>';
    } catch (Exception $e){
        echo($e->getMessage());
    }

}

*/