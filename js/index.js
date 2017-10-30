function showDiv(elem){
    switch (elem.value) {
        case "defaultArray":
            document.getElementById('randomArray').style.display = "none";
            document.getElementById('keyboardInput').style.display = "none";
            document.getElementById('jsonFile').style.display = "none";

            break;
        case "randomArray":
            document.getElementById('randomArray').style.display = "block";
            document.getElementById('keyboardInput').style.display = "none";
            document.getElementById('jsonFile').style.display = "none";

            break;
        case "keyboardInput":
            document.getElementById('keyboardInput').style.display = "block";
            document.getElementById('randomArray').style.display = "none";
            document.getElementById('jsonFile').style.display = "none";

            break;
        case "jsonFile":
            document.getElementById('randomArray').style.display = "none";
            document.getElementById('keyboardInput').style.display = "none";
            document.getElementById('inputJson').style.display = "block";
            break;
        default:

    }
}
