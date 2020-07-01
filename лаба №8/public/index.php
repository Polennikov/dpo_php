<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>GEO</title>
    <meta name="description" content="Article FRUCTCODE.COM. How to send ajax form.">
    <meta name="author" content="fructcode.com">
    <link rel="stylesheet" href="../lib/css/main.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="ajax.js" type="text/javascript"></script>
    <script src="https://api-maps.yandex.ru/2.1/?apikey=ВАШ API&lang=ru_RU" type="text/javascript">
    </script>
</head>
<body>
<div class="container">
    <header>
        <div class="headerContent">
            <div class="textHeader">
                GEO
            </div>
        </div>
    </header>
    <section>
        <div class="ContentSection">
            <form method="post" id="ajax_form" class="Content" action="">
                <h3>Введите адрес:</h3>
                <textarea type="text" name="adress_text" id="adress_text"></textarea>
                <div>
                    <input type="submit" name="send" id="send" value="ОК" class="button7"></input>
                </div>
            </form>
            <div id="result_form">
            </div>
        </div>
        <div class="ContentSection">
            <div class="Content">
                <div id="map" style="width: 600px; height: 400px"></div>
            </div>
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