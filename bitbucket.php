<?php
#password
$pwd=$_GET['pwd'];

if($pwd=='2VOYKTWL14FBNC3ZJIMRA6850GSXHEDQU9P7'){
	$token=$_GET['token'];
}
$content = file_get_contents("php://input");
$content = object_array(json_decode($content));
$url  = "https://oapi.dingtalk.com/robot/send?access_token=".$token;

$username = $content["actor"]["username"];
$userimg = $content["actor"]["links"]["avatar"]["href"];
$project_name = $content["repository"]["name"];

#if push or issue
if(array_key_exists("push",$content))
{
	$push_content = $content["push"]["changes"][0]["commits"][0]["message"];
	$push_author = $content["push"]["changes"][0]["commits"][0]["author"]["raw"];
	$push_title = "[Update]".$project_name;
	$push_url = $content["push"]["changes"][0]["commits"][0]["links"]["html"];
	$link=array("text"=>$push_content,"picUrl"=>$userimg,"title"=>$push_title."-".$push_author,"messageUrl"=>$push_url);
}else if(array_key_exists("issue",$content))
{
	$issue_content = $content["issue"]["content"]["raw"];
	$issue_title = "[Issue]".$project_name."-".$content["issue"]["title"];
	$issue_url = $content["issue"]["links"]["html"]["href"];
	$link=array("text"=>$issue_content,"picUrl"=>$userimg,"title"=>$issue_title,"messageUrl"=>$issue_url);
}

$data = json_encode(array('msgtype'=>'link', 'link'=>$link));
request_by_curl($url,$data);

function object_array($array) {  
    if(is_object($array)) {  
        $array = (array)$array;  
     } if(is_array($array)) {  
         foreach($array as $key=>$value) {  
             $array[$key] = object_array($value);  
             }  
     }  
     return $array;  
}

function request_by_curl($remote_server, $post_string) {  
    $ch = curl_init();  
    curl_setopt($ch, CURLOPT_URL, $remote_server);
    curl_setopt($ch, CURLOPT_POST, 1); 
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, array ('Content-Type: application/json;charset=utf-8'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,FALSE);
    $data = curl_exec($ch);
    curl_close($ch); 
    return $data;  
}

?>