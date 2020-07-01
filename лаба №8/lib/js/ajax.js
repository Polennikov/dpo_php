
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
        $('#adress_text').click(
        function () {
            $('#adress_text').removeClass('errorMessage');
            return false;
        }
    )
});

function validateForm() {
   var flag = true;
    // Проверка на пустоту
    if ($('#adress_text').val().length == 0) {
        flag = false;
        $('#adress_text').addClass('errorMessage');
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
            var coord=result.сoordinates.split(" ");
            latitude=parseFloat(coord[0]);
            longitude=parseFloat(coord[1]);
                            ymaps.ready(init(latitude,longitude));
                $('#result_form').html(
                    '<br>Адрес: ' + result.adress_text + 
                    '<br>Координаты: ' +  result.сoordinates+
                    '<br>Ближайшее метро: ' +  result.underground);

        },

        error: function (response) { // Данные не отправлены
            $('#result_form').html('Ошибка. Данные не отправлены.');
        }
    });
}
function init(latitude,longitude) {
 
    // Создание карты.
    var myMap = new ymaps.Map("map", {
        center: [longitude, latitude],
        zoom: 12,
    });
 
    // Строка с адресом, который необходимо геокодировать
    var address = $('#adress_text').val();
 
    // Ищем координаты указанного адреса
    // https://tech.yandex.ru/maps/doc/jsapi/2.1/ref/reference/geocode-docpage/
    var geocoder = ymaps.geocode(address);
 
    // После того, как поиск вернул результат, вызывается callback-функция
    geocoder.then(
        function (res) {
 
            // координаты объекта
            var coordinates = res.geoObjects.get(0).geometry.getCoordinates();
 
            // Добавление метки (Placemark) на карту
            var placemark = new ymaps.Placemark(
                coordinates, {
                    'hintContent': address
                }, {
                    'preset': 'islands#redDotIcon'
                }
            );
 
            myMap.geoObjects.add(placemark);
        }
    );
 
}