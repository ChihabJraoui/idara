$(document).ready(function()
{
    $("#formLogin").submit(function(e)
    {
        var pseudo = $("#pseudo").val();
        var password = $("#password").val();
        var spinner = new Spinner({
            size: 'sm',
            target: '#btn-login'
        });

        // TODO: verification

        var data = new FormData($(this)[0]);
        data.append('ajax', true);



        $.ajax({
            type: "POST",
            url: "login/login",
            data: data,
            contentType: false,
            processData: false,
            beforeSend: function()
            {
                $("#btn-login").prop("disabled", true);
                spinner.open();
            },
            success: function(result)
            {
                if(result.success == 1)
                {
                    window.location = "index";
                }
                else
                {
                    $("#btn-login").prop("disabled", false);
                    spinner.close();
                    console.log(result.message);
                }
            }
        });


        e.preventDefault();
    });
});