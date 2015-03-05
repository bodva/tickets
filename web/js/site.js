function upvote(id) {
    console.log('up');
    $.get('/ticket?type=up&id='+id, function(response){
        var obj = JSON.parse(response);
        console.log(obj);
        if (obj.errors.length < 1){
            $('#col-rating-'+id).html(obj.rating);
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
        }
    });
    return false;
}