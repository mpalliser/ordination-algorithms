
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>

        <?php

        function generateRandomArray($length) {
            if ($length <= 1) {

                return "Please, if you chose 'Generate Random Array' you need to introduce the array's length";
            }
            //generate an array of random length
            $array = range(0,$length);

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

         <form id="form" action="" method="post">
             <div id="ordinationType">
                 <b>Select what type of ordination do you want to use</b>
                 <br>
                 <label><input class="radio" type="radio" name="type" value="bubble">Bubble</label>
                 <br>
                 <label><input class="radio" type="radio" name="type" value="directSelection">Direct selection</label>
                 <br>
                 <label><input class="radio" type="radio" name="type" value="quickShort">Quick short</label>
                 <br>
             </div>
             <div id="arrayType">
                 <b>Select how to input the array</b><br>
                 <select name="inputArray">
                     <option value="defaultArray">Default Array</option>
                     <option value="randomArray">Generate Random Array</option>
                     <option value="keyboardInput">Input array via keyboard</option>
                 </select>
                 <div id="arrayLenght">
                     <label id="arrayLength">Insert the array's length if you select random:<input type="text" name="arrayLength"></label>
                 </div>
             </div>

             <input id="submit" type="submit" name="" value="Submit">

         </form>


            <?php

            if (isset($_POST["type"]) && isset($_POST["inputArray"])) {

                    $ordinationAlgorithm = $_POST["type"];
                    $arrayType = typeOfInputArray();
                    if (is_array($arrayType)) {
                        echo implode("----", $arrayType). "<br>";
                        echo implode("----", algoritmSelection($ordinationAlgorithm, $arrayType));
                    } else {
                        echo $arrayType;
                    }
            }

            function typeOfInputArray(){

                $defaultArray = array(49,24,36,80,31);

                switch ($_POST["inputArray"]) {
                    case "randomArray":
                        return generateRandomArray($_POST["arrayLength"]-1);
                        break;
                    case "defaultArray":
                        return $defaultArray;
                        break;
                    default:
                        # code...
                        break;
                }
            }

            function algoritmSelection($ordinationAlgorithm, $arrayType){
                switch ($ordinationAlgorithm) {
                    case "bubble":
                    return bubble($arrayType);

                    case "directSelection":
                    return directSelection($arrayType);

                    case "quickShort":
                    return quickShort($arrayType);

                    default:
                    echo "selecciona una opcion";
                }
            }

              ?>
         </div>
    </body>
</html>
