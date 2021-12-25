<?php
declare(strict_types=1);

namespace App\Domain\Data;

use App\Domain\Enum\VendorType;

class Vendor implements \JsonSerializable
{
    private string $name;
    private string $caption;
    private VendorType $type;

    public function __construct(string $name, string $caption, VendorType $type)
    {
        $this->name = $name;
        $this->caption = $caption;
        $this->type = $type;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCaption(): string
    {
        return $this->caption;
    }

    public function getType(): VendorType
    {
        return $this->type;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'name' => $this->name,
            'caption' => $this->caption,
        ];
    }
}
