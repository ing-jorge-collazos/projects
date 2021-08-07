var currentTextInput;
var puzzleArrayData;

function initializeScreen() {
        var puzzleTable = document.getElementById("puzzle1");
        puzzleArrayData = preparepuzzleArray();
        for (var i = 0; i < puzzleArrayData.length; i++) {
                var row = puzzleTable.insertRow(-1);
                var rowData = puzzleArrayData[i];
                for (var j = 0; j < rowData.length; j++) {
                        var cell = row.insertCell(-1);
                        if (rowData[j] != 0) {
                                var txtID = String("txt"  + i +"_"+  j);
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
        document.getElementById("txt0_16").placeholder = "1";
        document.getElementById("txt0_18").placeholder = "2";
        document.getElementById("txt1_2").placeholder = "3";
        document.getElementById("txt1_6").placeholder = "4";
        document.getElementById("txt1_14").placeholder = "5";
        document.getElementById("txt2_13").placeholder = "6";
        document.getElementById("txt3_2").placeholder = "7";
        document.getElementById("txt4_11").placeholder = "8";
        document.getElementById("txt5_9").placeholder = "9";
        document.getElementById("txt6_2").placeholder = "10";
        document.getElementById("txt7_6").placeholder = "11";
        document.getElementById("txt7_16").placeholder = "12";
        document.getElementById("txt8_2").placeholder = "13";
        document.getElementById("txt9_0").placeholder = "14";
        document.getElementById("txt9_16").placeholder = "15";
        document.getElementById("txt11_0").placeholder = "16";
        document.getElementById("txt11_11").placeholder = "17";
        document.getElementById("txt13_0").placeholder = "18";
        document.getElementById("txt15_2").placeholder = "19";
        document.getElementById("txt17_6").placeholder = "20";
        document.getElementById("txt18_1").placeholder = "21";

}

function textInputFocus(txt) {
        currentTextInput = txt;
}

function preparepuzzleArray() {
        var itemsA = [
                [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, "b", 0 ,"n" ,0],
                [0, 0, "p", "l", "u", "m", "b", "e", "r", 0, 0, 0, 0, 0, "l", 0, "a", 0 ,"u" ,0],
                [0, 0, 0, 0, 0, 0, "u", 0, 0, 0, 0, 0, 0, "b", "a", "n", "k", "e" ,"r" ,0],
                [0, 0, "d", "e", "n", "t", "i", "s", "t", 0, 0, 0, 0, 0, "w", 0, "e", 0 ,"s" ,0],
                [0, 0, 0, 0, 0, 0, "l", 0, 0, 0, 0, "w", 0, 0, "y", 0, "r", 0 ,"e" ,0],
                [0, 0, 0, 0, 0, 0, "d", 0, 0, "t", "e", "a", "c", "h", "e", "r", 0, 0 ,0 ,0],
                [0, 0, "j", "u", "g", "d", "e", 0, 0, 0, 0, "i", 0, 0, "r", 0, 0, 0 ,0 ,0],
                [0, 0, 0, 0, 0, 0, "r", "e", "p", "o", "r", "t", "e", "r", 0, 0, "d", 0 ,0 ,0],
                [0, 0, "e", 0, 0, 0, 0, 0, 0, 0, 0, "r", 0, 0, 0, 0, "o", 0 ,0 ,0],
                ["p", "o", "l", "i", "c", "e", "o", "f", "f", "i", "c", "e","r", 0, 0, 0, "c", "h","e" ,"f"],
                [0, 0, "e", 0, 0, 0, 0, 0, 0, 0, 0, "s", 0, 0, 0, 0, "t", 0 ,0 ,0],
                ["a", "c", "c", "o", "u", "n", "t", "a", "n", "t", 0, "s", "u", "r", "g", "e", "o", "n" ,0 ,0],
                [0, 0, "t", 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, "r", 0 ,0 ,0],
                ["f", "i", "r", "e", "f", "i", "g", "h", "t", "e", "r", 0, 0, 0, 0, 0, 0, 0 ,0 ,0],
                [0, 0, "i", 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0],
                [0, 0, "c", "a", "r", "p", "e", "n", "t", "e", "r", 0, 0, 0, 0, 0, 0, 0 ,0 ,0],
                [0, 0, "i", 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0],
                [0, 0, "a", 0, 0, 0, "v", 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0],
                [0, "e", "n", "g", "i", "n", "e", "e", "r", 0, 0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0],
                [0, 0, 0, 0, 0, 0, "t", 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0]
        ];
        return itemsA;
}

function clearAllClicked() {
        currentTextInput = "";
        var puzzleTable = document.getElementById("puzzle1");
        puzzleTable.innerHTML = "";
        initializeScreen();
}

let matched = 0;
const allWords = 133;

function checkClicked() {
        matched=0;
        for (var i = 0; i < puzzleArrayData.length; i++) {
                var rowData = puzzleArrayData[i];
                for (var j = 0; j < rowData.length; j++) {
                        if (rowData[j] != 0) {
                                var selectedInputTextElement = document.getElementById(
                                        "txt"  + i +"_"+  j
                                );
                                if (
                                        selectedInputTextElement.value !=
                                        puzzleArrayData[i][j]
                                ) {
                                        selectedInputTextElement.style.backgroundColor =
                                                "#BA1414";
                                }else {
                                        selectedInputTextElement.style.backgroundColor =
                                                "#bcd4ec";
                                                matched++;
                                                console.log(matched);
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
                if(temp1.length == 6){
                    var row = temp1[3];
                    var column = temp1[5];
                }
                if(temp1.length == 7){
                    if(temp1[4]=="_"){
                        var row = temp1[3];
                        var column = temp1[5]+temp1[6];
                    }else if(temp1[5]=="_"){
                        var row = temp1[3]+temp1[4];
                        var column = temp1[6];
                    }
                }
                if(temp1.length == 8){
                    var row = temp1[3]+temp1[4];
                    var column = temp1[6]+temp1[7];
                }
                document.getElementById(temp1).value =
                        puzzleArrayData[row][column];
        }
}

function solveClicked() {
        if (currentTextInput != null) {
                var temp1 = currentTextInput;
                if(temp1.length == 6){
                    var row = temp1[3];
                    var column = temp1[5];
                }
                if(temp1.length == 7){
                    if(temp1[4]=="_"){
                        var row = temp1[3];
                        var column = temp1[5]+temp1[6];
                    }else if(temp1[5]=="_"){
                        var row = temp1[3]+temp1[4];
                        var column = temp1[6];
                    }
                }
                if(temp1.length == 8){
                    var row = temp1[3]+temp1[4];
                    var column = temp1[6]+temp1[7];
                }
                
                for (j = row; j >= 0; j--) {
                        if (puzzleArrayData[j][column] != 0) {
                                document.getElementById(
                                        "txt"  + j  +"_"+ column
                                ).value = puzzleArrayData[j][column];
                        } else break;
                }
                
                for (i = column; i < puzzleArrayData[row].length; i++) {
                        if (puzzleArrayData[row][i] != 0) {
                                document.getElementById(
                                        "txt" + row  + "_"+i
                                ).value = puzzleArrayData[row][i];
                        } else break;
                }

                
                for (m = row; m < puzzleArrayData.length; m++) {
                        if (puzzleArrayData[m][column] != 0) {
                                document.getElementById(
                                        "txt" + m  +"_"+ column
                                ).value = puzzleArrayData[m][column];
                        } else break;
                }
                
                for (k = column; k >= 0; k--) {
                        if (puzzleArrayData[row][k] != 0) {
                                document.getElementById(
                                        "txt" + row +"_" + k
                                ).value = puzzleArrayData[row][k];
                        } else break;
                }
                // Done!
        }
}
