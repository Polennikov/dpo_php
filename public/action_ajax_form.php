<?php

require('connect_Db.php');

// проверим есть ли такой пользователь если да, то проверить, что заявка была более часа назад
$massRow = array();
$sql = 'SELECT * FROM "formTable" WHERE email=:email';
$result = $dbconn->prepare($sql);
$result->bindValue(':email', $_POST["email"]);
$result->execute();
while ($row = $result->fetch()) {
    array_unshift($massRow, $row);
}
if (count($massRow) != 0) {
    $time = time();
    foreach ($massRow as $Row) {
        $date1 = date('Y-m-d H:i:s', $time - 3600);
        $date2 = date('Y-m-d H:i:s', strtotime($Row[6]));
        if (strtotime($date1) >= strtotime($date2)) {
            $sql = 'INSERT INTO "formTable"(
            "firstName", surname, "middleName", email, "numberPhone", comments_text, 
            date_send) 
            VALUES(
            :firstName, 
            :surname, 
            :middleName, 
            :email, 
            :numberPhone,
            :comments_text, 
            :date_send)';
            $result = $dbconn->prepare($sql);
            $result->bindValue(':firstName', $_POST['firstName']);
            $result->bindValue(':surname', $_POST['surname']);
            $result->bindValue(':middleName', $_POST['middleName']);
            $result->bindValue(':email', $_POST['email']);
            $result->bindValue(':numberPhone', $_POST['numberPhone']);
            $result->bindValue(':comments_text', $_POST['comments_text']);
            $result->bindValue(':date_send', date('Y-m-d H:i:s'));
            $result->execute();
            $dataRow = $result->fetchObject();
            $time = time();
// Формируем массив для JSON ответа
            $result = array(
                'error' => true,
                'firstName' => $_POST["firstName"],
                'surname' => $_POST["surname"],
                'middleName' => $_POST["middleName"],
                'email' => $_POST["email"],
                'numberPhone' => $_POST["numberPhone"],
                'message' => 'С Вами свяжутся ' .
                    date('Y-m-d') .
                    ' после ' . date('H:i:s', $time + 5400)
            );

            // отправляем данные на почту
            $to = "art.polennikov@mail.ru";
            $subject = "Message";
            $message = $result['surname'] . ' ' . $result['firstName'] . ' ' . $result['middleName'] . '  ' . $result['message'];
            mail($to, $subject, $message);
            // Переводим массив в JSON
            echo json_encode($result);
            break;
        } else {
            $diference = strtotime($date2) - strtotime($date1); // разница между двумя датами в секундах
            $minutes = $diference / 60; // секунды в минутах
            $result = array(
                'error' => false,
                'message' => 'Вы можете отправить форму через: ' . floor($minutes) . ' минут',

            );

            // Переводим массив в JSON
            echo json_encode($result);
            break;
        }
    }
} else {
    $sql = 'INSERT INTO "formTable"(
            "firstName", surname, "middleName", email, "numberPhone", comments_text, 
            date_send) 
            VALUES(
            :firstName, 
            :surname, 
            :middleName, 
            :email, 
            :numberPhone,
            :comments_text, 
            :date_send)';
    $result = $dbconn->prepare($sql);
    $result->bindValue(':firstName', $_POST['firstName']);
    $result->bindValue(':surname', $_POST['surname']);
    $result->bindValue(':middleName', $_POST['middleName']);
    $result->bindValue(':email', $_POST['email']);
    $result->bindValue(':numberPhone', $_POST['numberPhone']);
    $result->bindValue(':comments_text', $_POST['comments_text']);
    $result->bindValue(':date_send', date('Y-m-d H:i:s'));
    $result->execute();
    $dataRow = $result->fetchObject();
    $time = time();
// Формируем массив для JSON ответа
    $result = array(
        'error' => true,
        'firstName' => $_POST["firstName"],
        'surname' => $_POST["surname"],
        'middleName' => $_POST["middleName"],
        'email' => $_POST["email"],
        'numberPhone' => $_POST["numberPhone"],
        'message' => 'С Вами свяжутся ' .
            date('Y-m-d') .
            ' после ' . date('H:i:s', $time + 5400)
    );

    // отправляем данные на почту
    $to = "art.polennikov@mail.ru";
    $subject = "Message";
    $message = $result['surname'] . ' ' . $result['firstName'] . ' ' . $result['middleName'] . '  ' . $result['message'];
    mail($to, $subject, $message);
    // Переводим массив в JSON
    echo json_encode($result);

}
