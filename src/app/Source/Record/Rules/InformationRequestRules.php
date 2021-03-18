<?php


namespace App\Source\Record\Rules;


use App\Source\Record\InformationRequest;
use DateTime;
use DateInterval;
use Exception;

/**
 * Class InformationRequestRules
 * @package App\Source\Record\Rules
 * @property InformationRequest $informationRequest
 */
class InformationRequestRules
{
    const LIFE_LAW = 0;

    private $informationRequest = null;

    public function __construct(InformationRequest $informationRequest)
    {
        $this->informationRequest = $informationRequest;
    }

    /**
     * @param null $rule
     * @return bool|string
     */
    public function eval($rule = null)
    {
        switch ($rule) {
            case self::LIFE_LAW:
                return $this->isInForce();
            default:
                return true;
        }
    }

    /**
     * @return string
     */
    private function isInForce()
    {
        try {
            $date = new DateTime($this->informationRequest->created_at);
            $date->add(new DateInterval('P6M'));
            return $date->format('Y-m-d');
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }


    }
}
