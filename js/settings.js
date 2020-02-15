$(document).ready(function()
{
    /*
     * Save Website Config Data
     */
    $("#formConfig").submit(function(e)
    {
        var info = new FormData(this);
        info.append("ajax", true);

        $.ajax({
           type: "POST",
            url: "settings/updateValues",
            data: info,
            processData: false,
            contentType: false,
            success: function(result)
            {
                if(result == 'success')
                {
                    Notice("success", true);
                }
                else
                {
                    console.log(result);
                }
            }
        });

        e.preventDefault();
    });
});