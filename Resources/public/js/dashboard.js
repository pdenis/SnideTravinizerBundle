$(document).ready(function () {
    setInterval(function () {
        $.ajax({
            url: $("#infos").data('rel')
        }).done(function (response) {
                $('#content').html(response);
            });
    }, $('#infos').data('timer') * 1000);

    $('#category').on('change', function () {
        if ($(this).val() == '') {
            $('.test-table').find('tr').show();
        } else {
            $('.test-table').find('tr').hide();
            $('.test-table').find('tr.' + $(this).val()).show();
        }
    });
});