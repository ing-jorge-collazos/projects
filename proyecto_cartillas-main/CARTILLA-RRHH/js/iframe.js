var answers = [];
var objAnswer = {};
var question = {};
//var counts = {};
var counts = [];
var emptyFields = false;
var correctAnswers = 0;
var limitTries = false;
var msg = false;
var btnSave;
var btnScreen;
var btnT3;
var btnZoomIn;
var btnZoomOut;
var btnTry;
var btnCanvas;
var textZoom;
var contentZoom;
var data;
var path;

$(document).ready(function() {
    initialData();
});

function initialData() {
    path = window.location.href.replace('page' + localStorage.getItem('page') + '.html', '');
    data = JSON.parse(localStorage.getItem('data'));
    let iframe = $("html");
    let iframeContent = $("#iframe").contents().find('body');
    var countColumns = $("div[id*=col").length;
    let htmlStructure = createHtmlStructure(iframe);
    var parser = new DOMParser();
    var newNode = parser.parseFromString(htmlStructure, "text/html")

    iframe.replaceWith(newNode.documentElement);
    btnSave = $('body').find('.btn-save');
    btnTry = $('body').find('.btn-try');
    btnT3 = $('body').find('.btn-t3');
    btnM3 = $('body').find('.btn-m3');
    btnZoomIn = $('body').find('#btn-zoomin');
    btnZoomOut = $('body').find('#btn-zoomout');
    btnCanvas = $('body').find('#btn-canvas');
    btnScreen = $('body').find('.btn-screenshoot');
    textZoom = $('body').find('.zoom-text');

    if (countColumns == 1) {
        $("#col1").addClass("col-md-12");
    } else if (countColumns == 2) {
        var page = localStorage.getItem('page');
        if (page == 1) {
            $("#col2").addClass("col-md-6");
            $("#col1").addClass("col-md-6");
        } else {
            $("#col1").addClass("col-md-3");
            $("#col2").addClass("col-md-9");
        }
    } else if (countColumns == 3) {
        $("#col1").addClass("col-md-4");
        $("#col2").addClass("col-md-4");
        $("#col3").addClass("col-md-4");
    }
    generateCounts(localStorage.getItem('numTestCount'));

    eventElements();
    if (localStorage.getItem('answers') == null)
        localStorage.setItem('answers', JSON.stringify(answers = {}));

    var formType = localStorage.getItem('formType');
    initializeAnswerStructure();
    if (formType == 3 || formType == 4 || formType == 5 || formType == 7) {
        initializeDraggablesElements();
        initializeDroppablesElements();
    }
}

function initializeAnswerStructure() {
    var user = sessionStorage.getItem('user');
    var json = JSON.parse(localStorage.getItem('answers'));
    if (!json.hasOwnProperty(user)) {
        json[user] = [
            { "unit1": [{}, {}, {}, {}, {}, {}, {}, {}] },
            { "unit2": [{}, {}, {}, {}, {}, {}] },
            { "unit3": [{}, {}, {}, {}, {}, {}, {}, {}] },
            { "unit4": [{}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}] },
            { "unit5": [{}, {}, {}, {}] },
            { "unit6": [{}, {}, {}, {}] }
        ];
        localStorage.setItem('answers', JSON.stringify(json));
    }
    loadData();
}


function createHtmlStructure(iframe) {
    return html = `<!DOCTYPE html>
    <html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
        <link rel="stylesheet" href="../../../css/lib/bootstrap.min.css">
        <link rel="stylesheet" href="../../../css/lib/sweetalert2.min.css">
        <link rel="stylesheet" href="../../../css/styles.css">
        <link rel="stylesheet" href="../../../css/parejas-2.css" />
        <link rel="stylesheet" href="../../../css/CW2.css" />
        
        <link rel="stylesheet" href="../../../css/CW3.css" />

    </head>
    <body>
    <a id="btn-canvas"></a>
    <div class="btn-screenshoot"><img class="img-fluid" src="../../../content/theme/botones/screen_but.png"></div>
    ` +
        $(iframe).html().replace("<head></head>", "").replace("<body>", "").replace("</body>", "") +
        ` 
    </body>
    </html>`;
}

function eventElements() {
    btnSave.on('click', function() {
        var unit = localStorage.getItem('unit');
        var test = localStorage.getItem('test');
        var numQuestions = localStorage.getItem('numQuestions');
        var correctNumAnswers = localStorage.getItem('correctNumAnswers');
        var formType = localStorage.getItem('formType');

        answers = [];
        correctAnswers = 0;
        if (!limitTries) {
            msg = true;
            validFields(unit, test, numQuestions, correctNumAnswers);
            if (!emptyFields) {
                var count = countTest(test);
                triesState(count, test);
                if (count <= 3) {
                    processData(unit, test, count);
                    if (formType == 3 || formType == 5) {
                        btnTry.attr("style", "display:block");
                        $(this).attr("style", "display:none");
                    }
                } else {
                    limitTries = true;
                }
            }
        } else
            getMessage(path + '../../../content/theme/messages/limit_tries.png');
    });

    btnSave.hover(function() {
        btnSave.attr('src', path + '../../../content/theme/botones/review_but_sobre.png');
    }, function() {
        btnSave.attr('src', path + '../../../content/theme/botones/review_but_reposo.png');
    });

    btnT3.on('click', function() {
        var idBtn = $(this).attr('id');
        var value = idBtn.split("").length == 2 ? idBtn.split("") : idBtn.match(/.{1,2}/g);
        var numQuestions = localStorage.getItem('numQuestions');
        for (var i = 1; i <= numQuestions; i++) {
            if (value[0] == i) {
                stateSelectedOption(value[0], value[1], idBtn);
                break;
            }
        }
    });

    btnM3.on('click', function() {
        var idBtn = $(this).attr('id');
        var value = idBtn.split("").length == 2 ? idBtn.split("") : idBtn.match(/.{1,2}/g);
        var numQuestions = localStorage.getItem('numQuestions');
        for (var i = 1; i <= numQuestions; i++) {
            if (value[0] == i) {
                stateSelectedOptionMultiple(value[0], value[1], idBtn);
                break;
            }
        }
    });

    btnZoomIn.on("click", function() {
        var size = parseInt(textZoom.css("font-size").replace('px', ''));
        size = size + 1;
        if (size >= 26) {
            size = 26;
        }
        textZoom.css("font-size", size);
    });

    btnZoomOut.on("click", function() {
        var size = parseInt(textZoom.css("font-size").replace('px', ''));
        size = size - 1;
        if (size <= 14) {
            size = 14;
        }
        textZoom.css("font-size", size);
    });

    btnTry.on("click", function() {
        var formType = localStorage.getItem('formType');
        if (formType == 3) {
            btnSave.attr("style", "display:block");
            $(this).attr("style", "display:none");
            var numQuestions = localStorage.getItem('numQuestions');
            for (var i = 1; i <= numQuestions; i++) {
                $("#question" + i).val("");
                $("#answer" + i).attr("style", "");
                $("#answer" + i).attr("style", "display:block; position: relative;");
                $("#content" + i).attr("src", path + "../../../content/units/unit1/img/drag/page10/images_answer.png");
                $("#chqu" + i + " img").attr("src", "");
            }
        } else if (formType == 5) {
            btnSave.attr("style", "display:block");
            $(this).attr("style", "display:none");
            var numQuestions = localStorage.getItem('numQuestions');
            for (var i = 1; i <= numQuestions; i++) {
                $("#question" + i).val("");
                $("#answer" + i).attr("style", "");
                $("#answer" + i).attr("style", "display:block; position: relative;");
                $("#chqu" + i + " img").attr("src", "");
            }
        }
        initializeDraggablesElements();
    });

    //Definimos el botón para escuchar su click, y también el contenedor del canvas
    var getCanvas;
    btnScreen.on("click", function() {
        html2canvas(document.querySelector('.container > .row'), {
                useCORS: true,
                width: window.screen.availWidth,
                height: window.screen.availHeight,
                windowWidth: document.body.scrollWidth,
                windowHeight: document.body.scrollHeight,
                x: 0,
                y: window.pageYOffset
            })
            .then(function(canvas) {
                getImage(canvas);

            });
    });
}

function screenShoot() {
    html2canvas(document.querySelector('.container'), {
        onrendered: function(canvas) {
            document.getElementById('canvas').appendChild(canvas);
            var data = canvas.toDataURL('image/png');
            //display 64bit imag
            var image = new Image();
            image.src = data;

            document.getElementById('image').appendChild(image);
        }
    }).then(function(canvas) {
        document.getElementById('canvas').appendChild(canvas);
        var data = canvas.toDataURL('image/png');
        //display 64bit imag
        var image = new Image();
        image.src = data;

        document.getElementById('image').appendChild(image);
    });
}

function stateSelectedOptionMultiple(id, value, idBtn) {
    console.log(id, ' ', value, ' ', idBtn);
    if (value == "1") {
        $("#question" + id).val($.trim($("#" + idBtn).text()));
        $("#" + idBtn).css('background-color', '#92ce3f');
        $("#" + id + "2").css('background-color', 'gray');
        $("#" + id + "3").css('background-color', 'gray');
    } else if (value == "2") {
        $("#question" + id).val($.trim($("#" + idBtn).text()));
        $("#" + idBtn).css('background-color', '#92ce3f');
        $("#" + id + "1").css('background-color', 'gray');
        $("#" + id + "3").css('background-color', 'gray');
    } else if (value == "3") {
        $("#question" + id).val($.trim($("#" + idBtn).text()));
        $("#" + idBtn).css('background-color', '#92ce3f');
        $("#" + id + "1").css('background-color', 'gray');
        $("#" + id + "2").css('background-color', 'gray');
    }
}

/*
 *Método que permite validar el comportamiento respuestas true/false
 */
function stateSelectedOption(id, value, idBtn) {
    if (value == "1") {
        $("#question" + id).val(true);
        $("#" + idBtn).css('background-color', '#92ce3f');
        $("#" + id + "0").css('background-color', 'gray');
    } else {
        $("#question" + id).val(false);
        $("#" + idBtn).css('background-color', '#92ce3f');
        $("#" + id + "1").css('background-color', 'gray');
    }
}

function validFields(unit, test, numQuestion, correctNumAnswers) {
    for (var i = 1; i <= numQuestion; i++) {
        var value = $('#question' + i).val();
        if (value === '') {
            validationState(1, i, '', '', '', correctNumAnswers);
        } else {
            validationState(2, i, value, unit, test, correctNumAnswers);
        }
    }
    answers.push(question);
    if (((Object.keys(answers[0]).length) - 2) === numQuestion)
        getMessage('Preguntas Enviadas');
}

function validationState(value, i, answer, unit, test, correctNumAnswers) {
    if (value === 1) {
        $('#question' + i).css('border-color', 'red');
        $('#correct_answer' + i).css('color', 'red');
        $('#correct_answer' + i).show();
        $('#correct_answer' + i).text("Empty field");
        emptyFields = true;
    } else if (value === 2) {
        emptyFields = false;
        $('#correct_answer' + i).hide();
        checkAnswer(answer, i, unit, test);
    }
    createObjAnswers(answer, i, correctNumAnswers, test);
}

function checkAnswer(answer, i, numUnit, numTest) {
    var test = data[1].units[numUnit - 1]['test' + numTest];
    if (test[i - 1] == answer) {
        $('#chqu' + i + ' img').attr('src', path + '../../../content/theme/icons/check.png');
        $('#question' + i).css('border-color', 'green');
        correctAnswers = correctAnswers + 1;
    } else {
        $('#chqu' + i + ' img').attr('src', path + '../../../content/theme/icons/error.png');
        $('#question' + i).css('border-color', 'red');
    }
}

function createObjAnswers(answer, id, correctNumAnswers, test) {
    if (msg && !emptyFields) {
        var state = 'Reprobate';
        var img = path + '../../../content/theme/messages/failed_try.png';
        if (correctNumAnswers <= correctAnswers) {
            state = 'Approved';
            img = path + '../../../content/theme/messages/congratulation.png';
        }
        getMessage(img);
    }

    question['id'] = 'test' + test;
    question['tries'] = 0;
    question['state'] = state;
    if (answer != "")
        question['question' + id] = answer;
}

/*
 * Evento drag and drop
 */

function initializeDraggablesElements() {
    var formType = localStorage.getItem('formType');
    var numQuestions = localStorage.getItem('numQuestions');
    if (formType == 3) {
        for (i = 1; i <= numQuestions; i++)
            $("#answer" + i).draggable({ containment: "window", revert: true, zIndex: 10000 });
    } else if (formType == 4) {
        $("#answers").sortable({
            //axis: 'y',
            containment: "parent",
            stop: function(event, ui) {
                //var idsInOrder = $("#answers").sortable('toArray');
                var array = $(this).sortable('toArray', { attribute: 'id' });
                $("#question1").val(array[0]);
                $("#question2").val(array[1]);
                $("#question3").val(array[2]);
                $("#question4").val(array[3]);
            }
        });
        //$("#answers").disableSelection();
    } else if (formType == 5) {
        for (i = 1; i <= numQuestions; i++)
            $("#answer" + i).draggable({
                containment: "window",
                scroll: false,
                drag: function(event, ui) {
                    //ui.position.left = Math.min(600, ui.position.left);
                    //ui.position.top = Math.min(300, ui.position.top);
                },
                start: function(event, ui) {
                    $(this).css("z-index", 1000)
                        //$(this).css({ "z-index": 1000, width: '50%' })
                }
            });
    } else if (formType == 7) {
        console.log("hecho");
        for (var i = 1; i <= numQuestions; i++) {
            $("#answers" + i).sortable({
                axis: 'x',
                containment: "parent",
                stop: function(event, ui) {
                    //var idsInOrder = $("#answers").sortable('toArray');
                    var array = $(this).sortable('toArray', { attribute: 'id' });
                    console.log($(this).sortable('toArray'));
                    console.log(array);
                    /*$("#question1").val(array[0]);
                    $("#question2").val(array[1]);
                    $("#question3").val(array[2]);
                    $("#question4").val(array[3]);*/
                }
            });
        }
        //$("#answers").disableSelection();
    }
}

function initializeDroppablesElements() {
    var unit = localStorage.getItem('unit');
    var page = localStorage.getItem('page');
    var numQuestions = localStorage.getItem('numQuestions');
    var formType = localStorage.getItem('formType');
    if (formType == 5) {
        for (i = 1; i <= numQuestions; i++) {
            //$("#content" + i).attr('data-id', i);
            $("#content" + i).droppable({
                drop: function(event, ui) {
                    var id = ui.draggable[0].attributes['data-id'].value;
                    //console.log(id);
                    var idContent = event.target.attributes['data-id'].value;
                    $("#question" + idContent).val(id);
                    // console.log(event);
                    /*var pos = event.target.position();
                    alert('top: ' + pos.top + ', left: ' + pos.left);*/
                    //$(id).css({ "z-index": 1000, width: '50%' })
                    //eventDragDrop(idContent, id, unit, page, formType);
                }
            });
        }
    } else {
        for (i = 1; i <= numQuestions; i++) {
            $("#content" + i).attr('data-id', i);
            $("#content" + i).droppable({
                disabled: false,
                drop: function(event, ui) {
                    var id = ui.draggable[0].id;
                    var idContent = event.target.attributes['data-id'].value;
                    eventDragDrop(idContent, id, unit, page, formType);
                },
                over: function(event, ui) {
                    $("#content" + i).hide();
                    $("#content" + i).css('opacity', '0.50');
                },
                out: function(event, ui) {
                    $("#content" + i).css('opacity', '1');
                }
            });
        }
    }
}

function eventDragDrop(value, id, unit, page, formType) {
    if (formType == 3) {
        if ($("#question" + value).attr('data-id') != undefined) {
            var idOld = $("#question" + value).attr('data-id');
            $("#" + idOld).attr('src', path + '../../../content/units/unit' + unit + '/img/drag' + '/page' + page + '/' + idOld + '.png');
            $("#" + idOld).show();
        }
        $("#content" + value).attr('src', path + '../../../content/units/unit' + unit + '/img/drag' + '/page' + page + '/' + id + '.png');
        $("#" + id).hide();
        $("#question" + value).attr('data-id', id);
        $("#question" + value).val(id);
        $("#content" + value).css('opacity', '0.80');
    }
}

/**
 * Método para guardar respuestas
 */

function processData(unit, numTest, tries) {
    question.tries = tries;
    var user = sessionStorage.getItem('user');
    var json = JSON.parse(localStorage.getItem('answers'));
    var test = json[user][unit - 1]['unit' + unit];
    test[numTest - 1] = question;
    localStorage.setItem('answers', JSON.stringify(json));
}

/**
 * Método para cargar respuestas
 */
function loadData() {
    var unit = localStorage.getItem('unit');
    var numTest = localStorage.getItem('test');
    var page = localStorage.getItem('page');
    var numQuestions = localStorage.getItem('numQuestions');
    var correctNumAnswers = localStorage.getItem('correctNumAnswers');
    var formType = localStorage.getItem('formType');
    limitTries = false;
    var data = null;

    if (0 < numTest) {
        var user = sessionStorage.getItem('user');
        var json = JSON.parse(localStorage.getItem('answers'));
        var test = json[user][unit - 1]['unit' + unit];

        var flag = false;

        if (test.length > 0) {
            for (var i = 0; i < test.length; i++) {
                if (test[i].id == 'test' + numTest) {
                    data = test[i];
                    flag = true;
                    break;
                }
            }
        }
        if (data != null) {
            if (formType == 1 || formType == 5) {
                for (var i = 1; i <= numQuestions; i++) {
                    var texto = data['question' + i];
                    $('#question' + i).val(texto);
                }

            } else if (formType == 2) {
                for (var i = 1; i <= numQuestions; i++) {
                    var texto = data['question' + i];
                    //$('#question' + i).val(texto);
                    var ans = texto == "true" ? 1 : 0;
                    stateSelectedOption(i, ans, i + '' + ans);
                }
            } else if (formType == 3) {
                for (var i = 1; i <= numQuestions; i++) {
                    var texto = data['question' + i];
                    $('#question' + i).val(texto);
                    $('#content' + i).attr("src", path + '../../../content/units/unit' + unit + '/img/drag' + '/page' + page + '/' + texto + '.png');
                }
            }

            if (data.tries > 0 && formType == 3) {
                btnSave.attr('style', 'display:none');
                btnTry.attr('style', 'display:block');
            }

            counts[numTest - 1] = data.tries;
            data.tries == 3 ? limitTries = true : limitTries = false;
            triesState(data.tries, numTest);
            validFields(unit, numTest, numQuestions, correctNumAnswers);
        }
    }
}

/**
 * Generar contadores
 */
function generateCounts(numTest) {
    counts = [];
    for (var i = 1; i <= numTest; i++)
        counts.push(0);
}

/**
 * Método para dar comportamiento a los intentos realizados
 */
function triesState(count, id) {
    if (count == 1)
        $("#img-try-" + id).attr('src', path + '../../../content/theme/questions/images_08.png');
    else if (count == 2)
        $("#img-try-" + id).attr('src', path + '../../../content/theme/questions/images_10.png');
    else if (count == 3)
        $("#img-try-" + id).attr('src', path + '../../../content/theme/questions/images_11.png');
    else if (count > 3)
        $("#img-try-" + id).attr('src', path + '../../../content/theme/questions/images_12.png');
}

/**
 * Método para obtener contador por formulario
 */
function countTest(i) {
    return counts[i - 1] = counts[i - 1] + 1;
}

/*
 * Mostrar modal con alertas
 */
function getMessage(url) {
    Swal.fire({
        title: '\n\n\n\n\n\n\n\n',
        width: 600,
        /*height: auto,
        padding: '3em',*/
        background: 'url(' + url + ')',
        showConfirmButton: false,
        showCloseButton: true,
        timer: 3500
    });
}

function getImage(canvas) {
    Swal.fire({
        //html: "<img src='../content/theme/botones/before_but.png'>",
        title: 'Press right click to download content',
        html: canvas,
        width: '900px',
        showCloseButton: false,
        showCancelButton: false,
        focusConfirm: false,
        showConfirmButton: false
    });

    $('canvas').css("width", 850);
    $('canvas').css("height", 400);
}