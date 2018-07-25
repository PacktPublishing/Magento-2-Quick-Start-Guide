define([
        'jquery',
        'Magelicious_Jsco/js/popular-products',
        'ko',
        'mage/translate',
    ], function ($, popularProductsComponent, ko, $t) {
        'use strict';
        return popularProductsComponent.extend({
            getTitle: function () {
                return 'NEW | ' + this._super();
            }
        });
    }
);