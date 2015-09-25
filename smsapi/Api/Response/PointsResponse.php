<?php

namespace SMSApi\Api\Response;

/**
 * Class PointsResponse
 * @package SMSApi\Api\AbstractContactsResponse
 */
class PointsResponse extends AbstractResponse
{
    const className = __CLASS__;

    /** @var int|null */
    private $proCount;

    /** @var int|null */
    private $ecoCount;

    public function __construct($data)
    {
        parent::__construct($data);

        if (isset($this->obj->proCount)) {
            $this->proCount = $this->obj->proCount;
        }

        if (isset($this->obj->ecoCount)) {
            $this->ecoCount = $this->obj->ecoCount;
        }

    }

    /**
	 * Number of points available for user.
	 *
	 * @return number
	 */
	public function getPoints()
	{
		return $this->obj->points;
	}

    public function getProCount()
    {
        return $this->proCount;
    }

    public function getEcoCount()
    {
        return $this->ecoCount;
    }

}
