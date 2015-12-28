<?php

namespace ShortHashTests;

use Simplia\ShortHash\Encoder;

class EncodeTest extends \PHPUnit_Framework_TestCase {
    function testShort() {
        $encoder = new Encoder();
        $this->assertEquals('dfrt8m99fn4s', $encoder->getShort('abcd'));
        $this->assertEquals('dfrt8m99fn4s0ggo', $encoder->getShort('abcd', 16));
        $this->assertEquals('dfrt8m99fn4s0ggoskgo', $encoder->getShort('abcd', 20));
        $this->assertEquals('dfrt8m99fn4s0ggoskgo400k0', $encoder->getShort('abcd', 25));
    }

    function testNormalization() {
        $encoder = new Encoder();
        $hash = $encoder->encode('abcd');
        $this->assertEquals($hash, $encoder->encode(' abcd'));
        $this->assertEquals($hash, $encoder->encode(' abcd '));
        $this->assertEquals($hash, $encoder->encode('ABCD'));
    }

    function testUnique() {
        $encoder = new Encoder();
        $in = 'abcd';
        $this->assertNotEquals($encoder->getUnique($in), $encoder->getUnique($in));
        $this->assertNotEquals($encoder->getUnique($in), $encoder->getUnique($in));
        $this->assertNotEquals($encoder->getUnique($in), $encoder->getUnique($in));
        $this->assertNotEquals($encoder->getUnique($in), $encoder->getUnique($in));
    }
}
