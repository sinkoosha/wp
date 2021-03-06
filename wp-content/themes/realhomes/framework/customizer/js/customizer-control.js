(function( $, api ) {
    /**
     * Updates the font weight select for selected font family.
     *
     * @since 3.15
     */
    const fontWeightAjax = function (to, selector) {
        $.ajax({
            url: ajaxurl,
            type: 'post',
            dataType: 'html',
            data: {
                action: 'inspiry_get_font_weights',
                family: to
            },
            success: function (response) {
                selector.empty().html(response);
            }
        });
    };

    api.bind( 'ready', function() {
        const customize = this;

        // Get heading font weight options select container.
        const headingFontWeightSelect = customize.control( 'inspiry_heading_font_weight' ).container.find( 'select' );
        customize('inspiry_heading_font', function (value) {
            value.bind(function (to) {
                fontWeightAjax(to, headingFontWeightSelect);
            });
        });

        // Get secondary font weight options select container.
        const secondaryFontWeightSelect = customize.control( 'inspiry_secondary_font_weight' ).container.find( 'select' );
        customize('inspiry_secondary_font', function (value) {
            value.bind(function (to) {
                fontWeightAjax(to, secondaryFontWeightSelect);
            });
        });

        // Get body font weight options select container.
        const bodyFontWeightSelect = customize.control( 'inspiry_body_font_weight' ).container.find( 'select' );
        customize('inspiry_body_font', function (value) {
            value.bind(function (to) {
                fontWeightAjax(to, bodyFontWeightSelect);
            });
        });
    } );
})( jQuery, wp.customize );