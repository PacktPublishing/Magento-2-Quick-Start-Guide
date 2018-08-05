define(
    [
        'ko',
        'uiComponent',
        'underscore',
        'Magento_Checkout/js/model/step-navigator',
        'jquery',
        'mage/translate',
        'mage/url'
    ],
    function (
        ko,
        Component,
        _,
        stepNavigator,
        $,
        $t,
        url
    ) {
        'use strict';

        let checkoutConfigOrderNotes = window.checkoutConfig.orderNotes;

        return Component.extend({
            defaults: {
                template: 'Magelicious_OrderNotes/order/notes'
            },

            isVisible: ko.observable(true),
            initialize: function () {
                this._super();
                stepNavigator.registerStep('order_notes', null, $t('Order Notes'), this.isVisible, _.bind(this.navigate, this), 15);
                return this;
            },

            getTitle: function () {
                return checkoutConfigOrderNotes.title;
            },

            getHeader: function () {
                return checkoutConfigOrderNotes.header;
            },

            getFooter: function () {
                return checkoutConfigOrderNotes.footer;
            },

            getNotesOptions: function () {
                return checkoutConfigOrderNotes.options;
            },

            getCheckoutConfigOrderNotesTime: function () {
                return checkoutConfigOrderNotes.time;
            },

            setOrderNotes: function (valObj, event) {
                if (valObj.code == 'other') {
                    $('[name="order_notes"]').val('');
                } else {
                    $('[name="order_notes"]').val(valObj.value);
                }
                return true;
            },

            navigate: function () {
                // Code to trigger when landing on our step
            },

            navigateToNextStep: function () {
                if ($(arguments[0]).is('form')) {
                    $.ajax({
                        type: 'POST',
                        url: url.build('ordernotes/index/process'),
                        data: $(arguments[0]).serialize(),
                        showLoader: true,
                        complete: function (response) {
                            stepNavigator.next();
                        }
                    });
                }
            }
        });
    }
);