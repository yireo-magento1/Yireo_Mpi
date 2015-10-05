<?php
/**
 * Yireo Mpi for Magento
 *
 * @package     Yireo_Mpi
 * @author      Yireo (http://www.yireo.com/)
 * @copyright   Copyright 2015 Yireo (http://www.yireo.com/)
 * @license     Open Source License (OSL v3)
 */

/**
 * Metric container to handle all checks
 */
class Yireo_Mpi_Model_Metric
{
    /**
     * Metric type
     *
     * @var string
     */
    protected $type = null;

    /**
     * Allowed metric types
     */
    protected $allowedTypes = array('int', 'bool', 'string', 'text', 'seconds', 'bytes', 'kilobytes', 'megabytes', 'double', 'timestamp', 'array');

    /**
     * Metric name
     *
     * @var string
     */
    protected $name = null;

    /**
     * Metric value
     *
     * @var mixed
     */
    protected $value = null;

    /**
     * Message-level
     *
     * @var string
     */
    protected $level = null;

    /**
     * Timestamp at which this metric was started
     *
     * @var int
     */
    protected $startTime = null;

    /**
     * Timestamp at which this metric was ended
     *
     * @var int
     */
    protected $endTime = null;

    /**
     * Optional comment
     *
     * @var string
     */
    protected $comment = null;

    /**
     * Constructor
     */
    public function __construct($name = null, $value = null, $type = null, $level = null, $startTime = null, $endTime = null, $comment = null)
    {
        $this->setName($name);
        $this->setValue($value);
        $this->setType($type);
        $this->setLevel($level);
        $this->setStartTime($startTime);
        $this->setEndTime($endTime);
        $this->setComment($comment);
    }

    /**
     * Method to export this metric to an array
     */
    public function export()
    {
        $data = array();
        $data['name'] = $this->getName();
        $data['value'] = $this->getValue();
        $data['type'] = $this->getType();
        $data['start_time'] = $this->getStartTime();
        $data['end_time'] = $this->getEndTime();

        $comment = $this->getComment();
        if (!empty($comment)) {
            $data['comment'] = $comment;
        }

        return $data;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $type
     *
     * @throws Exception
     */
    public function setType($type)
    {
        if (empty($type)) {
            return;
        }

        if (in_array($type, $this->allowedTypes) == false) {
            throw new Exception('Unknown metric type');
        }

        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        if (!empty($this->type)) {
            return $this->type;
        }

        if (is_numeric($this->value)) {
            return 'int';
        }

        if (is_bool($this->value)) {
            return 'bool';
        }

        if (is_string($this->value)) {
            return 'string';
        }

        return 'unknown';
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param int $endTime
     */
    public function setEndTime($endTime)
    {
        if (empty($endTime)) {
            $endTime = time();
        }

        $this->endTime = $endTime;
    }

    /**
     * @return int
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * @param string $level
     */
    public function setLevel($level)
    {
        $this->level = $level;
    }

    /**
     * @return string
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param int $startTime
     */
    public function setStartTime($startTime)
    {
        if (empty($startTime)) {
            $startTime = time();
        }

        $this->startTime = $startTime;
    }

    /**
     * @return int
     */
    public function getStartTime()
    {
        return $this->startTime;
    }
}
