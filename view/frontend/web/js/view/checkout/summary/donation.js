define(
    [
        'jquery',
        'Magento_Checkout/js/view/summary/abstract-total',
        'Magento_Checkout/js/model/quote'
    ],
    function ($,Component) {
        "use strict";
        return Component.extend({
            defaults: {
                template: 'Shoyab_Donation/checkout/summary/donation'
            },
            isDisplayedDonation : function(){
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
