<?php

    if($_GET['location']) {

     
      $jsonContent = file_get_contents('https://api.openweathermap.org/data/2.5/weather?q='. urldecode($_GET['location'])  .',&appid=d99634c19a196f0ec6f40af3d0421d13');

      $weatherArr = json_decode($jsonContent,true);

      if( $weatherArr['cod'] == 200)
      {
        $weatherNibba = 'The weather in ' . $_GET['location'] . ' is currently ' . $weatherArr['weather'][0]['description'] ;
        $temp = intval($weatherArr['main']['temp'] - 273.15);
        $weatherNibba .= ' The temperature is ' . $temp . ' &deg;C' . ' and wind speed is ' . $weatherArr['wind']['speed'] . ' meter/second.';
      }
      else {
        $weatherNibbaRed = 'Sorry! Couldn\'t find the location!';
      }

  
    }
    

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Weather Forecast</title>
    <link rel="shortcut icon" type="image/png" href="weathericon.png">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Raleway:wght@300&family=Roboto:wght@100&display=swap');
        html {
            background: url('sky.jpeg');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            height: 100%;
            opacity: 0.9;
        }
        body {
            background: none;
            color: white;
        }
        .weatherDiv {
            text-align: center;
            margin-top: 200px;
            width: 30rem;
            font-family: 'Roboto', sans-serif;
            font-family: 'Raleway', sans-serif;
        }
        .showWeather {
            margin: 1rem;
            font-family: 'Roboto', sans-serif;
            font-weight: bold;
        }

        .cloud {
          position: absolute;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          background: url('cloud.png');
          animation: blow 60s linear infinite;
          opacity: 0.5;
          z-index: -1;
        }

        @keyframes blow {
          0% {
            background-position: 0px;
          }
          100% {
            background-position: -5440px;
          }
        }

        .weatherForm {
          text-shadow: 0px 2px 5px black;
          z-index: 9999;
        }

    </style>
  </head>
  <body>
    <div class="container weatherDiv">
        <div class="cloud"></div>

        <div class="weatherInfo">
            <h2>What's the weather?</h2>
            <form class="weatherForm">
                <div class="form-group">
                <label for="exampleInputEmail1">Enter the name of the city!</label>
                <input type="text" name="location" class="form-control" id="location" placeholder="Ex. London">
                <small id="popup" class="form-text text-light">Find out about the weather of your area!</small>
                </div>
                <button type="submit" class="btn btn-warning">Submit</button>
            </form>

         
            <div class="showWeather"> 
              <?php
              if($weatherNibba) {
                echo '<div class="alert alert-info" role="alert">' . $weatherNibba .  '</div>';

              }
              else if ($weatherNibbaRed) {
                echo '<div class="alert alert-danger" role="alert">' . $weatherNibbaRed .  '</div>';
              }
            ?>
            </div>
        </div>  

    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script> -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>