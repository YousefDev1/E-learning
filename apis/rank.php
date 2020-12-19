<?php

    class API{

        function selectdata(){

            include "../conn.php";
            $data = array();
            $getData = mysqli_query($db_conn, "SELECT * FROM users ORDER BY rank DESC");
            
            $data = array('count' => mysqli_num_rows($getData));
            while($fetcth = mysqli_fetch_array($getData))
            {
                $data[] = array(
                    'rank'    => $fetcth['rank'],
                    'f_name'  => $fetcth['f_name'],
                    'l_name'  => $fetcth['l_name'],
                    'avatar'  => $fetcth['avatar']
                        
                );
            }
            
            return json_encode($data);
        }

    }

    $API = new API;
    header('Content-Type: application/json');
    echo($API->selectdata());

?>