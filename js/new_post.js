$( "#post_form" ).submit(function( event ) {
    event.preventDefault();

    let form = $('#post_form');
    let form_data = new FormData(this);

    var url = "api/user_add_post.php";

    console.log(form_data);

    $.ajax({
        url: url,
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,                         
        type: 'post',
        statusCode: {
            400: function(data) {
                console.log( data );
                $( "#post_form" ).trigger("reset");
            },
            200: function (data) {
                console.log(data);
                $( "#post_form" ).trigger("reset");
            }
        }
    });
});