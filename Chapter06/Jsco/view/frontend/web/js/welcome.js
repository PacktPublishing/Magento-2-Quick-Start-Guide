define([
    'jquery',
    'mage/translate'
], function ($, $t) {
    'use strict';

    $.widget('magelicious.welcome', {
        _create: function () {
            this.element.text($t('Welcome ' + this.options.name));
        }
    });

    return $.magelicious.welcome;
});