/*
 * Javascript Modal Plugin
 *
 * Created By Chihab JRAOUI
 *
 * Version 1.0
 */


function SBox(options)
{
    this.options = {
        //ID
        id: null,

        // Direction
        direction: 'ltr',

        // Target
        attach: null,                   // jquery selector
        trigger: 'click',

        // Size
        size: null,

        // Content
        title: null,
        content: null,

        // apearrence
        zIndex: 1000,

        // Only for type "Confirm"
        showConfirmButton: false,
        showCancelButton: false,
        confirmButtonText: 'Ok',	    // Text for the submit button
        cancelButtonText: 'Cancel',		// Text for the cancel button
        confirm: function() {},
        cancel: function() {},
        closeOnConfirm: true,

        closeButton: 'title',

        // Other Options
        blockScroll: false,

        // style
        cssClass: null,

        // Spinner
        spinner: false
    };



    /* Merge Options */
    this.options = jQuery.extend(true, this.options, options);



    /* get unique ID */
    if(this.options.id == null)
    {
        this.options.id = "sweetbox-" + SBox.getUniqueID();
    }

    this.id = this.options.id;



    /*
     *  Create
     */

    this._create = function()
    {

        /* Overlay */
        this.modal = $('<div/>', {
            'id': this.id,
            'class': 'sb-overlay'
        }).appendTo('body');


        /* Box */
        this.box = $('<div />', {
            'class': 'sb-box'
        }).appendTo(this.modal);


        /* Heading */
        var heading = jQuery('<div />', {
            'class': 'sb-box-heading'
        }).appendTo(this.box);


        /* Title */
        var title = jQuery('<span/>', {
            'class': 'sb-box-title',
            'text': this.options.title == null ? '' : this.options.title
        }).appendTo(heading);


        /* Body */
        var body = $('<div />', {
            'class': 'sb-box-body',
            'html': this.options.content
        }).appendTo(this.box);


        /* Footer */
        if(this.options.showConfirmButton || this.options.showCancelButton)
        {
            this.footer = jQuery('<div />', {
                'class': 'sb-box-footer'
            }).appendTo(this.box);


            /* Confirm Button */
            if(this.options.showConfirmButton)
            {
                this.confirmButton = $('<button />', {
                    'class': 'sb-confirm-button',
                    'text': this.options.confirmButtonText
                });

                this.confirmButton.appendTo(this.footer);
            }


            /* create Cancel Button */
            if(this.options.showCancelButton)
            {
                this.cancelButton = $('<button />', {
                    'class': 'sb-cancel-button',
                    'text': this.options.cancelButtonText
                });

                this.cancelButton.appendTo(this.footer);
            }
        }


        /* Close Button */
        this.closeButton = $('<a />', {
            'class': 'sb-close-button',
            'href': 'javascript:',
            'html': '&times;'
        }).appendTo(heading);


        /* Style */
        if(this.options.cssClass != null)
        {
            this.box.addClass(this.options.cssClass);
        }


        /* direction */
        if(this.options.direction == 'rtl')
        {
            this.box.attr('dir', this.options.direction);
            this.box.addClass('sb-rtl');
        }


        /* Size */
        if(this.options.size != null)
        {
            if(this.options.size == 'sm')
                this.box.addClass('sb-sm');

            if(this.options.size == 'md')
                this.box.addClass('sb-md');

            if(this.options.size == 'lg')
                this.box.addClass('sb-lg');
        }

    };




    /*
     *  ATTACH
     */

    this._attach = function()
    {

        /* Confirm Button*/
        if(this.options.showConfirmButton)
        {
            this.confirmButton.on('click', function()
            {
                /* spinner*/
                if(this.options.spinner)
                {
                    this.spinner = $('<div />', {
                        'class': 'sb-spinner-wrapper'
                    }).appendTo(this.box);

                    $('<div />', {
                        'class': 'sb-spinner',
                        'html': '<div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div>'
                    }).appendTo(this.spinner);
                }

                this.options.confirm();

                if(this.options.closeOnConfirm)
                {
                    this.close();
                }

            }.bind(this));
        }


        /* Cancel Button*/
        if(this.options.showCancelButton)
        {
            this.cancelButton.on('click', function()
            {
                this.options.cancel();

                this.close();

            }.bind(this));
        }


        /* Close Button */
        this.closeButton.on('click', function()
        {
            this.close();

        }.bind(this));

    };



    if(this.options.attach != null)
    {
        this.options.attach.on(this.options.trigger, function()
        {
            this.open();

        }.bind(this));
    }

}




/*
 * Open Modal
 */

SBox.prototype.open = function()
{
    /* create */
    this._create();

    /* attach */
    this._attach();

    /* Body Block Scroll */
    $('body').addClass('sb-block-scroll');
};




/*
 *   Close & Delete Modal From the DOM
 */

SBox.prototype.close = function()
{
    /* Body Remove Block Scroll */
    $('body').removeClass('sb-block-scroll');

    // remove
    $("#" + this.id).remove();
};




/*
 *  Get Unique ID
 */

SBox.getUniqueID = (function()
{
    var i = 1;
    return function()
    {
        return i++;
    };
}());



// Make jBox usable with jQuery selectors
jQuery.fn.SBox = function(options)
{
    options = jQuery.extend(options, {attach: this});
    return new SBox(options);
};