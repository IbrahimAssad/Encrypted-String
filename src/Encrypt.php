<?php

namespace IbrahimAssad\Encrypted;

/**
 * Class Encrypt
 *
 * @package IbrahimAssad\Encrypted
 */
class Encrypt
{
    private $key = "";

    /**
     * Encrypt constructor.
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
    private function updateIndex(array &$arrayItem, $index, int $value)
    {
        if ($index < 0) return;
        if ($arrayItem[$index] > 0) {
            //if($value > 0){
            $arrayItem[$index] += $value;
            //}

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
    public function doEncrypt(string $token): bool
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

        for ($i = 0; $i < count($charArray); $i++) {
            $currentSet[$charArray[$i]] = 0;
        }


        for ($i = 0; $i < $tokenLength; $i++) {
            $this->updateIndex($currentSet, $tokenSplitArray[$i], -1);
        }

        if ($this->isValid($currentSet) == true) {
            return true;
        }


        for ($i = 0; $i < $keyLength; $i++) {
            $currentSet[$keySplitArray[$i]] += 1;
        }


        for ($index = 0; $index < $tokenLength; $index++) {
            $this->updateIndex($currentSet, $tokenSplitArray[$index], -1);
            $this->updateIndex($currentSet, $tokenSplitArray[($index - 1)], 1);
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
    private function isValid($arr)
    {
        foreach ($arr as $ind => $val) {
            if ($val != 0)
                return false;
        }

        return true;
    }
}