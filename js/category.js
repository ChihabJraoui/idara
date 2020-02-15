$(document).ready(function()
{
    var body = $('body');


    /*
     *  SUBMIT Add FORM
     */

    $("#btn-add-cat").click(function()
    {
        $.ajax({
            type: "GET",
            url: "category/add",
            success: function(result)
            {
                var modal = new SBox({
                    direction: 'rtl',
                    size: 'sm',
                    title: '',
                    content: result,
                    showConfirmButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'إضافة',
                    cancelButtonText: 'إلغاء',
                    closeOnConfirm: false,
                    spinner: true,
                    confirm: function()
                    {
                        $('#formAddCat').submit();
                    }
                });

                modal.open();
            }
        });
    });



    /*
     *  SUBMIT Add FORM
     */

    body.on('submit', "#formAddCat", function(e)
    {
        var info = new FormData(this);
        info.append("ajax", true);

        $.ajax({
            type: "POST",
            url: "categories/add",
            data: info,
            processData: false,
            contentType: false,
            context: this,
            success: function(result)
            {
                if(result == 'success')
                {
                    window.location.reload();
                }
                else
                {
                    console.log(result);
                }
            }
        });

        e.preventDefault();
    });




    /*
     * Edit Category
     */

    $("[data-cat-edit]").on("click", function()
    {
        var catID = $(this).attr("data-cat-edit");

        $.ajax({
            type: "POST",
            url: "categories/edit",
            data: {
                catId: catID
            },
            success: function(result)
            {
                var sb = new SBox({
                    direction: 'rtl',
                    size: 'sm',
                    title: "تعديل الفئة",
                    content: result,
                    showConfirmButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'تعديل',
                    cancelButtonText: 'إلغاء',
                    closeOnConfirm: false,
                    spinner: true,
                    confirm: function()
                    {
                        $('#formEditCat').submit();
                    }
                });

                sb.open();
            }
        });
    });



    /*
     *  SUBMIT EDIT FORM
     */
    body.on('submit', '#formEditCat', function(e)
    {
        var info = new FormData(this);
        info.append("ajax", true);

        $.ajax({
            type: "POST",
            url: "categories/update",
            data: info,
            processData: false,
            contentType: false,
            success: function(result)
            {
                if(result == 'success')
                {
                    window.location.reload();
                }
                else
                {
                    console.log(result);
                }
            }
        });

        e.preventDefault();
    });



    /*
     * Delete Category
     */
    $("[data-cat-delete]").on("click", function()
    {
        var catID = $(this).attr("data-cat-delete");

        swal({
            title: "",
            text: "هل تريد حذف الفئة ؟",
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: "لا",
            confirmButtonText: "نعم"
        }).then(function()
        {
            $.ajax({
                type: "POST",
                url: "categories/delete",
                data: {
                    catID: catID,
                    ajax: true
                },
                success: function(result)
                {
                    if(result == 'success')
                    {
                        $("#cat-" + catID).slideUp(600);
                    }
                    else
                    {
                        console.log(result);
                    }
                }
            });
        });
    });


    /*
     * Save Categories Order
     *
     */
    $("#formCatOrder").submit(function(e)
    {
        var data = new FormData($(this)[0]);
        data.append('ajax', true);

        $.ajax({
            type: "POST",
            url: "categories/order",
            data: data,
            processData: false,
            contentType: false,
            success: function(result)
            {
                if(result == 'success')
                {
                    Notice("Success", true);
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