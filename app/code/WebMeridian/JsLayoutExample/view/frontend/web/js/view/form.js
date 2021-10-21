define([
    'jquery',
    'underscore',
    'Magento_Ui/js/form/form',
    'ko',
    'Magento_Checkout/js/model/step-navigator',
    'mage/translate'
], function (
    $,
    _,
    Component,
    ko,
    stepNavigator,
    $t
) {
    'use strict';

    return Component.extend({

        isVisible: ko.observable(false),
        /** @inheritdoc */
        initialize: function () {
            this._super();
            stepNavigator.registerStep(
                'form',
                null,
                $t('Test Form'),
                this.isVisible,
                _.bind(this.navigate, this),
                10
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
         * @returns void
         */
        navigateToNextStep: function () {
            stepNavigator.next();
        },

        /**
         * @returns void
         */
        submitButton: function () {
            let formData = this.source.data;

            if (formData.input_test) {
                stepNavigator.next();
            } else {
                alert('Please, set input')
            }
        }
    });
});
