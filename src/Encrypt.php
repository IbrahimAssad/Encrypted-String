<?php

namespace IbrahimAssad\EncryptedString;

/**
 * Class Encrypt
 *
 * @package IbrahimAssad\EncryptedString
 */
class Encrypt
{
    /** @var string $key */
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
     * @return string
     *
     * @author Ibrahim Assad <Ibrahim.assad@tajawal.com>
     *
     */
    private function generateRandomString(): string
    {
        $uniqid     = uniqid(uniqid()) . uniqid() . uniqid() . uniqid();
        $uniqid     = uniqid() . md5(date('YmdHis')) . $uniqid;
        $uniqid     = uniqid() . md5(date('YmdHis')) . $uniqid;
        $uniqid     = $uniqid . uniqid() . md5(date('YmdHis')) . $uniqid;
        $uniqid     = $uniqid . uniqid() . md5(date('YmdHis')) . $uniqid;
        $headLength = rand(1, strlen($uniqid));

        return substr($uniqid, 0, -($headLength));

    }

    /**
     * DESC
     *
     * @return string
     *
     * @author Ibrahim Assad <Ibrahim.assad@tajawal.com>
     *
     */
    private function getKey()
    {
        $keyArray = str_split($this->key);
        shuffle($keyArray);

        return implode("", $keyArray);
    }

    public function doEncrypt(string $string): string
    {

        return $this->generateRandomString() . $this->getKey() . $this->generateRandomString();


    }
}