
<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <title>Ordination Algorithms Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/index.js">

    </script>
</head>
<body>

    <?php

    /**
    * Generate an array of random numbers from the introduced length
    *
    * @param integer $length
    *
    * @return array $array
    */
    function generateRandomArray($length) {

        if ($length <= 1) {

            return "<b class='alert alert-warning'>Please, if you chose Random
            Option, you have to introduce an array length superior than one.</b>";
        }

        $array = range(0,$length-1);
        $arrayLength = count($array);

        for ($a=0; $a < $arrayLength; $a++) {
            $array[$a] = rand(1,50);
        }

        return $array;
    }

    /**
    * Sort the introduced array using the bubble algorithm
    *
    * @param array $array
    *
    * @return array $array
    */
    function bubble($array) {

        $arrayLength = count($array);

        for ($j=0; $j < $arrayLength; $j++){
            for ($i=0; $i < $arrayLength-1; $i++) {
                if ($array[$i] > $array[$i+1]) {

                    $flag = $array[$i];
                    $array[$i] = $array[$i+1];
                    $array[$i+1] = $flag;
                }
            }
        }

        return $array;
    }

    /**
    * Sort the introduced array using the direct selection algorithm
    *
    * @param array $array
    *
    * @return array $array
    */
    function directSelection($array) {

        $arrayLength = count($array);

        for ($i=0; $i < $arrayLength; $i++){
            for ($j= $i+1; $j < $arrayLength; $j++){
                if ($array[$i] > $array[$j]) {

                    $flag = $array[$i];
                    $array[$i] = $array[$j];
                    $array[$j] = $flag;
                }
            }
        }

        return $array;
    }

    /**
    * Sort the introduced array using the quick short algorithm
    *
    * @param array $array
    *
    * @return array $array
    */
    function quickShort($array){

        if (count($array) < 2) {
            return $array;
        }

        $arrayLength = count($array);
        $menores = $mayores = array();
        $pivote = $array[0];

        for ($i=1; $i < $arrayLength; $i++) {
            if ($pivote >= $array[$i]) {

                $menores[] = $array[$i];

            } else {

                $mayores[] = $array[$i];
            }
        }

        return array_merge(
            quickShort($menores),(array)$pivote,quickShort($mayores));
    }

    /**
    * Depending of the selected array on the form, return the
    * default array, random array or keyboard introduced array.
    *
    * @return array $array
    */
    function selectedArray(){

        switch ($_POST["inputArray"]) {

            case "randomArray":
            return generateRandomArray($_POST["arrayLength"]);
            break;

            case "defaultArray":
            return array(49,24,36,80,31);
            break;

            case "keyboardInput";
            return processKeyboardArray();
            break;

            case "jsonFile";
            return processJsonFile();
            break;

            default:
            return "<b class='alert alert-warning'>Please, fill all the form options</b>";
            break;
        }
    }

    /**
    * Receive the algorithm to use and the disordered array and sorts the
    * array with this algorithm
    *
    * @param array $ordinationAlgorithm
    *
    * @param array $disorderedArray
    *
    * @return array $array
    */
    function algoritmSelection($ordinationAlgorithm, $disorderedArray){

        switch ($ordinationAlgorithm) {
            case "bubble":
            return bubble($disorderedArray);

            case "directSelection":
            return directSelection($disorderedArray);

            case "quickShort":
            return quickShort($disorderedArray);

            default:
            echo "selecciona una opcion";
        }
    }

    /**
    * catch the string inserted via keyboard and split it per comas or spaces
    * and return array
    *
    * @return array $array
    */
    function processKeyboardArray() {

        $array = $_POST["keyboardInputArray"];

        return preg_split("/[\s,]+/", $array);
    }

    /**
     * Catch the json selected by the user in the form and convert it to
     * an array and return it
     *
     * @return array $jsonArray
     */
    function processJsonFile() {

        $jsonFile = file_get_contents($_FILES["file"]["tmp_name"]);
        $jsonArray = json_decode($jsonFile, true);

        return $jsonArray;
    }

    ?>
    <div class="container">

        <h2>Ordination Algorithms</h2>

        <form class="form-inline" action="" method="post" enctype="multipart/form-data">
            <hr>

            <div id="ordinationType" class="form-group">
                <b>Select what type of ordination do you want to use:</b>

                <div class="form-check radio">
                    <label class="form-check-label">
                        <input class="form-check-input" name="type" type="radio" value="bubble">
                        Bubble
                    </label>
                </div>

                <div class="form-check radio">
                    <label class="form-check-label">
                        <input class="form-check-input" name="type" type="radio" value="directSelection">
                        Direct selection
                    </label>
                </div>

                <div class="form-check radio">
                    <label class="form-check-label">
                        <input class="form-check-input" name="type" type="radio" value="quickShort">
                        Quick short
                    </label>
                </div>
            </div>
            <hr>

            <div  class="form-group">
                <b>Select how to input the array</b>

                <select id="arrayType" class="form-control" name="inputArray" onchange="showDiv(this)">
                    <option>...</option>
                    <option value="defaultArray">Use a default array</option>
                    <option value="randomArray">Generate array of random numbers</option>
                    <option value="keyboardInput">Input array via keyboard</option>
                    <option value="jsonFile">Input array via JSON file</option>
                </select>
                &emsp;&emsp;
            </div>

            <div class="form-group">

                <label id="randomArray" class="alert alert-info">Insert the array's length
                    <input class="form-control" type="text" name="arrayLength">
                </label>

                <label id="keyboardInput" class="alert alert-info">Introduce the array numbers
                    <input class="form-control" type="text" name="keyboardInputArray">Example(1,2,3 or 1 2 3)
                </label>

                <label id="inputJson" class="alert alert-info"><h4>Introduce a json file</h4>
                    <input class="form-check-input" type="file" name="file" />
                </label>
            </div>
            <hr>

            <input  id="button" class="btn btn-success btn-block" type="submit" value="Submit">
            <hr>

            <?php

            if (isset($_POST["type"]) && isset($_POST["inputArray"])) {

                $inputArray = $_POST["inputArray"];
                $ordinationAlgorithm = $_POST["type"];
                $disorderedArray = selectedArray();

                if (is_array($disorderedArray)) {

                    echo "<b>Not sorted: </b>" . implode(" - ", $disorderedArray). "<br><hr>";

                    echo "<b>Sorted array: </b>" . implode(" - ", algoritmSelection(
                        $ordinationAlgorithm, $disorderedArray)) . "<hr>";

                    } else {
                        echo $disorderedArray;
                    }
                }else {
                    echo "<b class='alert alert-warning'>Please, fill all the form options</b>";
                }
                ?>
        </form>

    <div class="navbar navbar-default navbar-fixed-bottom">
        <div class="container">
            <i>&copy; Copyright by Mariano Palliser Muñoz</i>
        </div>
    </div>
    </div>
</body>
</html>
