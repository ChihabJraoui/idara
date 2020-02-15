/*
 * Javascript Modal Plugin
 *
 * Created By Chihab JRAOUI
 *
 * Version 0.1
 */


function Modal(type, options)
{
    this.options = {
        //ID
        id: null,

        // Direction
        direction: 'rtl',

        // Target
        appendTo: null,

        // Size
        size: null,

        // Content
        title: null,
        content: null,

        // apearrence
        zIndex: 1000,

        // Only for type "Confirm"
        showConfirmButton: true,
        showCancelButton: false,
        confirmButtonText: 'Okey',	    // Text for the submit button
        cancelButtonText: 'Cancel',		// Text for the cancel button
        confirm: null,				// Function to execute when clicking the submit button. By default jBox will use firstly the onclick and secondly the href attribute
        cancel: null,               // Function to execute when clicking the cancel button

        closeOnConfirm: true,

        // Other Options
        blockScroll: false
    };


    /* Default Options*/
    this.defaultOptions = {
        // Default options for modal windows
        'Modal': {
            appendTo: jQuery('body'),
            blockScroll: true
        },
        // Default options for modal confirm windows
        'Confirm': {
            appendTo: jQuery(window),
            blockScroll: true
        }
    };


    /* Set default options for Modal types */
    if (jQuery.type(type) == 'string')
    {
        this.type = type;
        type = this.defaultOptions[type];
    }


    /* Merge Options */
    this.options = jQuery.extend(true, this.options, type, options);


    /* get unique ID */
    if(this.options.id == null)
    {
        this.options.id = "modal-" + Modal.getUniqueID();
    }
    this.id = this.options.id;



    /*
     * Create Modal
     */
    this._create = function()
    {
        // create wrapper
        this.wrapper = jQuery('<div/>', {
            'id': this.id,
            'class': 'modal-wrapper'
        }).css('direction', this.options.direction);

        // create Modal Container
        this.table = jQuery('<div />', {
            'class': 'modal-table'
        }).appendTo(this.wrapper);

        // create Modal Container
        this.cell = jQuery('<div />', {
            'class': 'modal-cell'
        }).appendTo(this.table);

        // create Modal Box
        this.container = jQuery('<div />', {
            'class': 'container'
        }).appendTo(this.cell);

        // create Modal Box
        this.row = jQuery('<div />', {
            'class': 'row'
        }).appendTo(this.container);

        // create Modal Box
        this.column = jQuery('<div />', {
            'class': 'col-md-offset-3 col-md-6'
        }).appendTo(this.row);



        /*
         * create Modal Box
         */
        this.box = jQuery('<div />', {
            'class': 'modal-box'
        }).appendTo(this.column);



        /*
         * create Modal Box Heading
         */
        this.heading = jQuery('<div />', {
            'class': 'modal-box-heading'
        }).appendTo(this.box);

        this.title = jQuery('<span/>', {
            'class': 'title',
            'text': this.options.title
        }).appendTo(this.heading);



        /*
         * create Modal Box Body
         */
        this.body = jQuery('<div />', {
            'class': 'modal-box-body',
            'html': this.options.content
        }).appendTo(this.box);

        // create Modal Box Footer
        this.footer = jQuery('<div />', {
            'class': 'modal-box-footer',
            'html': ''
        }).appendTo(this.box);



        /*
         * create Confirm Button
         */
        this.confirmButton = jQuery('<button />', {
            'class': 'btn btn-success',
            'text': this.options.confirmButtonText
        }).on('click', function()
        {
            this.options.confirm();

            if(this.options.closeOnConfirm)
            {
                this.close();
            }
        }.bind(this));

        this.confirmButton.appendTo(this.footer);


        /*
         * create Cancel Button
         */
        this.cancelButton = jQuery('<button />', {
            'class': 'btn btn-default',
            'text': this.options.cancelButtonText
        }).on('click', function()
        {
            this.close();
        }.bind(this));

        this.cancelButton.appendTo(this.footer);


        /*
         * create Close Button
         */
        this.closeButton = jQuery('<a />', {
            'class': this.options.direction == 'rtl' ? 'left-close' : 'right-close' ,
            'href': 'javascript:',
            'html': '<i class="material-icons">clear</i>'
        }).on('click', function()
        {
            this.close();
        }.bind(this));

        this.closeButton.appendTo(this.heading);



        // Attach Modal To Body
        this.wrapper.appendTo(this.options.appendTo);
    };
}



/* Detach Modal From Body Element */
Modal.prototype.detach = function()
{
    $('body').remove("#" + this.id);
};



/*
 * Close & Delete Modal From the DOM
 */
Modal.prototype.close = function()
{
    // Detach
    this.detach();

    // remove
    $("#" + this.id).remove();
};



/*
 * Open Modal
 */
Modal.prototype.open = function()
{
    this._create();
};



/* Get Unique ID */
Modal.getUniqueID = (function()
{
    var i = 1;
    return function()
    {
        return i++;
    };
}());