var count = 1; //Pages
var data;
var content;
var numTestCount;
var path;

$(document).ready(function() {
    initialData();
});

function loadIFrame() {
    var iframe = document.getElementById("iframe");

    // Adjusting the iframe height onload event
    iframe.onload = function() {
        iframe.style.height = iframe.contentWindow.document.body.scrollHeight + 'px';
    }
}

$("#btn-next").on("click", function() {
    $("#iframe").hide();
    var value = $("#select-unit").text();
    $("#btn-next img").attr('src', path + 'content/theme/botones/next_but_press.png');
    count = count + 1;
    if (count <= $("#limit-page").text())
        loadPage(value, count);
});

$("#btn-before").on("click", function() {
    $("#iframe").hide();
    var value = $("#select-unit").text();
    $("#btn-before img").attr('src', path + 'content/theme/botones/before_but_press.png');
    count = count - 1;

    if (count == parseInt($("#limit-page").text()) - 1)
        $("#btn-next").show();

    if (count >= 1)
        loadPage(value, count);
});

$("#btn-statics").on("click", function() {
    $("#btn-statics img").attr('src', path + 'content/theme/botones/score_but_press.png');
    getMessage();
});

$("#btn-screen").on("click", function() {
    $("#btn-screen img").attr('src', path + 'content/theme/botones/screen_but_press.png');
});

$("#btn-home").on("click", function() {
    $("#btn-home img").attr('src', path + 'content/theme/botones/home_but_press.png');
});

$("#btn-next img").hover(function() {
    $("#btn-next img").attr('src', path + 'content/theme/botones/next_but_sobre.png');
    $("#btn-next").tooltip({ animated: 'fade', placement: 'bottom', html: true });
}, function() {
    $("#btn-next img").attr('src', path + 'content/theme/botones/next_but.png');
});

$("#btn-before img").hover(function() {
    $("#btn-before img").attr('src', path + 'content/theme/botones/before_but_sobre.png');
    $("#btn-before").tooltip({ animated: 'fade', placement: 'bottom', html: true });
}, function() {
    $("#btn-before img").attr('src', path + 'content/theme/botones/before_but.png');
});

$("#btn-statics img").hover(function() {
    $("#btn-statics img").attr('src', path + 'content/theme/botones/score_but_sobre.png');
    $("#btn-statics").tooltip({ animated: 'fade', placement: 'bottom', html: true });
}, function() {
    $("#btn-statics img").attr('src', path + 'content/theme/botones/score_but.png');
});

$("#btn-screen img").hover(function() {
    $("#btn-screen img").attr('src', path + 'content/theme/botones/screen_but_sobre.png');
    $("#btn-screen").tooltip({ animated: 'fade', placement: 'bottom', html: true });
}, function() {
    $("#btn-screen img").attr('src', path + 'content/theme/botones/screen_but.png');
});

$("#btn-home img").hover(function() {
    $("#btn-home img").attr('src', path + 'content/theme/botones/home_but_sobre.png');
    $("#btn-home").tooltip({ animated: 'fade', placement: 'bottom', html: true });
}, function() {
    $("#btn-home img").attr('src', path + 'content/theme/botones/home_but.png');
});

$("#units").change(function() {
    $("#iframe").hide();
    $("#btn-next").show();
    count = 1;
    var unit = $(this).val();
    $("#select-unit").text(unit);
    localStorage.setItem('unit', unit);
    localStorage.setItem('numTestCount', numTestCount[unit - 1]);
    loadPage(unit, 1);
});

function initialData() {
    data = getConfigurations();
    path = window.location.href.replace('principal.html', '');
    numTestCount = data[0].numTest;
    $("#units").val(localStorage.getItem('unit'));
    var unit = localStorage.getItem('unit');
    $("#select-unit").text(unit);
    localStorage.setItem('numTestCount', numTestCount[unit - 1]);
    localStorage.setItem('data', JSON.stringify(data));
    loadPage($("#units").val(), count);
}

function loadPage(unit, numPage) {
    var c = 0;
    var limitPages = data[0].limitPages;
    var pageColumns = data[0].pageColumns;
    var pages = pageColumns[unit - 1]['pag' + numPage];
    var index = pages.split("|");
    var indexZoom = parseInt(index[0]) + 1;
    var indexColor = parseInt(index[0]) + 2;
    var indexImageHeader = parseInt(index[0]) + 3;
    var indexTest = parseInt(index[0]) + 4;
    var indexQuestion = parseInt(index[0]) + 5;
    var indexCorrectNumAnswers = parseInt(index[0]) + 6;
    var indexFormType = parseInt(index[0]) + 7;
    $("#units").css("background-color", '#' + index[indexColor]);
    $("#header-main").css("background-color", '#' + index[indexColor]);
    $("#header-top").css("color", '#' + index[indexColor]);
    $("#img-header").attr('src', path + 'content/units/unit' + unit + '/header_top/' + index[indexImageHeader]);

    $("#current-page").text(numPage);
    $("#limit-page").text(limitPages[unit - 1]);
    if (numPage == 1) {
        $("#btn-before").hide();
        $("#btn-statics").hide();
        $("#btn-screen").hide();
    } else if (numPage == $("#limit-page").text()) {
        $("#btn-next").hide();
    } else if (numPage > 1) {
        $("#btn-before").show();
        $("#btn-statics").show();
        $("#btn-screen").show();
    }

    if (index[indexZoom] == 'Zoom') {
        $("#lbl-text").show();
        $("#btn-zoomin").show();
        $("#btn-zoomout").show();
    } else {
        $("#lbl-text").hide();
        $("#btn-zoomin").hide();
        $("#btn-zoomout").hide();
    }
    getContent(unit, numPage, index[indexTest], index[indexQuestion],
        index[indexCorrectNumAnswers], index[indexFormType]);
}

function getContent(unit, page, test, numQuestions, correctNumAnswers, formType) {
    $('#iframe').attr('src', path + 'views/units/unit' + unit + '/page' + page + '.html');
    eventSave(unit, page, test, numQuestions, correctNumAnswers, formType);
}

$("#iframe").on('load', function() {
    $(this).show();
});

//Definimos el botón para escuchar su click, y también el contenedor del canvas
$("#btn-screen").on("click", function() {
    $objetivo = document.querySelector(".swal2-content");
    html2canvas($objetivo, {
            letterRendering: 1,
            allowTaint: true,
            useCORS: true,
            onrendered: function(canvas) {
                // Cuando se resuelva la promesa traerá el canvas
                // Crear un elemento <a>

            }
        }) // Llamar a html2canvas y pasarle el elemento
        .then(canvas => {
            let enlace = document.createElement('a');
            enlace.download = "Captura_catering_and_cooking.png";
            // Convertir la imagen a Base64
            enlace.href = canvas.toDataURL();
            // Hacer click en él
            enlace.click();
        });
});

/*
 * Mostrar modal con alertas
 */
function getMessage() {
    Swal.fire({
        title: '<strong>Score</strong>',
        imageUrl: 'content/theme/icons/cup.png',
        imageWidth: 60,
        imageHeight: 60,
        imageAlt: 'Score',
        html: getScore(),
        width: 800,
        showCloseButton: false,
        showCancelButton: false,
        focusConfirm: false,
        confirmButtonText: '<i class="fa fa-thumbs-up"></i> Close',
    });
    fillTablesScore();
}

function getScore() {
    return `
    <div id="accordion">
        <div class="card">
            <div class="card-header" id="headingOne">
            <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Unit 1 - Catering Basics
                </button>
            </h5>
            </div>

            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                    <table class="table table-sm" id="unit1"></table>   
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingTwo">
            <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Unit 2 - Inside the Kitchen
                </button>
            </h5>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
            <div class="card-body">
            <table class="table table-sm" id="unit2"></table>   
            </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingThree">
            <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                Unit 3 - Kitchen Hierarchy and Skills
                </button>
            </h5>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
            <div class="card-body">
            <table class="table table-sm" id="unit3"></table>
            </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingFour">
            <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                Unit 4 - Basic Cooking Techniques and Types of Meat
                </button>
            </h5>
            </div>
            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
            <div class="card-body">
            <table class="table table-sm" id="unit4"></table>
            </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingFive">
            <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                Unit 5 - Personal Hygiene and Uniforms
                </button>
            </h5>
            </div>
            <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
            <div class="card-body">
            <table class="table table-sm" id="unit5"></table>
            </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingSix">
            <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                Unit 6 - Restaurant Kitchen Layouts
                </button>
            </h5>
            </div>
            <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
            <div class="card-body">
            <table class="table table-sm" id="unit6"></table>
            </div>
            </div>
        </div>
    </div>
    `;
}

function fillTablesScore() {
    var user = sessionStorage.getItem('user');
    var answers = localStorage.getItem('answers');
    var jsonData = JSON.parse(answers)[user];
    for (var i = 1; i <= 6; i++) {
        $("#unit" + i).append("<thead id='th" + i + "'></thead>");
        $("#unit" + i).append("<tbody id='tb" + i + "'></tbody>");
        $("#th" + i).append("<tr id='tr" + i + "'></tr>");
        $("#tr" + i).append('<th scope="col">#</th>');
        $("#tr" + i).append('<th scope="col">Approved</th>');
        $("#tr" + i).append('<th scope="col">Reprobate</th>');
        $("#tr" + i).append('<th scope="col">Tries</th>');
        var unit = jsonData[i - 1]['unit' + i];
        for (var j = 1; j <= numTestCount[i - 1]; j++) {
            $("#tb" + i).append("<tr id='tr" + i + j + "'></tr>");
            $("#tr" + i + j).append('<td>Test ' + j + '</td>');
            $("#tr" + i + j).append('<td><img class="img-fluid" id="check' + i + j + '" src = "" /></td>');
            $("#tr" + i + j).append('<td><img class="img-fluid" id="error' + i + j + '" src = "" /></td>');
            $("#tr" + i + j).append('<td><span id="tries' + i + j + '">0</span></td>');
            if (unit.length > 0) {
                if (unit[j - 1]['id'] === 'test' + j) {
                    $("#tries" + i + j).text(unit[j - 1]['tries']);
                    if (unit[j - 1]['state'] === "Approved")
                        $("#check" + i + j).attr("src", path + 'content/theme/icons/check.png');
                    else
                        $("#error" + i + j).attr("src", path + 'content/theme/icons/error.png');
                }
            }
        }
    }
}

function eventSave(unit, page, test, numQuestions, correctNumAnswers, formType) {
    localStorage.setItem('page', page);
    localStorage.setItem('unit', unit);
    localStorage.setItem('test', test);
    localStorage.setItem('numQuestions', numQuestions);
    localStorage.setItem('correctNumAnswers', correctNumAnswers);
    localStorage.setItem('formType', formType);
}

//Zoom text
$(".btn-zoom").on("click", function() {
    var size = $(".zoom-text").css("font-size");
    if ($(this).hasClass("plus")) {
        size = size + 1;
        if (size >= 22) {
            size = 22;
        }
    } else {
        size = size - 1;
        if (size <= 14) {
            size = 14;
        }
    }
    $(".zoom-text").css("font-size", size);
});

//Cerrar Sesión
$("#btn-logout").on('click', function() {
    sessionStorage.clear();
    window.location.href = "index.html";
    var json = JSON.parse(localStorage.getItem('users'));
});

function getConfigurations() {
    return data = [{
            "pageColumns": [{
                    "pag1": "2|6|6|NoZoom|FF5800|title.png|0|0|0|0",
                    "pag2": "3|4|4|4|NoZoom|FF5800|talk.png|0|0|0|0",
                    "pag3": "3|4|4|4|Zoom|FF5800|read.png|0|0|0|0",
                    "pag4": "2|3|9|NoZoom|FF5800|write.png|1|12|7|1",
                    "pag5": "2|3|9|NoZoom|FF5800|write.png|2|7|5|1",
                    "pag6": "3|4|4|4|Zoom|FF5800|read.png|0|0|0|0",
                    "pag7": "2|3|9|NoZoom|FF5800|work.png|3|5|3|2",
                    "pag8": "2|3|9|NoZoom|FF5800|write.png|4|6|4|1",
                    "pag9": "2|3|9|NoZoom|FF5800|talk.png|0|0|0|0",
                    "pag10": "2|3|9|NoZoom|FF5800|work.png|5|8|5|3",
                    "pag11": "2|3|9|NoZoom|FF5800|talk.png|0|0|0|0",
                    "pag12": "2|3|9|NoZoom|FF5800|work.png|6|8|5|3",
                    "pag13": "2|3|9|NoZoom|FF5800|work.png|7|9|5|5",
                    "pag14": "2|6|6|NoZoom|FF5800|learn.png|0|0|0|0",
                    "pag15": "3|4|4|4|NoZoom|FF5800|talk.png|0|0|0|0",
                    "pag16": "3|4|4|4|Zoom|FF5800|write.png|0|0|0|0",
                    "pag17": "3|4|4|4|NoZoom|FF5800|talk.png|0|0|0|0",
                    "pag18": "3|4|4|4|Zoom|FF5800|read.png|0|0|0|0",
                    "pag19": "2|3|9|NoZoom|FF5800|work.png|8|6|4|5",
                    "pag20": "1|12|NoZoom|FF5800|fin.png|0|0|0|0"
                },
                {
                    "pag1": "2|6|6|NoZoom|92CE3F|title.png|0|0|0|0",
                    "pag2": "3|4|4|4|NoZoom|92CE3F|language.png|0|0|0|0",
                    "pag3": "3|4|4|4|NoZoom|92CE3F|talk.png|0|0|0|0",
                    "pag4": "2|3|9|NoZoom|92CE3F|work.png|1|16|9|5",
                    "pag5": "2|3|9|NoZoom|92CE3F|work.png|2|16|9|3",
                    "pag6": "2|3|9|NoZoom|92CE3F|work.png|3|6|4|6",
                    "pag7": "3|4|4|4|Zoom|92CE3F|read.png|0|0|0|0",
                    "pag8": "3|4|4|4|Zoom|92CE3F|read.png|0|0|0|0",
                    "pag9": "2|3|9|NoZoom|92CE3F|work.png|4|9|5|2",
                    "pag10": "2|3|9|NoZoom|92CE3F|work.png|5|10|6|6",
                    "pag11": "3|4|4|4|NoZoom|92CE3F|listen.png|0|0|0|0",
                    "pag12": "2|3|9|NoZoom|92CE3F|work.png|6|11|6|3",
                    "pag13": "3|4|4|4|Zoom|92CE3F|work.png|7|4|3|4",
                    "pag14": "3|4|4|4|Zoom|92CE3F|write.png|0|0|0|0",
                    "pag15": "1|12|NoZoom|92CE3F|fin.png|0|0|0|0"
                },
                {
                    "pag1": "2|6|6|NoZoom|8E52B7|title.png|0|0|0|0",
                    "pag2": "2|3|9|NoZoom|8E52B7|talk.png|1|4|3|5",
                    "pag3": "3|4|4|4|Zoom|8E52B7|work.png|0|0|0|0",
                    "pag4": "2|3|9|NoZoom|8E52B7|work.png|2|4|4|3",
                    "pag5": "3|4|4|4|Zoom|8E52B7|write.png|0|0|0|0",
                    "pag6": "3|4|4|4|Zoom|8E52B7|read.png|0|0|0|0",
                    "pag7": "2|3|9|NoZoom|8E52B7|listen.png|3|7|4|2",
                    "pag8": "2|3|9|NoZoom|8E52B7|write.png|4|4|3|1",
                    "pag9": "3|4|4|4|NoZoom|8E52B7|talk.png|0|0|0|0",
                    "pag10": "3|4|4|4|NoZoom|8E52B7|talk.png|0|0|0|0",
                    "pag11": "3|4|4|4|NoZoom|8E52B7|language.png|0|0|0|0",
                    "pag12": "2|3|9|NoZoom|8E52B7|work.png|5|10|6|6",
                    "pag13": "3|4|4|4|NoZoom|8E52B7|read.png|6|10|6|3",
                    "pag14": "2|3|9|NoZoom|8E52B7|practice.png|7|6|4|7",
                    "pag15": "3|4|4|4|Zoom|8E52B7|talk.png|0|0|0|0",
                    "pag16": "2|3|9|NoZoom|8E52B7|work.png|8|15|8|3",
                    "pag17": "1|12|NoZoom|8E52B7|play.png|0|0|0|0",
                    "pag18": "1|12|NoZoom|8E52B7|fin.png|0|0|0|0"
                },
                {
                    "pag1": "2|6|6|NoZoom|009E9E|title.png|0|0|0|0",
                    "pag2": "2|6|6|NoZoom|009E9E|language.png|0|0|0|0",
                    "pag3": "2|3|9|NoZoom|009E9E|write.png|0|0|0|0",
                    "pag4": "3|4|4|4|NoZoom|009E9E|talk.png|0|0|0|0",
                    "pag5": "3|4|4|4|Zoom|009E9E|read.png|1|3|2|1",
                    "pag6": "3|4|4|4|NoZoom|009E9E|work.png|2|11|6|2",
                    "pag7": "3|4|4|4|NoZoom|009E9E|work.png|0|8|5|1",
                    "pag8": "3|4|4|4|Zoom|009E9E|listen.png|3|4|3|1",
                    "pag9": "2|3|9|NoZoom|009E9E|listen.png|4|4|3|1",
                    "pag10": "2|3|9|NoZoom|009E9E|work.png|5|7|4|3",
                    "pag11": "3|4|4|4|Zoom|009E9E|work.png|6|7|4|3",
                    "pag12": "3|4|4|4|NoZoom|009E9E|write.png|0|0|0|0",
                    "pag13": "3|4|4|4|NoZoom|009E9E|talk.png|0|0|0|0",
                    "pag14": "2|3|9|NoZoom|009E9E|work.png|7|12|7|1",
                    "pag15": "2|3|9|NoZoom|009E9E|work.png|8|7|4|4",
                    "pag16": "2|3|9|NoZoom|009E9E|work.png|9|9|5|1",
                    "pag17": "3|4|4|4|Zoom|009E9E|work.png|10|7|4|1",
                    "pag18": "1|12|NoZoom|009E9E|fin.png|0|0|0|0"
                },
                {
                    "pag1": "2|6|6|NoZoom|008CE3|title.png|0|0|0|0",
                    "pag2": "3|4|4|4|NoZoom|008CE3|talk.png|0|0|0|0",
                    "pag3": "3|4|4|4|Zoom|008CE3|read.png|0|0|0|0",
                    "pag4": "3|4|4|4|NoZoom|008CE3|work.png|0|0|0|0",
                    "pag5": "3|4|4|4|Zoom|008CE3|read.png|0|0|0|0",
                    "pag6": "2|3|9|NoZoom|008CE3|work.png|1|5|3|2",
                    "pag7": "3|4|4|4|NoZoom|008CE3|listen.png|2|14|8|3",
                    "pag8": "2|3|9|NoZoom|008CE3|work.png|3|5|3|5",
                    "pag9": "1|12|NoZoom|008CE3|language.png|0|0|0|0",
                    "pag10": "2|3|9|NoZoom|008CE3|read.png|0|0|0|0",
                    "pag11": "3|4|4|4|Zoom|008CE3|read.png|0|0|0|0",
                    "pag12": "2|3|9|NoZoom|008CE3|work.png|4|8|5|3",
                    "pag13": "2|3|9|NoZoom|008CE3|write.png|0|0|0|0",
                    "pag14": "1|12|NoZoom|008CE3|play.png|0|0|0|0",
                    "pag15": "1|12|NoZoom|008CE3|fin.png|0|0|0|0"
                },
                {
                    "pag1": "2|6|6|NoZoom|FFB100|title.png|0|0|0|0",
                    "pag2": "3|4|4|4|NoZoom|FFB100|talk.png|0|0|0|0",
                    "pag3": "2|3|9|NoZoom|FFB100|work.png|1|5|3|3",
                    "pag4": "3|4|4|4|Zoom|FFB100|listen.png|2|13|7|1",
                    "pag5": "3|4|4|4|Zoom|FFB100|read.png|3|5|3|1",
                    "pag6": "3|4|4|4|Zoom|FFB100|read.png|0|0|0|0",
                    "pag7": "3|4|4|4|Zoom|FFB100|check.png|4|6|4|1",
                    "pag8": "3|4|4|4|Zoom|FFB100|write.png|0|0|0|0",
                    "pag9": "2|3|9|NoZoom|FFB100|practice.png|0|0|0|0",
                    "pag10": "1|12|NoZoom|FFB100|fin.png|0|0|0|0"
                }
            ],
            "limitPages": ["20", "15", "18", "18", "15", "10"],
            "numTest": ["8", "6", "8", "11", "4", "4"]
        },
        {
            "units": [{
                    "test1": [
                        "Welfare catering", "Transport catering", "Hotels", "Restaurants", "Pubs", "Bars",
                        "Cafes", "Fast food outlets", "Schools", "Prisons", "Eat-in", "Waiter service"
                    ],
                    "test2": ["eat in", "reception", "bar", "café", "beverages", "takeaway", "subsidised"],
                    "test3": ["false", "false", "true", "false", "true"],
                    "test4": ["SE", "BE", "SE", "SE", "BE", "BE"],
                    "test5": [
                        "answer6", "answer1", "answer2", "answer3",
                        "answer7", "answer5", "answer4", "answer8"
                    ],
                    "test6": [
                        "answer1", "answer6", "answer2", "answer4",
                        "answer7", "answer5", "answer8", "answer3"
                    ],
                    "test7": ["c", "a", "d", "b", "g", "e", "f", "i", "h"],
                    "test8": ["e", "f", "b", "c", "a", "d"]
                },
                {
                    "test1": ["h", "n", "k", "a", "l", "d", "f", "i", "m", "b", "e", "o", "c", "g", "p", "j"],
                    "test2": ["", "", "", "", "", "", "", "", "", "", "", "", "", "", "", ""],
                    "test3": ["3", "1", "3", "2", "2", "1"],
                    "test4": ["false", "true", "true", "true", "false", "true", "false", "false", "true"],
                    "test5": ["c", "a", "a", "b", "b", "c", "a", "a", "b", "c"],
                    "test6": [
                        "answer5", "answer7", "answer1", "answer3", "answer9", "answer6", "answer8",
                        "answer10", "answer11", "answer2", "answer4"
                    ],
                    "test7": ["answer3", "answer2", "answer5", "answer4", "answer1"]
                },
                {
                    "test1": ["c", "d", "a", "b"],
                    "test2": ["answer1", "answer3", "answer2", "answer4"],
                    "test3": ["false", "true", "false", "true", "false", "false", "true"],
                    "test4": [
                        "reserved a table", "follow me", "get you anything", "like a tonic water", "do you prefer",
                        "send a waiter over", "have a starter", "share the food", "good health"
                    ],
                    "test5": ["a", "b", "a", "b", "a", "a", "c", "a", "c", "b"],
                    "test6": [
                        "answer7", "answer2", "answer1", "answer4", "answer3", "answer8",
                        "answer5", "answer10", "answer9", "answer6"
                    ],
                    "test7": [
                        "I can take your order now.", "Can we have two steaks?", "Would you like any vegetables?",
                        "Yes, some potatoes and peas please", "Anything to drink with that?", "We'd like a mineral water and a lemonade, please"
                    ],
                    "test8": [
                        "answer2", "answer8", "answer1", "answer3", "answer4", "answer15", "answer10", "answer6",
                        "answer5", "answer12", "answer11", "answer9", "answer7", "answer13", "answer15"
                    ]
                },
                {
                    "test1": ["3", "2", "1"],
                    "test2": ["false", "true", "false", "false", "true", "false", "true", "true", "false", "false", "true"],
                    "test3": ["Reduction", "Stewing", "Sautéing", "Stuffing"],
                    "test4": ["Reduction", "Stewing", "Sautéing", "Stuffing"],
                    "test5": ["answer1", "answer6", "answer7", "answer5", "answer2", "answer3", "answer4"],
                    "test6": ["answer1", "answer5", "answer2", "answer3", "answer4", "answer6", "answer7"],
                    "test7": ["Rabbit", "", "", "", "", "", "", "", "", "", "", ""],
                    "test8": ["5", "2", "1", "4", "7", "3", "6"],
                    "test9": ["Preheat", "Rinse", "Remove", "Place", "Prepare", "Mix", "Melt", "Cook", "Stir"],
                    "test10": ["Mix", "Season", "Scoop", "Rub", "Cover", "Roast", "Reaches"]
                },
                {
                    "test1": ["true", "true", "false", "true", "false"],
                    "test2": ["answer1", "answer14", "answer3", "answer7", "answer10", "answer12", "answer11",
                        "answer6", "answer6", "answer5", "answer9", "answer13", "answer8"
                    ],
                    "test3": ["3", "4", "2", "5", "1"],
                    "test4": ["answer4", "answer2", "answer3", "answer1", "answer5", "answer6", "answer7", "answer8"]
                },
                {
                    "test1": ["answer3", "answer1", "answer2", "answer5", "answer4"],
                    "test2": ["popular", "design", "watch", "prepare", "meals", "features", "think", "truth",
                        "magnified", "having", "workflow", "plating"
                    ],
                    "test3": ["The island at the center", "Zoning Regulations in the Kitchen", "The Assembly Line Layout",
                        "The Prep restaurant kitchen layout", "The Ergonomic Kitchen Configuration"
                    ],
                    "test4": ["Ergonomics kitchen design.", "Good ventilation.", "Easy to maintain.",
                        "Equipment that meets standards of health and safety.", "Energy efficiency.",
                        "The appropriate size of the commercial kitchen."
                    ]
                }
            ]
        }
    ]
}