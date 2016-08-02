'use strict';

/**
 * This file is part of the Aisel package.
 *
 * (c) Ivan Proskuryakov
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @name            AiselOrder
 * @description     Order module
 */

define(['app',
    './config/order',
    './controllers/checkout',
    './controllers/order',
    './controllers/orderDetail',
    './services/order',
    './services/checkout',
], function(app) {
    console.log('Order module loaded ...');
});
