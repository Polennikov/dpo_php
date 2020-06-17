/* Article FructCode.com */
$(document).ready(function () {
    $('#send').click(
        function () {
            if (validateForm()) {
                sendAjaxForm('result_form', 'ajax_form', 'action_ajax_form.php');
                return false;
            }
            return false;
        }
    );

    $('#firstName').click(
        function () {
            $('#firstName').removeClass('errorMessage');
            return false;
        }
    )
    $('#surname').click(
        function () {
            $('#surname').removeClass('errorMessage');
            return false;
        }
    )
    $('#middleName').click(
        function () {
            $('#middleName').removeClass('errorMessage');
            return false;
        }
    )
    $('#email').click(
        function () {
            $('#email').removeClass('errorMessage');
            return false;
        }
    )
    $('#numberPhone').click(
        function () {
            $('#numberPhone').removeClass('errorMessage');
            return false;
        }
    )
});

function validateForm() {
    var flag = true;
    // Проверка на пустоту
    if ($('#firstName').val().length == 0) {
        flag = false;
        $('#firstName').addClass('errorMessage');
    }
    if ($('#surname').val().length == 0) {
        flag = false;
        $('#surname').addClass('errorMessage');
    }
    if ($('#middleName').val().length == 0) {
        flag = false;
        $('#middleName').addClass('errorMessage');
    }
    // дополнительная проверка Е-майла
    var reg = /^\w+([\.-]?\w+)*@(((([a-z0-9]{2,})|([a-z0-9][-][a-z0-9]+))[\.][a-z0-9])|([a-z0-9]+[-]?))+[a-z0-9]+\.([a-z]{2}|(com|net|org|edu|int|mil|gov|arpa|biz|aero|name|coop|info|pro|museum))$/i;
    if ($('#email').val().length == 0 || !reg.test($('#email').val())) {
        flag = false;
        $('#email').addClass('errorMessage');
    }
    // дополнительная проверка телефона
    var reg = /^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/;
    if ($('#numberPhone').val().length == 0 || !reg.test($('#numberPhone').val())) {
        flag = false;
        $('#numberPhone').addClass('errorMessage');
    }

    return flag;
}

function sendAjaxForm(result_form, ajax_form, url) {
    $('#ajax_form').addClass('display_none');
    $.ajax({
        url: url, //url страницы (action_ajax_form.php)
        type: "POST", //метод отправки
        dataType: "html", //формат данных
        data: $("#" + ajax_form).serialize(),  // Сеарилизуем объект
        success: function (response) { //Данные отправлены успешно
            result = $.parseJSON(response);
            if (result.error == true) {
                $('#result_form').html('Имя: ' + result.firstName + '<br>Фамилия: ' + result.surname +
                    '<br>Отчество: ' + result.middleName + '<br>Email: ' + result.email
                    + '<br>Телефон: ' + result.numberPhone + '  ' +
                    result.message);
            } else {
                $('#result_form').html(result.message);
            }
        },

        error: function (response) { // Данные не отправлены
            $('#result_form').html('Ошибка. Данные не отправлены.');
        }
    });
}