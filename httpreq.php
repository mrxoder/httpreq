<?php


class httpreq{
     
     public function __construct($url){
		 $this->url = $url;
	 }
	 
     public function send($param=[], $method='GET', $header=[]){
		    
		    $header = $this->header_encode($header);
		    
			$post = http_build_query($param);
			$opt = array( 'http' => array (
			 'method' => $method, 'header' => $header,
			 'content' => $post ));
			
			$context = stream_context_create($opt);
			try{
				$result = file_get_contents($this->url, false, $context);
			}catch(Exception $e){
				return false;
			}
			
			$resheader = $this->header_decode($http_response_header);
			return ["content"=>$result, "header"=>$resheader];
	 }
	 
	 public function header_decode($header){
		    
		    $res = [];
		    
		    $http = explode(" ", $header[0]);
		    $res["code"] = (integer)$http[1];
		    
		    for($i=1;$i<count($header);$i++){
				
				$item = explode(": ", $header[$i]);
				if(isset($res[$item[0]])){
					if(is_array($res[$item[0]])){
						array_push( $res[$item[0]], implode(": ", array_slice($item, 1)) );
						
					}else{
						$res[$item[0]] = [ $res[$item[0]], implode(": ", array_slice($item, 1)) ];
					}
				}else{
					 $res[$item[0]] = implode(": ", array_slice($item, 1));
				}
			}
			
			return $res;
	 }
	 
	 function header_encode($header){
		    $retval = "";
		    foreach($header as $key => $values){
				if(is_array($values)){
					$retval .= "{$key}: ";
					foreach($values as $value){
						$retval .= "{$value}; ";
					}
					$retval .= "\r\n"; 
				}else{
					$retval .= "{$key}: {$values}\r\n";
				}
			}
			return trim($retval);
	 }
	 
}


?>
