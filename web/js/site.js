function upvote(id) {
    console.log('up');
    $.get('/ticket?type=up&id='+id, function(response){
        var obj = JSON.parse(response);
        console.log(obj);
        if (obj.errors.length < 1){
            $('#col-rating-'+id).html(obj.rating);
            if (obj.remaining > parseInt($('#remaining-votes').html()) ) {
                $('#col-rating-'+id).parent().children().first().children('.glyphicon-arrow-up').removeClass('active');
            } else {
                $('#col-rating-'+id).parent().children().first().children('.glyphicon-arrow-up').addClass('active');
            }
            $('#remaining-votes').html(obj.remaining);
        }
    });
    return false;
}

function downvote(id) {
    console.log('down');
    $.get('/ticket?type=down&id='+id, function(response){
        var obj = JSON.parse(response);
        console.log(obj);
        if (obj.errors.length < 1){
            $('#col-rating-'+id).html(obj.rating);
            if (obj.remaining > parseInt($('#remaining-votes').html()) ) {
                $('#col-rating-'+id).parent().children().first().children('.glyphicon-arrow-down').removeClass('active');
            } else {
                console.log(id);
                $('#col-rating-'+id).parent().children().first().children('.glyphicon-arrow-down').addClass('active');
            }
            $('#remaining-votes').html(obj.remaining);
        }
    });
    return false;
}