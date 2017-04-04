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
//        echo $value .PHP_EOL;
//        if ($index < 0) return;
//        if ($value > 0) {
//            $arrayItem[$index] += $value;
//        } else {
//            $arrayItem[$index] += $value;
//        }

        if ($index < 0) return;
        if ($arrayItem[$index] >= 0) {
            if ($value > 0) {
                $arrayItem[$index] += $value;
            } elseif ($value == -1) {
                if ($arrayItem[$index] > 0) {
                    $arrayItem[$index] -= abs($value);
                }
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
    public function doEncrypt(string $token): bool
    {
//        echo $token . '  -   ' . $this->key . PHP_EOL;
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
//        echo "start";
//        $this->print($currentSet);

        for ($i = 0; $i < $keyLength; $i++) {
//            echo $keySplitArray[$i].' -- '.$keySplitArray[$i].PHP_EOL;
            $this->updateIndex($currentSet, $keySplitArray[$i], 1);
            $this->updateIndex($currentSet, $tokenSplitArray[$i], -1);
//            $currentSet[$keySplitArray[$i]]   += 1;
//            $currentSet[$tokenSplitArray[$i]] -= 1;

        }
//                $this->print($currentSet);
//
//        $this->debug($currentSet);
//        exit;
//        $this->print($currentSet);
        //  exit;

        if ($this->isValid($currentSet) == true) {
            return true;
        }

//        $this->debug($currentSet);
//        exit;

//        echo $tokenLength;
        for ($index = $keyLength; $index < $tokenLength; $index++) {
//            if($index > $keyLength-1) {
//            echo $tokenSplitArray[$index];
//            exit;
            $this->updateIndex($currentSet, $tokenSplitArray[$index], -1);
            if ($this->isValid($currentSet) == true) {
                return true;
            }
//            $this->debug($currentSet);
            $this->updateIndex($currentSet, $tokenSplitArray[($index - $keyLength)], 1);
//            $this->debug($currentSet);
//            exit;

//                print_r($tokenSplitArray);
//                $this->debug($currentSet);
//                print_r($index);
//                exit;

//            }
        }

      //  $this->debug($currentSet);

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
//        $this->debug($arr);
        foreach ($arr as $ind => $val) {
            if ($val != 0)
                return false;
        }

        return true;
    }

    private function debug($arr)
    {
        foreach ($arr as $ind => $val) {
            if ($val != 0)
                echo $ind . ' => ' . $val . PHP_EOL;
        }
        echo "------" . PHP_EOL;
    }

    private function print($arr)
    {
        foreach ($arr as $ind => $val) {
            echo $ind . ' => ' . $val . PHP_EOL;
        }
        echo "------" . PHP_EOL;
    }


}