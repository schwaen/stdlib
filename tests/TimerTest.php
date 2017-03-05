<?php
namespace Schwaen\Common;

/**
 * TimerTest
 */
class TimerTest extends \PHPUnit_Framework_TestCase
{
    /** @var Timer */
    private $timer = null;

    public function setUp()
    {
        $this->timer = Timer::getInstance('name');
    }

    /**
     * Test the instance types
     */
    public function testTypes()
    {
        $this->assertInstanceOf(Timer::class, $this->timer);
        $this->assertNotSame($this->timer, new Timer());
        $this->assertSame($this->timer, Timer::getInstance('name'));
    }

    /**
     * Test the init status
     */
    public function testInitialized()
    {
        $this->assertSame($this->timer->getStatus(), Timer::STATUS_INITIALIZED);
    }

    /**
     * Test for Timer->getSummary()
     */
    public function testGetSummary()
    {
        $summary = $this->timer->getSummary();
        $this->assertArrayHasKey('status', $summary);
        $this->assertArrayHasKey('start', $summary);
        $this->assertArrayHasKey('end', $summary);
        $this->assertArrayHasKey('total', $summary);
        $this->assertArrayHasKey('paused', $summary);
        $this->assertArrayHasKey('laps', $summary);
    }

    public function testStart()
    {
        $this->timer->start();
        $this->assertSame($this->timer->getStatus(), Timer::STATUS_RUNNING);
    }

    public function testPause()
    {
        $this->timer->pause();
        $this->assertSame($this->timer->getStatus(), Timer::STATUS_PAUSED);
    }

    public function testUnpause()
    {
        $this->timer->unpause();
        $this->assertSame($this->timer->getStatus(), Timer::STATUS_RUNNING);
    }

    public function testEnd()
    {
        $this->timer->end();
        $this->assertSame($this->timer->getStatus(), Timer::STATUS_ENDED);
    }

    public function testReset()
    {
        $summary = $this->timer->getSummary();
        $this->timer->reset();
        $this->assertSame($this->timer->getStatus(), Timer::STATUS_INITIALIZED);
        $this->assertNotSame($summary, $this->timer->getSummary());
    }

    public function testAddLap()
    {
        $summary1 = $this->timer->getSummary();
        $this->timer->addLap();
        $this->timer->addLap();
        $this->timer->addLap();
        $this->timer->addLap();
        $summary2 = $this->timer->getSummary();
        $this->assertGreaterThan(count($summary1['laps']), count($summary2['laps']));
    }
}
