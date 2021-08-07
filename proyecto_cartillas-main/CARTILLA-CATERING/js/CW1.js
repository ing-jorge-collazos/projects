var currentTextInput;
var puzzelArrayData;

function initializeScreen() {
        var puzzelTable = document.getElementById("puzzel");
        puzzelArrayData = preparePuzzelArray();
        for (var i = 0; i < puzzelArrayData.length; i++) {
                var row = puzzelTable.insertRow(-1);
                var rowData = puzzelArrayData[i];
                for (var j = 0; j < rowData.length; j++) {
                        var cell = row.insertCell(-1);
                        if (rowData[j] != 0) {
                                var txtID = String("txt"  + i +  j);
                                cell.innerHTML =
                                        '<input type="text" class="inputBox" maxlength="1" style="text-transform: lowercase" ' +
                                        'id="' +
                                        txtID +
                                        '" onfocus="textInputFocus(' +
                                        "'" +
                                        txtID +
                                        "'" +
                                        ')">';
                        } else {
                                cell.style.backgroundColor = "white";
                        }
                }
        }
        addHint();
}

function addHint() {
        document.getElementById("txt41").placeholder = "1/10";	
        
        document.getElementById("txt80").placeholder = "2";
        
        document.getElementById("txt04").placeholder = "3";
        
        document.getElementById("txt75").placeholder = "4";
        
        document.getElementById("txt08").placeholder = "5";
        
        document.getElementById("txt58").placeholder = "6";
        
        document.getElementById("txt410").placeholder = "7";
        
        document.getElementById("txt515").placeholder = "8";
        
        document.getElementById("txt18").placeholder = "9";
        
}

let matched = 0;
const allWords = 52;


function textInputFocus(txt) {
        currentTextInput = txt;
}

function preparePuzzelArray() {
        var items = [
                [0, 0, 0, 0, "b", 0, 0, 0, "j", 0, 0, 0, 0, 0, 0, 0],
                [0, 0, 0, 0, "a", 0, 0, 0, "a", "r", "m", "s", 0, 0, 0, 0],
                [0, 0, 0, 0, "n", 0, 0, 0, "c", 0, 0, 0, 0, 0, 0, 0],
                [0, 0, 0, 0, "d", 0, 0, 0, "k", 0, 0, 0, 0, 0, 0, 0],
                [0, "t", "r", "i", "a", "n", "g", "l", "e", 0, "c", 0, 0, 0, 0, 0],
                [0, "o", 0, 0, "n", 0, 0, 0, "t", "r", "o", "u", "s", "e", "r", "s"],
                [0, "r", 0, 0, "a", 0, 0, 0, 0, 0, "t", 0, 0, 0, 0, "o"],
                [0, "c", 0, 0, 0, "j", "a", "c", "k", "e", "t", 0, 0, 0, 0, "l"],
                ["s", "h", "o", "e", "s", 0, 0, 0, 0, 0, "o", 0, 0, 0, 0, "e"],
                [0, "o", 0, 0, 0, 0, 0, 0, 0, 0, "n", 0, 0, 0, 0, 0],
                [0, "n", 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        ];
        return items;
}

function clearAllClicked() {
        currentTextInput = "";
        var puzzelTable = document.getElementById("puzzel");
        puzzelTable.innerHTML = "";
        initializeScreen();
}

function checkClicked() {
        matched=0;
        for (var i = 0; i < puzzelArrayData.length; i++) {
                var rowData = puzzelArrayData[i];
                for (var j = 0; j < rowData.length; j++) {
                        if (rowData[j] != 0) {
                                var selectedInputTextElement = document.getElementById(
                                        "txt"  + i +  j
                                );
                                if (
                                        selectedInputTextElement.value !=
                                        puzzelArrayData[i][j]
                                ) {
                                        selectedInputTextElement.style.backgroundColor =
                                                "#BA1414";
                                } else {
                                        selectedInputTextElement.style.backgroundColor =
                                                "#bcd4ec";
                                                matched++;
                                }
                        }
                }
        }
        setTimeout(function () {
                alertPos();
        }, 500);
}


function alertPos() {
        if (matched === allWords) {
                const checkClick = document.getElementById("checkClick");
                checkClick.setAttribute("data-target","#wingame");
                checkClick.click();
                matched++;
                checkClick.setAttribute("data-target","#wingame1");
        }
}

function clueClicked() {
        if (currentTextInput != null) {
                var temp1 = currentTextInput;
                var row = temp1[3];
                var column = temp1[4];
                if(temp1.length == 6){
                        column = temp1[4]+temp1[5];
                }
                document.getElementById(temp1).value =
                        puzzelArrayData[row][column];
        }
}

function solveClicked() {
        if (currentTextInput != null) {
                var temp1 = currentTextInput;
                var row = temp1[3];
                var column = temp1[4];
                if(temp1.length == 6){
                        column = temp1[4]+temp1[5];
                }

                
                for (j = row; j >= 0; j--) {
                        if (puzzelArrayData[j][column] != 0) {
                                document.getElementById(
                                        "txt"  + j  + column
                                ).value = puzzelArrayData[j][column];
                        } else break;
                }
                
                for (i = column; i < puzzelArrayData[row].length; i++) {
                        if (puzzelArrayData[row][i] != 0) {
                                document.getElementById(
                                        "txt" + row  + i
                                ).value = puzzelArrayData[row][i];
                        } else break;
                }

                
                for (m = row; m < puzzelArrayData.length; m++) {
                        if (puzzelArrayData[m][column] != 0) {
                                document.getElementById(
                                        "txt" + m  + column
                                ).value = puzzelArrayData[m][column];
                        } else break;
                }
                
                for (k = column; k >= 0; k--) {
                        if (puzzelArrayData[row][k] != 0) {
                                document.getElementById(
                                        "txt" + row  + k
                                ).value = puzzelArrayData[row][k];
                        } else break;
                }
                
        }
}
