$(document).ready(function()
{
    /*
     * SideBar Collapse
     */
    $("#btn-sidemenu-collapse").click(function()
    {
        $("#sidemenu-collapse").toggleClass("in");
        $("#div-content").toggleClass("in");
    });




    /*
     * Hide / Show Toggle
     */

    $("[data-toggle=hidden]").mouseenter(function()
    {
        $(this).find("[data-target=hidden]").show();
    })
    .mouseleave(function()
    {
        $(this).find("[data-target=hidden]").hide();
    });




    /*
     * Select Album Picture
     */

    $("[data-toggle=select]").click(function()
    {
        $("[data-toggle=select]").not(this).removeClass("selected-photo");
        $(this).toggleClass("selected-photo");
    });




    /* 
     * BootStrap ToolTip
     */

    $("[data-toggle=\'tooltip\']").tooltip();




    /*
     * active tab
     */
    var isActive = true;
    $(window).blur(function()
    {
        isActive = false;
    });
    $(window).focus(function()
    {
        isActive = true;
    });
    

});