<?php
declare(strict_types=1);

namespace App\Domain;

use App\Domain\Data\Vendor;
use App\Domain\Enum\VendorType;

class VendorRepository
{
    private static array $all = [];

    public function __construct()
    {
        self::$all = [
            new Vendor('google', 'Google広告', VendorType::SEARCH),
            new Vendor('gdn', 'Googleディスプレイ広告', VendorType::DISPLAY),
            new Vendor('yahoo', 'Yahoo広告', VendorType::SEARCH),
            new Vendor('yda', 'Yahooディスプレイ広告', VendorType::DISPLAY),
            new Vendor('twitter', 'Twitter広告', VendorType::SNS),
            new Vendor('facebook', 'Facebook広告', VendorType::SNS),
            new Vendor('smartnews', 'SmartNews広告', VendorType::DISPLAY),
        ];
    }

    /**
     * @param VendorType $type
     * @return array<Vendor>
     */
    public function findByVendorType(VendorType $type): array
    {
        return array_values(array_filter(self::$all, function (Vendor $vendor) use ($type) {
            return $vendor->getType() === $type;
        }));
    }
}
