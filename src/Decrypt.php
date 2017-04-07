<?php

namespace IbrahimAssad\EncryptedString;

/**
 * Class Decrypt
 *
 * @package IbrahimAssad\EncryptedString
 */
class Decrypt
{
    /** @var string $key */
    private $key = "";

    /**
     * Decrypt constructor.
     *
     * @param string $key
     */
    function __construct(string $key)
    {
        $this->key = $key;
    }

    /**
     * DESC
     *
     * @param array $arrayItem
     * @param       $index
     * @param int   $value
     *
     * @author Ibrahim Assad <Ibrahim.assad@tajawal.com>
     *
     */
    private function updateIndex(array &$arrayItem, $index, int $value):void
    {
        if (isset($arrayItem[$index])) {
            if ($value > 0) {
                $arrayItem[$index] += $value;
            } elseif ($value == -1) {
                $arrayItem[$index] -= abs($value);
            }
        }

    }

    /**
     * DESC
     *
     * @return array
     *
     * @author Ibrahim Assad <Ibrahim.assad@tajawal.com>
     *
     */
    private function getCharArrayAtoz(): array
    {
        $upper   = range(chr(Constants::A_LETTER), chr(Constants::Z_LETTER));
        $lower   = range(chr(Constants::a_LETTER), chr(Constants::z_LETTER));
        $numbers = range(chr(Constants::ZERO_NUMBER), chr(Constants::NINE_NUMBER));

        return array_merge($upper, $lower, $numbers);

    }

    /**
     * DESC
     *
     * @param string $token
     *
     * @return bool
     *
     * @author Ibrahim Assad <Ibrahim.assad@tajawal.com>
     *
     */
    public function doDecrypt(string $token): bool
    {
        $charArray = $this->getCharArrayAtoz();

        $currentSet = [];

        $tokenSplitArray = str_split($token);
        $tokenLength     = count($tokenSplitArray);

        $keySplitArray = str_split($this->key);
        $keyLength     = count($keySplitArray);

        if ($keyLength > $tokenLength) {
            return false;
        }

        for ($i = 0; $i < $keyLength; $i++) {
            if (!isset($currentSet[$keySplitArray[$i]])) {
                $currentSet[$keySplitArray[$i]] = 0;
            }
        }

        for ($i = 0; $i < $keyLength; $i++) {
            $this->updateIndex($currentSet, $keySplitArray[$i], -1);
            $this->updateIndex($currentSet, $tokenSplitArray[$i], 1);
        }

        if ($this->isValid($currentSet) == true) {
            return true;
        }


        for ($index = $keyLength; $index < $tokenLength; $index++) {

            $this->updateIndex($currentSet, $tokenSplitArray[$index], +1);
            $this->updateIndex($currentSet, $tokenSplitArray[(($index - $keyLength))], -1);
            if ($this->isValid($currentSet) == true) {
                return true;
            }
        }

        if ($this->isValid($currentSet) == true) {
            return true;
        }

        return false;
    }

    /**
     * DESC
     *
     * @param $arr
     *
     * @return bool
     *
     * @author Ibrahim Assad <Ibrahim.assad@tajawal.com>
     *
     */
    private function isValid($arr):bool
    {
        foreach ($arr as $ind => $val) {
            if ($val != 0)
                return false;
        }

        return true;
    }

    /**
     * debug array with values != 0
     *
     * @param $arr
     *
     * @author Ibrahim Assad <Ibrahim.assad@tajawal.com>
     *
     */
    private function debug($arr)
    {
        foreach ($arr as $ind => $val) {
            if ($val != 0)
                echo $ind . ' => ' . $val . PHP_EOL;
        }
        echo "------" . PHP_EOL;
    }

    /**
     * print all array data
     *
     * @param $arr
     *
     * @author Ibrahim Assad <Ibrahim.assad@tajawal.com>
     *
     */
    private function print($arr)
    {
        foreach ($arr as $ind => $val) {
            echo $ind . ' => ' . $val . PHP_EOL;
        }
        echo "------" . PHP_EOL;
    }


}