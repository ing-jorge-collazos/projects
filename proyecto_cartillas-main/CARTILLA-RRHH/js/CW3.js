var currentTextInput;
var puzzleArrayData;

function initializeScreenA() {
        var puzzleTable = document.getElementById("puzzel");
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
        document.getElementById("txt0_14").placeholder = "1";
        document.getElementById("txt2_17").placeholder = "2";
        document.getElementById("txt3_3").placeholder = "3";
        document.getElementById("txt3_10").placeholder = "4";
        document.getElementById("txt3_23").placeholder = "5";
        document.getElementById("txt4_26").placeholder = "6";
        document.getElementById("txt6_19").placeholder = "7";
        document.getElementById("txt6_21").placeholder = "8";
        document.getElementById("txt7_4").placeholder = "9";
        document.getElementById("txt8_12").placeholder = "10";
        document.getElementById("txt9_4").placeholder = "11";
        document.getElementById("txt11_8").placeholder = "12";
        document.getElementById("txt12_11").placeholder = "13";
        document.getElementById("txt13_0").placeholder = "14";
        document.getElementById("txt13_13").placeholder = "15";
        document.getElementById("txt15_5").placeholder = "16";
        document.getElementById("txt15_12").placeholder = "17";
        document.getElementById("txt15_16").placeholder = "18";
        document.getElementById("txt18_3").placeholder = "19";
        document.getElementById("txt18_21").placeholder = "20";

}

function textInputFocus(txt) {
        currentTextInput = txt;
}

function preparepuzzleArray() {
        var items = [
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, "p", 0, 0, 0 ,0 ,0 , 0, 0, 0, 0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, "e", 0, 0, 0 ,0 ,0 , 0, 0, 0, 0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, "r", 0, 0, "f" ,0 ,0 , 0, 0, 0, 0, 0, 0, 0, 0],
            [0, 0, 0, "p", "o", "s", "i", "t", "i","o", "n", 0, 0, 0, "m", 0, 0, "u" ,0 ,0 , 0, 0, 0, "a", 0, 0, 0, 0],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, "e", 0, 0, 0, "a", 0, 0, "l" ,0 ,0 , 0, 0, 0, "c", 0, 0, "p", 0],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, "g", 0, 0, 0, "n", 0, 0, "l" ,0 ,0 , 0, 0, 0, "h", 0, 0, "e", 0],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, "o", 0, 0, 0, "e", 0, 0, "h" ,0 ,"q" , 0, "r", 0, "i", 0, 0, "r", 0],
            [0, 0, 0, 0, "c", "u", "r", "r", "e", "n", "t", 0, 0, 0, "n", 0, 0, "a" ,0 ,"u" , 0, "e", 0, "e", 0, 0, "s", 0],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, "i", 0, "o", 0, "t", 0, 0, "l" ,0 ,"a" , 0, "s", 0, "v", 0, 0, "e", 0],
            [0, 0, 0, 0, "c", "u", "l", "t", "u", "r", "a", "l", "f", "i", "t", 0, 0, "f" ,0 ,"l" , 0, "p", 0, "e", 0, 0,"v", 0],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, "t", 0, "f", 0, "e", 0, 0, "t" ,0 ,"i" , 0, "o", 0, "m", 0, 0, "e", 0],
            [0, 0, 0, 0, 0, 0, 0, 0, "p", 0, "e", 0, "e", 0, "m", 0, 0, "i" ,0 ,"f" , 0, "n", 0, "e", 0, 0, "r", 0],
            [0, 0, 0, 0, 0, 0, 0, 0, "r", 0, 0, "h", "r", 0, "p", 0, 0, "m" ,0 ,"i" , 0, "s", 0, "n", 0, 0, "a", 0],
            ["c", "a", "n", "d", "i", "d", "a", "t", "e", 0, 0, 0, 0, "j", "o", "b", "d", "e" ,"s" ,"c" , "r", "i", "p", "t", "i", "o", "n", 0],
            [0, 0, 0, 0, 0, 0, 0, 0,"v", 0, 0, 0, 0, 0, "r", 0, 0, 0 ,0 ,"a" , 0, "b", 0, "s", 0, 0, "c", 0],
            [0, 0, 0, 0, 0, "h", "i", "r", "i", "n", "g", "m", "a", "n", "a", "g", "e", "r" ,0 ,"t" , 0, "i", 0, 0, 0, 0, "e", 0],
            [0, 0, 0, 0, 0, 0, 0, 0, "o", 0, 0, 0, "p", 0, "r", 0, "n", 0 ,0 ,"i" , 0, "l", 0, 0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0, 0, 0, 0, "u", 0, 0, 0, "p", 0, "y", 0, "r", 0 ,0 ,"o" , 0, "i", 0, 0, 0, 0, 0, 0],
            [0, 0, 0, "s", "k", "i", "l", "l", "s", 0, 0, 0, "l", 0, 0, 0, "o", 0 ,0 ,"n" , 0, "t", "e", "s", "t", "i", "f", "y"],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, "i", 0, 0, 0, "l", 0 ,0 ,"s" , 0, "i", 0, 0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, "c", 0, 0, 0, "l", 0 ,0 ,0 , 0, "e", 0, 0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, "a", 0, 0, 0, "m", 0 ,0 ,0 , 0, "s", 0, 0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, "n", 0, 0, 0, "e", 0 ,0 ,0 , 0, 0, 0, 0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, "t", 0, 0, 0, "n", 0 ,0 ,0 , 0, 0, 0, 0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, "t", 0 ,0 ,0 , 0, 0, 0, 0, 0, 0, 0, 0]
        ];
        return items;
}

function clearAllClicked() {
        currentTextInput = "";
        var puzzleTable = document.getElementById("puzzel");
        puzzleTable.innerHTML = "";
        initializeScreenA();
}

let matchedA = 0;
const allWordsA = 183;

function checkClicked() {
        matchedA=0;
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
                                } else {
                                        selectedInputTextElement.style.backgroundColor =
                                                "#bcd4ec";
                                                matchedA++;
                                                console.log(matchedA);
                                }
                        }
                }
        }
        setTimeout(function () {
                alertPos();
        }, 500);
}

function alertPos() {
        if (matchedA === allWordsA) {
                const checkClick = document.getElementById("checkClick");
                checkClick.setAttribute("data-target","#wingame");
                checkClick.click();
                matchedA++;
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
                
        }
}
