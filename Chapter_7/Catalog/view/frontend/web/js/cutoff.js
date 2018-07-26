define([
        'jquery',
        'uiComponent',
        'ko',
        'moment'
    ], function ($, Component, ko, moment) {
        'use strict';
        return Component.extend({
            defaults: {
                template: 'Magelicious_Catalog/cutoff',
                expiresAt: null,
                timerHide: false,
                timerHours: null,
                timerMinutes: null,
                timerSeconds: null,
            },
            initialize: function () {
                this._super();
                this.countdown(this);
                return this;
            },
            initObservable: function () {
                this._super()
                    .observe('timerHide timerHours timerMinutes timerSeconds');
                return this;
            },
            countdown: function (self) {
                var today = moment(new Date());
                setInterval(function () {
                    self.expiresAt = moment(self.expiresAt).subtract(1, 'seconds');
                    var milliseconds = moment(self.expiresAt, 'DD/MM/YYYY HH:mm:ss').diff(moment(today, 'DD/MM/YYYY HH:mm:ss'));
                    var duration = moment.duration(milliseconds);
                    self.timerHours(duration.hours() >= 0 ? duration.hours() : 0);
                    self.timerMinutes(duration.minutes() >= 0 ? duration.minutes() : 0);
                    self.timerSeconds(duration.seconds() >= 0 ? duration.seconds() : 0);
                    if (self.timerHours() == 0
                        && self.timerMinutes() == 0
                        && self.timerSeconds() == 0
                    ) {
                        self.timerHide(true);
                    }
                }, 1000);
            }
        });
    }
);