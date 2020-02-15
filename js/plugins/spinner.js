/***************************************
 *     Created by : Chihab JRAOUI
 *           Date : 06/01/2016
 *        Version : 1.0
 ***************************************/

function Spinner(options)
{
    /* All Options */
    this.options = {
        //ID
        id: null,

        // Size
        size: null,

        // Text
        text: null,

        // Target
        target: null,

        // Delays
        delay: 0,

        // loading icons
        icon: "images/loading.gif",

        // Other Options
        blockScroll: false
    };


    /* Initialize with default options */
    this.defaultOptions = {
        // Size
        size: 'lg',

        // Text
        text: 'loading ...',

        // Target
        target: 'body',

        // Delays (s)
        delay: 1
    };


    /* Merge Options */
    this.options = jQuery.extend(true, this.options, this.defaultOptions, options);


    /* get unique ID */
    if(this.options.id == null)
    {
        this.options.id = "Spinner-" + Spinner.getUniqueID();
    }
    this.id = this.options.id;


    /* Init Spinner */
    this._init = function()
    {
        if(this.options.size == 'sm')
        {
            this.loadingIcon = this.options.icon;
        }
    };


    /* Create Spinner */
    this._create = function()
    {
        this._init();

        // Block Scroll
        if(this.options.target == 'body')
        {
            $('body').addClass('block-scroll');

            this.wrapper =
                '<div class="loader-wrapper-fixed" id="'+ this.id +'">' +
                '   <div class="loader">' +
                '       <div class="bounce1"></div>' +
                '       <div class="bounce2"></div>' +
                '       <div class="bounce3"></div>' +
                '   </div>' +
                '</div>';
        }
        else
        {
            if(this.options.size == 'lg')
            {
                $(this.options.target).css('position', 'relative');

                this.wrapper =
                    '<div class="loader-wrapper" id="'+ this.id +'">' +
                    '   <div class="loader">' +
                    '       <div class="bounce1"></div>' +
                    '       <div class="bounce2"></div>' +
                    '       <div class="bounce3"></div>' +
                    '   </div>' +
                    '</div>';
            }
            else
            {
                this.wrapper = '<img id="'+ this.id +'" src="' + this.loadingIcon + '" />';
            }
        }
    };
}


/* Detach Spinner From Target */
Spinner.prototype.detach = function()
{
    $(this.options.target).remove("#" + this.id);
};

/* Close Spinner */
Spinner.prototype.close = function()
{
    // Detach
    this.detach();

    // remove
    $("#" + this.id).remove();
};

/* Open Spinner */
Spinner.prototype.open = function()
{
    this._create();

    // Attach Spinner To Target
    $(this.options.target).prepend(this.wrapper);

    setTimeout(function(){}, this.options.delay);
};


/* Get Unique ID */
Spinner.getUniqueID = (function()
{
    var i = 1;
    return function()
    {
        return i++;
    };
}());
