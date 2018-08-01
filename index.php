<?php

class findme{

  public function showresult($filename){
      if(file_exists($filename)){
            $content = file($filename);
            $to_arr = implode(" ",$content);
            $array = explode(" ", $to_arr);
            $uniq = array_unique($array);
            $uniq_count = count($uniq);

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "assignment";
            $conn = new mysqli($servername, $username, $password, $dbname);
            if($conn->connect_error){
              die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM watchlist WHERE name IN('".implode("','",$uniq)."')";
            $result = $conn->query($sql);
            echo "Distinct unique words:".$uniq_count. "\n";
            echo "Watchlist Words: \n";

            if ($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    echo $row['name']."\n";
                }
            }
      }
      else{
        echo "File not found.";
      }
  }//showresult Function END.

}//findme Class END.

if(isset($argv[1])){
  $class = new findme();
  $class->showresult($argv[1]);
}
else{
  echo "enter file name please";
}



?>
