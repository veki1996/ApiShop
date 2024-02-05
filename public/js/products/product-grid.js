'use script'

let showAll = false;
let $viewAllBtn = $('.view-btn');

$(".productBox").hide();
$(".productBox").slice(0, 6).show();
$(".productBox.full-size").show();


function showGrades() {
    var gradeElements = $('.grade');
    gradeElements.each(function (index, element) {
        var randomGrade = (Math.random() * 0.5) + 4.5;

        $(element).text(randomGrade.toFixed(1));

        if (parseFloat($(element).text()) !== 5.0) {

            $(element).closest('.product-box-stars').find('img:last').attr('src', `${app_url}/static/rating.png`);
        } else {
            $(element).closest('.product-box-stars').find('img:last').attr('src', `${app_url}/static/grade.png`);
        }
    });
}

showGrades();