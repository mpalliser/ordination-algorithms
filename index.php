<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div id="buble">
            <?php

            function randomArray() {
                //generate an array of random length
                $array = range(0,rand(1,10));

                //Put a random number for each position
                for ($a=0; $a < count($array); $a++) {
                    $array[$a] = rand(1,50);
                }
                return $array;
            }
            $randomArray = randomArray();

            //Print the array content
            echo "<h2> BURBUJA </h2>";
            echo "<p class='desordenado'>Longitud/contenido aleatorio en el rango(1,10)</p>" ;
            print_r($randomArray);
            echo "<br>";

            //Organize the content
            for ($j=1; $j < count($randomArray); $j++){
                for ($i=0; $i < count($randomArray)-1; $i++) {
                    if ($randomArray[$i] > $randomArray[$i+1]) {

                        $flag = $randomArray[$i];
                        $randomArray[$i] = $randomArray[$i+1];
                        $randomArray[$i+1] = $flag;
                    }
                }
            }

            //Print the content
            echo "<p class='ordenado'>Contenido ordenado</p>";
            print_r($randomArray);

            echo "<hr><h2> Seleccion directa</h2>
                <p class='desordenado'>Longitud/contenido aleatorio en el rango(1,10)</p>";

            //re-do the random array and print it
            $randomArray = randomArray();
            print_r($randomArray);

            //Organize the content with the ordered content method
            for ($i=0; $i < count($randomArray); $i++){
                for ($j= $i+1; $j < count($randomArray); $j++){
                    if ($randomArray[$i] > $randomArray[$j]) {

                        $flag = $randomArray[$i];
                        $randomArray[$i] = $randomArray[$j];
                        $randomArray[$j] = $flag;
                    }
                }
            }

            //Print the content
            echo "<p class='ordenado'> Contenido ordenado </p>";
            print_r($randomArray);

            //QuickShort
            echo "<hr><h2> Quick Short</h2>
            <p class='desordenado'>Array desordenada</p>";
            //$quickShortArray = array(49,24,36,80,31);
            $quickShortArray = randomArray();
            print_r($quickShortArray);

            //Print the content
            echo "<p class='ordenado'>Contenido ordenado</p>";
            $newArray = quickShort($quickShortArray);
            print_r($newArray);

            function quickShort($inputArray){

                if (count($inputArray) <= 1) {
                    return $inputArray;
                }
                $menores = array();
                $mayores = array();
                $pivote = $inputArray[0];

                foreach ($inputArray as $value) {
                    if ($pivote > $value) {
                        array_push($menores, $value);
                    } elseif ($pivote < $value) {
                        array_push($mayores, $value);
                    }
                }

                return array_merge(quickShort($menores), (array)$pivote, quickShort($mayores));

            }
             ?>
        </div>
    </body>
</html>
