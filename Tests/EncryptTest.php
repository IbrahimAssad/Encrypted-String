<?php

namespace Iassad\Encrypted\Tests;

require_once __DIR__.'../../src/Constants.php';
require_once __DIR__.'../../src/Encrypt.php';

use Iassad\Encrypted\Encrypt;
use PHPUnit\Framework\TestCase;


class EncryptTest extends TestCase
{
    public function testRun()
    {

        echo PHP_EOL;
        echo PHP_EOL;echo PHP_EOL;echo PHP_EOL;
        echo PHP_EOL;
        echo PHP_EOL;echo PHP_EOL;echo PHP_EOL;
        $test = new Encrypt("ibrahim");
        $this->assertTrue($test->doEncrypt("ibrahim"));
        $this->assertTrue($test->doEncrypt("mIbrahid"));
        $this->assertTrue($test->doEncrypt("irahimb"));
        $this->assertTrue($test->doEncrypt("ibrahimasda"));
        $this->assertTrue($test->doEncrypt("asdasibrahim"));
        $this->assertTrue($test->doEncrypt("asaaaibrahimdddddddsadasdas"));
    }
}