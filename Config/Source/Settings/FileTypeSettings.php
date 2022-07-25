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
namespace TIG\PostNL\Config\Source\Settings;

use \Magento\Framework\Option\ArrayInterface;

class FileTypeSettings implements ArrayInterface
{
    const PDF = 'GraphicFile|PDF';
    const ZPL_200_DPI = 'Zebra|Generic ZPL II 200 dpi';
    const ZPL_300_DPI = 'Zebra|Generic ZPL II 300 dpi';
    const ZPL_600_DPI = 'Zebra|Generic ZPL II 600 dpi';


    /**
     * @return array
     */
    public function toOptionArray()
    {
        // @codingStandardsIgnoreStart
        $options = [
            ['value' => static::PDF, 'label' => __('PDF')],
            ['value' => static::ZPL_200_DPI, 'label' => __('ZPL 200 dpi')],
            ['value' => static::ZPL_300_DPI, 'label' => __('ZPL 300 dpi')],
            ['value' => static::ZPL_600_DPI, 'label' => __('ZPL 600 dpi')],
        ];
        // @codingStandardsIgnoreEnd
        return $options;
    }
}
