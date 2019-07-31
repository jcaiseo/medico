           	<?php
           	$buscar = 'Vicuña Mackenna 10777, La Florida';

      			$json_string = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($buscar).'&key=AIzaSyAZvxb5BAGPyDnBg5uaoB-U3y0se0KeAqo');
      			$parsed_json = json_decode($json_string, true);

      			print_r($parsed_json);


      			echo $lat = $parsed_json['results']['0']['geometry']['location']['lat'];
      			echo $lng = $parsed_json['results']['0']['geometry']['location']['lng'];
            
      			?>