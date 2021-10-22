define([
    'jquery',
    'underscore',
    'uiComponent',
    'ko',
    'Magento_Checkout/js/model/step-navigator',
    'mage/translate',
    'mage/url',
], function (
    $,
    _,
    Component,
    ko,
    stepNavigator,
    $t,
    url
) {
    'use strict';

    return Component.extend({
        defaults: {
            customers: [],
        },

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

            this.getCustomerList();
            this.responseData.subscribe(this.updateList.bind(this))

            return this;
        },

        /**
         * Initial observerable
         * @returns {*}
         */
        initObservable: function () {
            this._super().observe([
                'customers',
                'responseData'
            ]);

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

        getCustomerList: function (data) {
            var data = data || {};
            $.ajax({
                url: url.build('jslayout/customerlist'),
                data: data,
                type: 'post',
                context: this,
                dataType: 'json',

                /** @inheritdoc */
                success: function (response) {
                    this.responseData(response.customers)
                },
            })
        },

        chooseCustomer: function (id) {
            alert(id)
        },

        updateList: function (customerList) {
            this.customers(customerList)
        },

    });
});
