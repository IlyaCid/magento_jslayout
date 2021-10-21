define([
    'jquery',
    'underscore',
    'uiComponent',
    'ko',
    'Magento_Checkout/js/model/step-navigator',
    'mage/translate',
], function (
    $,
    _,
    Component,
    ko,
    stepNavigator,
    $t,
) {
    'use strict';

    return Component.extend({

        isVisible: ko.observable(true),
        /** @inheritdoc */
        initialize: function () {
            this._super();
            stepNavigator.registerStep(
                'customers',
                null,
                $t('Customers'),
                this.isVisible,
                _.bind(this.navigate, this),
                20
            );

            return this;
        },

        /**
         * Navigate method.
         */
        navigate: function () {
            this.isVisible(true);
        },

        /**
         * @returns voidresponseData
         */
        navigateToNextStep: function () {
            stepNavigator.next();
        },
    });
});
