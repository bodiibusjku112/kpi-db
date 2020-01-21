<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DB</title>
    <script src="jquery.min.js"></script>
    <script src="controller.js"></script>
</head>
<body>
<div id = 'menu'>
    1 - Insert/Update/Delete/Show.<br>
    2 - пакетне генерування рандомізованих даних в таблицю players.<br>
    3 - статичний пошук за атрибутами player rank<br>
    4 - динамічний пошук за атрибутами player rank<br>

    <form action="">
        <p><strong>Введіть номер операції:</strong></p>
        <p><input id='operation' ></p>
        <button onclick="Operations(event)">Запустити</button>
    </form>

</div>
<div id ='tableOperations' style="display: none;">
    <form action="">
        1 - players<br>
        2 - matches<br>
        3 - playerrank<br>
        4 - chessclub<br>
        <p><strong>Виберіть таблицю:</strong></p>
        <p><input id='table' ></p>
        1 - Insert<br>
        2 - Update<br>
        3 - Delete<br>
        4 - Show<br>
        <p><strong>Виберіть операцію:</strong></p>
        <p><input id="operationForTable" ></p>
        <button onclick="tableOperations(event)" id='submit'>Запустити</button>
    </form>
</div>
<div id = "showTable">

</div>
<div id = "ranks" style="display: none;">
    <p><strong>Видача гравців та їх звання по діапазону рейтингу:</strong></p>
    <p>Mінімальний рейтинг:</p>
    <p><input id="minRating" ></p>
    <p>Максимальний рейтинг:</p>
    <p><input id="maxRating"></p>
    <button onclick="FindWithRating(event)" id='submit'>Запустити</button>
</div>
</body>
</html>
