<?php

/**
 * DSAPrivateKey
 *
 * PHP version 5
 *
 * @category  File
 * @package   ASN1
 * @author    Jim Wigginton <terrafrost@php.net>
 * @copyright 2016 Jim Wigginton
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link      http://phpseclib.sourceforge.net
 */

namespace tgseclib\File\ASN1\Maps;

use tgseclib\File\ASN1;

/**
 * DSAPrivateKey
 *
 * @package ASN1
 * @author  Jim Wigginton <terrafrost@php.net>
 * @access  public
 */
abstract class DSAPrivateKey
{
    const MAP = [
        'type' => ASN1::TYPE_SEQUENCE,
        'children' => [
            'version' => ['type' => ASN1::TYPE_INTEGER],
            'p' => ['type' => ASN1::TYPE_INTEGER],
            'q' => ['type' => ASN1::TYPE_INTEGER],
            'g' => ['type' => ASN1::TYPE_INTEGER],
            'y' => ['type' => ASN1::TYPE_INTEGER],
            'x' => ['type' => ASN1::TYPE_INTEGER]
        ]
    ];
}