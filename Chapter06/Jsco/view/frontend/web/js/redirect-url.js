define([
    'jquery',
    'jquery/ui',
    'mage/redirect-url'
], function ($) {
    'use strict';

    $.widget('magelicious.redirectUrl', $.mage.redirectUrl, {
        /* Override of parent _onEvent method */
        _onEvent: function () {
            // Call parent's _onEvent() method if needed
            console.log('raw extend')
            return this._super();
        }
    });

    return $.magelicious.redirectUrl;
});