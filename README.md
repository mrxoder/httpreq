# httpreq
Simple PHP library used to send Http 'GET' and 'POST' requests


  ```php
      
      require("httpreq.php");
      
      $url = "http://example.com/page.php";
	  $req = new httpreq($url);
	  $res = $req->send(["name"=>"value", "name1"=>"value1"], "POST", ['Content-Type'=>'application/x-www-form-urlencoded', 'Cookie'=>['cookie0=cookie1','cookie1=cookie1']]);
	  
	  echo($res["content"]);
	  var_dump($res["header"]);
	  
	  
````  
	  
	
