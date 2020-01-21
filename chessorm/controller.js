function Operations(event){
    event.preventDefault();
    document.getElementById('menu').style.display = 'none';
    var operation = document.getElementById("operation").value;
    switch (operation) {
        case '1':
            document.getElementById('tableOperations').style.display = 'block';
            break;
        case "2":
            $.post(
                "Random.php",
                onAjaxSuccess
            );

            function onAjaxSuccess(data)
            {
                showTable.insertAdjacentHTML('beforeend', data + '<br>');
                showTable.insertAdjacentHTML('beforeend', '<button onclick="location.reload()">В главное меню</buttonon>' );
            }
            break;
        case '3':
            document.getElementById('ranks').style.display = 'block';
            break;
    }
}
function tableOperations(event){
    event.preventDefault();
    document.getElementById('tableOperations').style.display = 'none';
    var table = document.getElementById("table").value;
    var operation = document.getElementById("operationForTable").value;

    var tables ={'1': 'Players', '2': 'Matches', '3': 'Player_rank', '4': 'Chess_club'}

    var operations ={'1': 'Insert', '2': 'Update', '3': 'Delete', '4': 'Show'}

    $.post(
        "model.php",
        {
            table: tables[table],
            operation: operations[operation]
        },
        onAjaxSuccess
    );

    function onAjaxSuccess(data)
    {
        data = JSON.parse(data);
        data.forEach(function (element) {
            for (var key in element) {
                if(isNaN(key)){
                    showTable.insertAdjacentHTML('beforeend', key + ': '+  element[key] +'</br>' );
                }
            }
            showTable.insertAdjacentHTML('beforeend', '</br>' );
        })
        showTable.insertAdjacentHTML('beforeend', '<button onclick="location.reload()">В главное меню</buttonon>' );
    }

}

function FindWithRating(event){
    event.preventDefault();
    document.getElementById('ranks').style.display = 'none';
    var minRating = document.getElementById("minRating").value;
    var maxRating = document.getElementById("maxRating").value;

    $.post(
        "model.php",
        {
            operation: 'findDiap',
            maxRank: minRating,
            minRank: maxRating
        },
        onAjaxSuccess
    );

    function onAjaxSuccess(data)
    {
        data = JSON.parse(data);
        data.forEach(function (element) {
            for (var key in element) {
                if(isNaN(key)){
                    showTable.insertAdjacentHTML('beforeend', key + ': '+  element[key] +'</br>' );
                }
            }
            showTable.insertAdjacentHTML('beforeend', '</br>' );
        })
        showTable.insertAdjacentHTML('beforeend', '<button onclick="location.reload()">В главное меню</buttonon>' );
    }
}
