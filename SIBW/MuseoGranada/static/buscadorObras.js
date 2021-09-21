$(document).ready(function () {
    $('#search').focus()

    $('#search').on('keyup', function () {
        var search = $('#search').val()
        $.ajax({
                type: 'POST',
                url: 'buscadorObras.php',
                data: {
                    'search': search
                },
                beforeSend: function () {
                    $('#result').html('<img id="foto" src="static/img/search.png">')
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
