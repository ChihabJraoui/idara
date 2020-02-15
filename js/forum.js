$(document).ready(function()
{

    var body = $('body');

    /*
     *  GET ADD FORM
     */

    $("#btn-add-forum").click(function()
    {
        $.ajax({
            type: "GET",
            url: "forum/add",
            success: function(result)
            {
                var dialog = new SBox({
                    direction: 'rtl',
                    size: 'sm',
                    title: 'لإضافة منتدى جديد',
                    content: result,
                    showConfirmButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'إضافة',
                    cancelButtonText: 'إلغاء',
                    closeOnConfirm: false,
                    spinner: true,
                    confirm: function()
                    {
                        $('#formAddForum').submit();
                    }
                });

                dialog.open();
            }
        });
    });




    /*
     *  SUBMIT Add Forum
     */
    body.on('submit', "#formAddForum", function(e)
    {
        var name = $('#text-name').val();
        var catId = $('#select-catId').val();
        var desc = $('#text-desc').val();

        // Verification
        if(name.length == 0)
        {
            alert('المرجوا إدخال اسم للمنتدى');
            return false;
        }
        if(catId == 0)
        {
            alert('المرجوا اختيار الفئة');
            return false;
        }
        if(desc.length == 0)
        {
            alert('المرجوا إدخال وصف المنتدى');
            return false;
        }

        // get form data
        var data = new FormData(this);
        data.append("ajax", true);

        $.ajax({
            type: "POST",
            url: "forum/add",
            data: data,
            processData: false,
            contentType: false,
            dataType: 'text',
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
     *  GET Edit Form
     */

    $("[data-forum-edit]").on("click", function()
    {
        var forumId = $(this).attr("data-forum-edit");

        $.ajax({
            type: "POST",
            url: "forum/edit",
            data: {
                forumID: forumId
            },
            success: function (result)
            {
                var dialog = new SBox({
                    direction: 'rtl',
                    size: 'sm',
                    title: "تعديل المنتدى",
                    content: result,
                    showConfirmButton: true,
                    showCancelButton: true,
                    cancelButtonText: 'إلغاء',
                    confirmButtonText: 'تعديل',
                    closeOnConfirm: false,
                    spinner: true,
                    confirm: function()
                    {
                        $('#formEditForum').submit();
                    }
                });

                dialog.open();
            }
        });
    });



    /*
     *  SUBMIT Add Forum
     */
    body.on('submit', "#formEditForum", function(e)
    {
        var catId = $('#select-catId:selected');

        console.log(catId);

        //if($('#select-catId').val() == 0)
        //{
        //    alert('المرجوا اختيار الفئة');
        //    return false;
        //}

        //var data = new FormData(this);
        //data.append("ajax", true);
        //
        //$.ajax({
        //    type: "POST",
        //    url: "forum/edit",
        //    data: data,
        //    processData: false,
        //    contentType: false,
        //    dataType: 'text',
        //    success: function(result)
        //    {
        //        if(result == 'success')
        //        {
        //            window.location.reload();
        //        }
        //        else
        //        {
        //            console.log(result);
        //        }
        //    }
        //});

        e.preventDefault();
    });



    /*
     * Delete Forum
     */

    $("[data-forum-delete]").on("click", function()
    {
        var forumId = $(this).attr("data-forum-delete");

        swal({
            title: '',
            text: 'هل تريد حذف المنتدى ؟',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'نعم',
            cancelButtonText: 'لا'
        }).then(function()
        {
            $.ajax({
                type: "POST",
                url: "forum/delete",
                data: {
                    ajax: true,
                    forumId: forumId
                },
                success: function (result)
                {
                    if(result == 'success')
                    {
                        $("#forum-" + forumId).fadeOut(1000);
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
     * Save Forums Order
     *
     */
    $("#formForumOrder").submit(function(e)
    {
        var data = new FormData($(this)[0]);
        data.append('ajax', true);

        $.ajax({
            type: "POST",
            url: "forum/order",
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