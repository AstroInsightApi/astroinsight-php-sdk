<?php

namespace AstroInsight\DTO;

class BirthDetails
{
    public function __construct(
        public int $day,
        public int $month,
        public int $year,
        public int $hour,
        public int $min,
        public int $sec = 0,
        public float $tzone = 5.5,
        public float $lat = 28.6139,
        public float $lon = 77.2090
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            day: (int) ($data['day'] ?? 1),
            month: (int) ($data['month'] ?? 1),
            year: (int) ($data['year'] ?? 1990),
            hour: (int) ($data['hour'] ?? 12),
            min: (int) ($data['min'] ?? 0),
            sec: (int) ($data['sec'] ?? 0),
            tzone: (float) ($data['tzone'] ?? 5.5),
            lat: (float) ($data['lat'] ?? 28.6139),
            lon: (float) ($data['lon'] ?? 77.2090)
        );
    }

    public function toArray(): array
    {
        return [
            'day' => $this->day,
            'month' => $this->month,
            'year' => $this->year,
            'hour' => $this->hour,
            'min' => $this->min,
            'sec' => $this->sec,
            'tzone' => $this->tzone,
            'lat' => $this->lat,
            'lon' => $this->lon,
        ];
    }
}
