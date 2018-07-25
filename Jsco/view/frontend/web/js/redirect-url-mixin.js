define([
    'jquery'
], function ($) {
    return function (originalWidget) {

        originalWidget._proto._onEvent = function() {
            console.log('7777');
        };

        return originalWidget;
    };
});