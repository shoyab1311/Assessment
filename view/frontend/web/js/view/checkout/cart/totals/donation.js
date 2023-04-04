/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
define(
    [
        'Shoyab_Donation/js/view/checkout/summary/donation'
    ],
    function (Component) {
        'use strict';

        return Component.extend({
            isDisplayed: function () {
                return true;
            },
            getDonation : function(){
                var donation = window.checkoutConfig.quoteData.donation;
                if (donation)
                    return this.getFormattedPrice(donation);
                else
                    return '';
            }
        });
    }
);
