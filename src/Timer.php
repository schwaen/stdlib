<?php
namespace Schwaen\Common;

/**
 * Timer
 *
 * Inspired by https://github.com/jsanc623/PHPBenchTime
 */
class Timer
{
    /**
     * Status: initialized
     *
     * @var int
     */
    const STATUS_INITIALIZED = 0;

    /**
     * Status: running
     *
     * @var int
     */
    const STATUS_RUNNING = 1;

    /**
     * Status: paused
     *
     * @var int
     */
    const STATUS_PAUSED = 2;

    /**
     * Status: ended
     *
     * @var int
     */
    const STATUS_ENDED = 3;

    /**
     * Status
     *
     * @var int
     */
    protected $status = null;

    /**
     * Starttime
     *
     * @var float
     */
    private $startTime = 0.0;

    /**
     * Endtime
     *
     * @var float
     */
    private $endTime = 0.0;

    /**
     * Paused time
     *
     * @var float
     */
    private $pauseTime = 0.0;

    /**
     * Total pause time
     *
     * @var float
     */
    private $totalPauseTime = 0.0;

    /**
     * List of laps
     *
     * @var array
     */
    private $laps = [];

    /**
     * List of Timer
     *
     * @var Timer[]
     */
    private static $timers = [];

    /**
     * constructor
     */
    public function __construct()
    {
        $this->reset();
    }

    /**
     * Creates and/or return a Timer instance
     *
     * @param string $name
     *
     * @throws \InvalidArgumentException
     *
     * @return Timer
     */
    public static function getInstance($name)
    {
        if (!is_string($name)) {
            throw new \InvalidArgumentException('$name should be a string. a '.gettype($name). ' is given.');
        }
        if (!isset(self::$timers[$name])) {
            self::$timers[$name] = new self();
        }
        return self::$timers[$name];
    }

    /**
     * Starts the timer
     *
     * @param string $name
     *
     * @throws \LogicException
     */
    public function start($name = 'start')
    {
        if ($this->getStatus() !== self::STATUS_INITIALIZED) {
            throw new \LogicException('Only initialied timmers could start. The actually status is '.$this->getStatus());
        }
        $this->startTime = $this->getCurrentTime();
        $this->addLap($name);
    }

    /**
     * Ends the timer
     *
     * @throws \LogicException
     */
    public function end()
    {
        if ($this->getStatus() !== self::STATUS_RUNNING) {
            throw new \LogicException('Only running timmers could end. The actually status is '.$this->getStatus());
        }
        $this->endTime = $this->getCurrentTime();
        $this->status = self::STATUS_ENDED;
        $this->endLap();
    }

    /**
     * Starts a new lap
     *
     * @param string $name Name of the lap
     */
    public function addLap($name = null)
    {
        $this->endLap();
        $this->status = self::STATUS_RUNNING;
        $this->laps[] = [
            'name' => $name ? $name : count($this->laps) +1,
            'start' => $this->getCurrentTime(),
            'end' => -1,
            'total' => -1,
        ];
    }

    /**
     * Ends a lap
     */
    protected function endLap()
    {
        if (empty($this->laps)) {
            return;
        }
        $lapIndex = count($this->laps) -1;
        $this->laps[$lapIndex]['end'] = $this->getCurrentTime();
        $this->laps[$lapIndex]['total'] = $this->laps[$lapIndex]['end'] - $this->laps[$lapIndex]['start'];
    }

    /**
     * Reset the Timer
     */
    public function reset()
    {
        $this->status = self::STATUS_INITIALIZED;
        $this->startTime = 0;
        $this->endTime = 0;
        $this->pauseTime = 0;
        $this->totalPauseTime = 0;
        $this->laps = [];
    }

    /**
     * Returns the summary
     *
     * @return array
     */
    public function getSummary()
    {
        return [
            'status' => $this->getStatus(),
            'start' => $this->startTime,
            'end' => $this->endTime,
            'total' => $this->endTime - $this->startTime,
            'paused' => $this->totalPauseTime,
            'laps' => $this->laps,
        ];
    }

    /**
     * Pause the Timer
     *
     * @throws \LogicException
     */
    public function pause()
    {
        if ($this->getStatus() !== self::STATUS_RUNNING) {
            throw new \LogicException('Only running timmers could end. The actually status is '.$this->getStatus());
        }
        $this->status = self::STATUS_PAUSED;
        $this->pauseTime = $this->getCurrentTime();
    }

    /**
     * Unpause the Timer
     *
     * @throws \LogicException
     */
    public function unpause()
    {
        if ($this->getStatus() !== self::STATUS_PAUSED) {
            throw new \LogicException('Only paused timmers could unpaused. The actually status is '.$this->getStatus());
        }
        $this->status = self::STATUS_RUNNING;
        $this->totalPauseTime = $this->getCurrentTime() - $this->pauseTime;
        $this->pauseTime = 0;
    }

    /**
     * Returns the current time
     *
     * @return float
     */
    private function getCurrentTime()
    {
        return microtime(true);
    }

    /**
     * Returns the status
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }
}
