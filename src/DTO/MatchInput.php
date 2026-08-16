<?php

namespace AstroInsight\DTO;

class MatchInput
{
    public function __construct(
        public BirthDetails $male,
        public BirthDetails $female
    ) {}

    public static function fromDetails(BirthDetails $male, BirthDetails $female): self
    {
        return new self($male, $female);
    }

    public static function fromArray(array $data): self
    {
        if (isset($data['male']) && isset($data['female'])) {
            return new self(
                BirthDetails::fromArray($data['male']),
                BirthDetails::fromArray($data['female'])
            );
        }

        $male = new BirthDetails(
            day: (int) ($data['m_day'] ?? 1),
            month: (int) ($data['m_month'] ?? 1),
            year: (int) ($data['m_year'] ?? 1990),
            hour: (int) ($data['m_hour'] ?? 12),
            min: (int) ($data['m_min'] ?? 0),
            sec: (int) ($data['m_sec'] ?? 0),
            tzone: (float) ($data['m_tzone'] ?? 5.5),
            lat: (float) ($data['m_lat'] ?? 28.6139),
            lon: (float) ($data['m_lon'] ?? 77.2090)
        );

        $female = new BirthDetails(
            day: (int) ($data['f_day'] ?? 1),
            month: (int) ($data['f_month'] ?? 1),
            year: (int) ($data['f_year'] ?? 1992),
            hour: (int) ($data['f_hour'] ?? 12),
            min: (int) ($data['f_min'] ?? 0),
            sec: (int) ($data['f_sec'] ?? 0),
            tzone: (float) ($data['f_tzone'] ?? 5.5),
            lat: (float) ($data['f_lat'] ?? 28.6139),
            lon: (float) ($data['f_lon'] ?? 77.2090)
        );

        return new self($male, $female);
    }

    public function toArray(): array
    {
        $m = $this->male->toArray();
        $f = $this->female->toArray();

        return [
            'm_day' => $m['day'],
            'm_month' => $m['month'],
            'm_year' => $m['year'],
            'm_hour' => $m['hour'],
            'm_min' => $m['min'],
            'm_sec' => $m['sec'],
            'm_tzone' => $m['tzone'],
            'm_lat' => $m['lat'],
            'm_lon' => $m['lon'],
            'f_day' => $f['day'],
            'f_month' => $f['month'],
            'f_year' => $f['year'],
            'f_hour' => $f['hour'],
            'f_min' => $f['min'],
            'f_sec' => $f['sec'],
            'f_tzone' => $f['tzone'],
            'f_lat' => $f['lat'],
            'f_lon' => $f['lon'],
        ];
    }
}
