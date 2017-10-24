<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>

        <?php

        function generateRandomArray() {

            //generate an array of random length
            $array = range(0,rand(1,10));

            //Put a random number for each position
            for ($a=0; $a < count($array); $a++) {
                $array[$a] = rand(1,50);
            }

            return $array;
        }

        function bubble($array) {

            for ($j=0; $j < count($array); $j++){
                for ($i=0; $i < count($array)-1; $i++) {
                    if ($array[$i] > $array[$i+1]) {

                        $flag = $array[$i];
                        $array[$i] = $array[$i+1];
                        $array[$i+1] = $flag;
                    }
                }
            }

            return $array;

        }

        function directSelection($array) {

            for ($i=0; $i < count($array); $i++){
                for ($j= $i+1; $j < count($array); $j++){
                    if ($array[$i] > $array[$j]) {

                        $flag = $array[$i];
                        $array[$i] = $array[$j];
                        $array[$j] = $flag;
                    }
                }
            }

            return $array;
        }

        function quickShort($array){

            if (count($array) < 2) {
                return $array;
            }

            $menores = $mayores = array();
            $pivote = $array[0];

            for ($i=1; $i < count($array); $i++) {
                if ($pivote >= $array[$i]) {

                    $menores[] = $array[$i];

                } else {

                    $mayores[] = $array[$i];
                }
            }

            return array_merge(
                quickShort($menores),(array)$pivote,quickShort($mayores));
        }

        // echo implode("----",bubble(generateRandomArray()));
        // echo "<br>";
        // echo implode("----",directSelection(generateRandomArray()));
        // echo "<br>";
        // echo implode("----",quickShort(generateRandomArray()));

         ?>

         <form class="" action="" method="post">
             <div id="type">
                 <b>Selecciona el tipo de ordenacion</b> <br>
                 <input class="radio" type="radio" name="type" value="bubble"> Bubble </input>
                 <input class="radio" type="radio" name="type" value="directSelection"> Direct selection </input>
                 <input class="radio" type="radio" name="type" value="quickShort"> Quick short </input>
                 <input class="radio" type="submit" name="" value="Submit">
             </div>
         </form>


            <?php

            $ordinationAlgorithm = $_POST["type"];

            switch ($ordinationAlgorithm) {
                case "bubble":
                    echo "bubble selected";
                    break;
                case "directSelection":
                    echo "directSelection selected";
                    break;
                case "quickShort":
                    echo "quickShort selected";
                    break;
                default:
                    echo "selecciona una opcion";
            }
              ?>
         </div>
    </body>
</html>
