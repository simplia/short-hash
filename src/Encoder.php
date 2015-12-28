<?php
namespace Simplia\ShortHash;

class Encoder {
    const ALPHABET = '0123456789abcdefghijklmnopqrstuvwxyz';

    public function getShort($string, $length = 12) {
        if(empty($string)) {
            throw new \InvalidArgumentException('Cannot encode empty string');
        }
        if($length > 25) {
            throw new \InvalidArgumentException('Maximum hash length is 25');
        }
        return substr(base_convert(md5($string), 16, 36), 0, $length);
    }

    public function encode($string) {
        if(empty($string)) {
            throw new \InvalidArgumentException('Cannot encode empty string');
        }
        $string = trim(mb_strtolower($string));
        return $this->getShort($string);
    }

    public function getUnique($string) {
        return $this->getShort(uniqid($string, true));
    }
}
