$(document).ready(function(){
    $('#login-form').on('submit', function(e){
        e.preventDefault();

        var email = $('#email').val();
        var password = $('#password').val();

        var message_span = $('#message');

        $.ajax({
            url: 'php/auth.php',
            type: 'post',
            data: {email: email, password: password},
            success: function(response){
                var data = JSON.parse(response);
                if (data.success) {
                    message_span.text(data.message);
                    message_span.attr("class","message");
                    message_span.addClass("success");
                    window.location.href = "index.php";
                } else {
                    // Login failed
                    message_span.text(data.message);
                    message_span.attr("class","message");
                    message_span.addClass("error");
                }
                
            },
            error: function(jqXHR, textStatus, errorThrown){
                message_span.text("Falha na conexão com o servidor.");
                message_span.attr("class","message");
                message_span.addClass("error");
            }
        });
    });
});