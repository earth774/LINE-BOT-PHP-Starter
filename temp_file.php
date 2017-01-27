<?php
	function avg($url){
					
			// Get POST body content
			$content = file_get_contents($url);
			// Parse JSON
			$obj = json_decode($content, true);

			// echo $obj['city']['name']." , ";
			// echo $obj['city']['country'];
			// echo count($obj['list']);
			$data = array(
					"max"=>0,
					"min"=>0,
					"mid"=>0
				);
			
			for ($i=0; $i <count($obj['list']) ; $i++) {  // calculate avg temp

				if($data['max']<$obj['list'][$i]['main']['temp_max']){ // find max
					$data['max']=$obj['list'][$i]['main']['temp_max'];
				}
				if($data['min']>$obj['list'][$i]['main']['temp_min']){ // find min
					$data['min']=$obj['list'][$i]['main']['temp_min'];
				}
				$data['mid']+=$obj['list'][$i]['main']['temp_max'];
			}
				$data['mid']=$data['mid']/count($obj['list']);


			$str = "เมือง ".$obj['city']['name']."􀂲".
			" อุณหภูมิสูงสุด (temperature_max) : ".round(($data['max']-273.15),2). //show temp max
			"℃ อุณหภูมิต่ำสุด (temperature_min) : ".round(($data['min']-273.15),2). // show temp min
			"℃ อุณหภูมิเฉลี่ย (temperature_avg) : ".round(($data['mid']-273.15),2)."℃";
			return $str;  // return data sent to bot.php
	}		
?>
