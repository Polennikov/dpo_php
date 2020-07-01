<?php
$Apikey = "ВАШ API";

    $paramAddress = [
            'geocode' => $_POST["adress_text"], // адрес
            'format' => 'json', // формат ответа
            'results' => 1, // количество выводимых результатов
            'apikey' => $Apikey
        ];
        $Address = requestApi($paramAddress);

        //координаты
        $tmp = $Address['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['Point']['pos'];
        if ($tmp) {
            $Coordinates=$tmp;
        } else {
            $Coordinates='Координаты не найдены';
        }
        //адрес
        $tmp =$Address['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['metaDataProperty']['GeocoderMetaData']['Address']['formatted'];
        if ($tmp) {
            $Address_struct=$tmp;
        } else {
            $Address_struct='Структурированный адрес не найден';
        }

        $paramUnder = [
            'geocode' => $Coordinates, // адрес
            'format' => 'json', // формат ответа
            'results' => 1, // количество выводимых результатов
            'kind' => 'metro', // топонима по метро
            'apikey' => $Apikey
        ];

        $Under = requestApi($paramUnder);

        //метро
        $tmp = $Under['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['name'];
        if ($tmp) {
            $underground=$tmp;
        } else {
            $underground='Метро в данной области не найдено';
        }

        function requestApi(array $param)
    {
        $info = file_get_contents('https://geocode-maps.yandex.ru/1.x/?' . http_build_query($param));
        return json_decode($info, true);
    }
 $result = array(     
                'adress_text' => $Address_struct,
                'сoordinates' => $Coordinates,
                'underground' => $underground, 
            );

            echo json_encode($result);
