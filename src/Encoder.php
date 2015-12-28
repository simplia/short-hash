<?php
namespace Simplia\ShortHash;

class Encoder {
    const ALPHABET = '0123456789abcdefghijklmnopqrstuvwxyz';

    /**
     * @param string $input
     * @param int $length
     * @return string
     */
    public function getShort($input, $length = 12) {
        if(empty($input)) {
            throw new \InvalidArgumentException('Cannot encode empty string');
        }
        if($length > 25) {
            throw new \InvalidArgumentException('Maximum hash length is 25');
        }
        return substr(base_convert(md5($input), 16, 36), 0, $length);
    }

    /**
     * @param string $input
     * @return string
     */
    public function encode($input) {
        if(empty($input)) {
            throw new \InvalidArgumentException('Cannot encode empty string');
        }
        $input = trim(mb_strtolower($input));
        return $this->getShort($input);
    }

    /**
     * @param string $input
     * @return string
     */
    public function getUnique($input) {
        return $this->getShort(uniqid($input, true));
    }
}
