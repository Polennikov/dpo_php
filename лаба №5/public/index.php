<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Student file sharing service Form</title>
    <meta name="description" content="Article FRUCTCODE.COM. How to send ajax form.">
    <meta name="author" content="fructcode.com">
    <link rel="stylesheet" href="../lib/css/main.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="ajax.js"></script>

</head>

<body>

<div class="container">
    <header>
        <div class="headerContent">
            <div class="textHeader">
                Student file sharing service Form
            </div>

        </div>
    </header>

    <section>
        <div class="ContentSection">
            <form method="post" id="ajax_form" class="Content" action="">
                <h3>Имя</h3>
                <input type="text" name="firstName" id="firstName">
                <h3>Фамилия</h3>
                <input type="text" name="surname" id="surname">
                <h3>Отчество</h3>
                <input type="text" name="middleName" id="middleName">
                <h3>Email</h3>
                <input type="email" name="email" id="email">
                <h3>Телефон</h3>
                <input type="text" name="numberPhone" id="numberPhone">
                <h3>Комментарий</h3>
                <textarea name="comments_text" id="comments_text"></textarea>
                <div>
                    <input type="submit" name="send" id="send" value="ОК" class="button7"></input>
                </div>
            </form>

            <div id="result_form"></div>
        </div>
    </section>

    <footer>
        <div class="headerContent">
            <div class="textHeader">
            </div>
        </div>
    </footer>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="../lib/js/ajax.js"></script>
</html>
