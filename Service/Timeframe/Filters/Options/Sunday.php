<?php
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
 * to servicedesk@tig.nl so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this module to newer
 * versions in the future. If you wish to customize this module for your
 * needs please contact servicedesk@tig.nl for more information.
 *
 * @copyright   Copyright (c) Total Internet Group B.V. https://tig.nl/copyright
 * @license     http://creativecommons.org/licenses/by-nc-nd/3.0/nl/deed.en_US
 */
namespace TIG\PostNL\Service\Timeframe\Filters\Options;

use TIG\PostNL\Service\Timeframe\Filters\OptionsFilterInterface;
use TIG\PostNL\Config\Provider\ShippingOptions;

class Sunday implements OptionsFilterInterface
{
    const TIMEFRAME_OPTION_SUNDAY = 'Sunday';

    /**
     * @var ShippingOptions
     */
    private $shippingOptions;

    /**
     * @param ShippingOptions $shippingOptions
     */
    public function __construct(
        ShippingOptions $shippingOptions
    ) {
        $this->shippingOptions = $shippingOptions;
    }

    /**
     * @param array|object $options
     *
     * @return array|object
     */
    public function filter($options)
    {
        $filterdOptions = array_filter($options, [$this, 'canDeliver']);
        return array_values($filterdOptions);
    }

    /**
     * @param $option
     *
     * @return bool
     */
    public function canDeliver($option)
    {
        $option = $option->Options;
        if (!isset($option->string[0])) {
            return false;
        }

        $result = false;

        foreach ($option->string as $string) {
            if ($string !== static::TIMEFRAME_OPTION_SUNDAY) {
                $result = true;
            }

            if ($string === static::TIMEFRAME_OPTION_SUNDAY
                && $this->shippingOptions->isSundayDeliveryActive()) {
                $option->validatedType = $string;
                $result = true;
            }
        }

        return $result;
    }
}
