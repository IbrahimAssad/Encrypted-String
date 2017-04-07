<?php

namespace IbrahimAssad\EncryptedString\Tests;

use IbrahimAssad\EncryptedString\Decrypt;
use PHPUnit\Framework\TestCase;

/**
 * Class EncryptTest
 *
 * @package IbrahimAssad\Encrypted\tests
 */
class EncryptTest extends TestCase
{
    /**
     * DESC
     *
     * @author Ibrahim Assad <Ibrahim.assad@tajawal.com>
     *
     */
    public function testRun()
    {

        $test = new Decrypt("ibrahim");
        $this->assertTrue($test->doDecrypt("ibrahim"));
        $this->assertFalse($test->doDecrypt("asasdasdasdasdadaadasdamIbrahid"));
        $this->assertTrue($test->doDecrypt("kajsdakshdasjkdhaskdhaskdirahimb"));
        $this->assertTrue($test->doDecrypt("ibrahimasda"));
        $this->assertTrue($test->doDecrypt("asdasibrahim"));
        $this->assertTrue($test->doDecrypt("asaaaibrahimdddddddsadasdas"));

        $test = new Decrypt("fcd");
        $this->assertFalse($test->doDecrypt("abcdef"));
        $this->assertTrue($test->doDecrypt("dffcsdsddddsadaddcfasaasdadas"));


    }

    /**
     * Test 100 tests stored in files
     *
     * @author Ibrahim Assad <Ibrahim.assad@tajawal.com>
     *
     */
    public function testReadFromFile()
    {

        $data            = file(__DIR__ . "/data/data.in", FILE_IGNORE_NEW_LINES);
        $expectedResults = file(__DIR__ . "/data/data.out", FILE_IGNORE_NEW_LINES);

        for ($itemIndex = 0; $itemIndex < count($data); $itemIndex++) {
            $lineToken = $data[$itemIndex++];
            $lineKey   = $data[$itemIndex];
            $test      = new Decrypt($lineKey);

            $expected = $expectedResults[$itemIndex / 2];

            if ($expected == "YES") {
                $this->assertTrue($test->doDecrypt($lineToken));
            } else {
                $this->assertFalse($test->doDecrypt($lineToken));
            }
        }
    }


}