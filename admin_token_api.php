<?php
public function createDailyApiTokenAdmin($apiData){

   //get the meeting name

   //create token api

   // return the token link

   // generate the link to the db

   //print_r($apiData);

   $returnData = [];

   $roomName =str_replace(' ' , '', trim( $apiData['name']));

   $user_id = 1;

   $user_name = 'admin';

   $jsonData = [

       'properties'=>[

       'is_owner' => true,

       'close_tab_on_exit' => false,

       'user_name' => $user_name,

       'user_id' => $user_id,

       'room_name' => $roomName

   ]
      
 ];

   $dataString = json_encode($jsonData);

   $url = "https://api.daily.co/v1/meeting-tokens";

   $chkRoom = $this->getRoomDetailsDaily($roomName);

  //print_r($chkRoom); die;

   if($chkRoom['error']){

       return false;       

   }

   else{

       $response =  $this->sendCurlPost($url,$dataString,'POST');

       $tokenUrl = $chkRoom['url'].'?t='.$response['token'];

       $returnData = ['join_url'=>$tokenUrl,'registrant_id'=>$chkRoom['id'],'code'=>'201'];

       return $returnData;

   }

  

}

public function getRoomDetailsDaily($roomName){
	    $url = "https://api.daily.co/v1/rooms/".$roomName;
	    return $this->sendCurlPost($url,'','GET');
	}

// Response from the API with link
//https://cmproject.daily.co/eventactiontest?t=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJvIjp0cnVlLCJjdG9lIjpmYWxzZSwidSI6ImFkbWluIiwidWQiOjEsInIiOiJldmVudGFjdGlvbnRlc3QiLCJkIjoiNzcxMjM1ZTktODkwMi00MjYwLTk2ZTctZTVjNTVkYTQxODEwIiwiaWF0IjoxNjIzOTM1MjEzfQ.v_C9jg
