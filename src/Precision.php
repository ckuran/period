<?php

namespace Spatie\Period;

interface Precision
{
    const YEAR = 0b100000;
    const MONTH = 0b110000;
    const DAY = 0b111000;
    const HOUR = 0b111100;
    const MINUTE = 0b111110;
    const SECOND = 0b111111;
}
