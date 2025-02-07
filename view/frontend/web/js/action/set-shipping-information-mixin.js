/**
 *
 *          ..::..
 *     ..::::::::::::..
 *   ::'''''':''::'''''::
 *   ::..  ..:  :  ....::
 *   ::::  :::  :  :   ::
 *   ::::  :::  :  ''' ::
 *   ::::..:::..::.....::
 *     ''::::::::::::''
 *          ''::''
 *
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Creative Commons License.
 * It is available through the world-wide-web at this URL:
 * http://creativecommons.org/licenses/by-nc-nd/3.0/nl/deed.en_US
 * If you are unable to obtain it through the world-wide-web, please send an email
 * to servicedesk@totalinternetgroup.nl so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this module to newer
 * versions in the future. If you wish to customize this module for your
 * needs please contact servicedesk@totalinternetgroup.nl for more information.
 *
 * @copyright   Copyright (c) Total Internet Group B.V. https://tig.nl/copyright
 * @license     http://creativecommons.org/licenses/by-nc-nd/3.0/nl/deed.en_US
 */
/* jshint ignore:start */
define([
    'jquery',
    'mage/utils/wrapper',
    'Magento_Checkout/js/model/quote'
], function (
    $,
    wrapper,
    quote
) {
    'use strict';

    return function (setShippingInformationAction) {
        return wrapper.wrap(setShippingInformationAction, function (originalAction) {
            var shippingAddress = quote.shippingAddress();

            if (shippingAddress === undefined || !shippingAddress) {
                return originalAction();
            }

            if (shippingAddress.customAttributes === undefined) {
                return originalAction();
            }

            if (shippingAddress['extension_attributes'] === undefined) {
                shippingAddress['extension_attributes'] = {};
            }

            // < M2.3.0
            if (shippingAddress.customAttributes !== undefined && shippingAddress.customAttributes.tig_housenumber !== undefined) {
                shippingAddress['extension_attributes']['tig_housenumber']          = shippingAddress.customAttributes.tig_housenumber;
                shippingAddress['extension_attributes']['tig_housenumber_addition'] = shippingAddress.customAttributes.tig_housenumber_addition;
            }
            // >= M2.3.0
            if (shippingAddress.customAttributes[0] === undefined) {
                return originalAction();
            }

            if (shippingAddress.customAttributes[0].attribute_code === 'tig_housenumber') {
                shippingAddress['extension_attributes']['tig_housenumber']          = shippingAddress.customAttributes[0].value;
                shippingAddress['extension_attributes']['tig_housenumber_addition'] = shippingAddress.customAttributes[1].value;
                const houseNumberInput = $('div[name="shippingAddress.custom_attributes.tig_housenumber"] input');
                const hNValue = houseNumberInput.val();
                const checkValid = hNValue.match(/^\d/);
                if(!checkValid){
                    houseNumberInput.val('');
                    houseNumberInput.trigger('change');
                    houseNumberInput[0].scrollIntoView();
                }
            }

            return originalAction();
        });
    };
});
/* jshint ignore:end */
