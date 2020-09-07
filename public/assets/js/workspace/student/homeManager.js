import { api_resquest_maker } from './../../util/ajaxHandler.js';
import { apiEndpoints } from './../../util/apiEndpoints.js';
import { fileEndPoints } from './../../util/fileEndPoints.js';
import { components } from './../../util/components.js';

export class studentHomeManager {
    constructor() {
        this.bulletin();
        this.payment();
        this.payment();
        this.message();
    }

    bulletin() {

    }

    payment() {
        (function toggleHistoryAndPaymentView() {
            $("#make-payment").click(function() {
                $(".payment-history").fadeOut('slow', function() {
                    $(".paymentform-wrapper").fadeIn('slow');
                });
            });
            $("#exit-payment-form-view").click(function() {
                $(".paymentform-wrapper").fadeOut('slow', function() {
                    $(".payment-history").fadeIn('slow');
                });
            });
        })();
    }

    message() {

    }

}

