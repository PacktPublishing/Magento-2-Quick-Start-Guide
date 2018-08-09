define([
    'uiComponent',
    'jquery',
    'mage/url',
    'Magento_Customer/js/customer-data',
    'Magento_Customer/js/model/customer'
], function (Component, $, url, customerData, customer) {
    'use strict';

    let contactPreferences = customerData.get('contact_preferences');

    return Component.extend({
        defaults: {
            template: 'Magelicious_ContactPreferences/contact-preferences'
        },

        initialize: function () {
            this._super();

            // Trigger "contact_preferences" section load
            $.ajax({
                type: 'POST',
                url: url.build('customer/contact/preferences'),
                data: {'load': true},
                showLoader: true
            });
        },

        isCustomerLoggedIn: function () {
            return contactPreferences().isCustomerLoggedIn;
        },

        getSelectOptions: function () {
            return contactPreferences().selectOptions;
        },

        saveContactPreferences: function () {
            let preferences = {};

            $('.contact_preference').children(':checkbox').each(function () {
                preferences[$(this).attr('name')] = $(this).attr('checked') ? true : false;
            });

            $.ajax({
                type: 'POST',
                url: url.build('customer/contact/preferences'),
                data: preferences,
                showLoader: true,
                complete: function (response) {
                    // todo
                }
            });

            return true;
        }
    });
});
