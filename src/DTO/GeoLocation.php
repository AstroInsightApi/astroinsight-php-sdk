<?php

namespace AstroInsight\DTO;

class GeoLocation
{
    public function __construct(
        public float $lat,
        public float $lon,
        public float $tzone = 5.5
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            lat: (float) ($data['lat'] ?? 0.0),
            lon: (float) ($data['lon'] ?? 0.0),
            tzone: (float) ($data['tzone'] ?? 5.5)
        );
    }

    public function toArray(): array
    {
        return [
            'lat' => $this->lat,
            'lon' => $this->lon,
            'tzone' => $this->tzone,
        ];
    }
}
