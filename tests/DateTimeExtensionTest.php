<?php

namespace Spatie\Period\Tests;

use DateTimeImmutable;
use DateTimeInterface;
use Spatie\Period\Period;
use PHPUnit\Framework\TestCase;

class DateTimeExtensionTest extends TestCase
{
    /** @test */
    public function it_should_be_possible_use_date_time_extensions()
    {
        $start = new DateTimeExtension('2019-05-22');
        $end = new DateTimeExtension('2019-06-05');
        $period = new TestPeriod($start, $end);

        $this->assertInstanceOf(DateTimeExtension::class, $period->getStart());
        $this->assertInstanceOf(DateTimeExtension::class, $period->getEnd());
        $this->assertInstanceOf(DateTimeExtension::class, $period->getIncludedStart());
        $this->assertInstanceOf(DateTimeExtension::class, $period->getIncludedEnd());
    }

    /** @test */
    public function it_should_be_possible_to_use_period_extension_to_force_date_time_extension()
    {
        $period = TestPeriod::make('2019-05-01', '2019-05-31');

        $this->assertInstanceOf(TestPeriod::class, $period);
        $this->assertInstanceOf(DateTimeExtension::class, $period->getStart());
    }
}

/**
 * In real life this would be Carbon or Chronos.
 */
class DateTimeExtension extends DateTimeImmutable
{
    public static function instance(DateTimeImmutable $dateTime)
    {
        return new static($dateTime->format('Y-m-d H:i:s.u'), $dateTime->getTimezone());
    }
}

/**
 * @method DateTimeExtension getStart
 * @method DateTimeExtension getIncludedStart
 * @method DateTimeExtension getEnd
 * @method DateTimeExtension getIncludedEnd
 */
class TestPeriod extends Period
{
    /** @var DateTimeExtension */
    protected $start;

    /** @var DateTimeExtension */
    protected $end;

    public function __construct(DateTimeExtension $start, DateTimeExtension $end, $precisionMask = null, $boundaryExclusionMask = null)
    {
        parent::__construct($start, $end, $precisionMask, $boundaryExclusionMask);
    }

    /** @return DateTimeExtension */
    protected static function resolveDate($date, $format)
    {
        return DateTimeExtension::instance(parent::resolveDate($date, $format));
    }

    /** @return DateTimeExtension */
    protected function roundDate(DateTimeInterface $date, $precision)
    {
        return DateTimeExtension::instance(parent::roundDate($date, $precision));
    }
}
