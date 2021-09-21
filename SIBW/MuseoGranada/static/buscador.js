$(document).ready(function () {
    $('#search').focus()

    $('#search').on('keyup', function () {
        var search = $('#search').val()
        $.ajax({
                type: 'POST',
                url: 'search.php?user=0',
                data: {
                    'search': search
                },
                beforeSend: function () {
                    $('#result').html('<img src="static/img/search.png">')
                }
            })
            .done(function (resultado) {
                $('#result').html(resultado)
            })
            .fail(function () {
                alert('Hubo un error :(')
            })
    })
})
