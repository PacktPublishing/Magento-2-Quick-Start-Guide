define([
        'jquery',
        'uiComponent',
        'ko',
        'mage/translate'
    ], function ($, Component, ko, $t) {
        'use strict';
        return Component.extend({
            defaults: {
                template: 'Magelicious_Jsco/popular-products',
                title: $t('Popular Products'),
                products: [],
            },
            getTitle: function () {
                return this.title;
            }
        });
    }
);