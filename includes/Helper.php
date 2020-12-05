<?php

class Lcg
{
    public function __construct() //$modulus, $multiplier, $increment, $seed
    {
        $this->modulus = 256;
        $this->multiplier = 11;
        $this->increment = 1;
        $this->seed = 0;
    }

    public function encrypt($plainText)
    {
        $bytes = unpack('C*', $plainText);
        $xors = [];
        foreach ($bytes as $val) {
            $xors[] = $val ^ $this->next();
        }
        $str = pack('C*', ...$xors);
        return base64_encode($str);
    }

    public function next()
    {
        // Y = (a.X + c) mod m
        $val = ($this->multiplier * $this->seed) + $this->increment;
        $this->seed = $val % $this->modulus;
        return $this->seed;
    }

    /*public function decrypt($base64EncodedValue)
    {
        $plainText = base64_decode($base64EncodedValue);

        $lcg = new Lcg();
        $bytes = unpack('C*', $plainText);
        $xors = [];
        foreach ($bytes as $val) {
            $xors[] = $val ^ $lcg->next();
        }
        $str = pack('C*', ...$xors);
        return $str;
    }*/
}

function alertSuccess($msg){
    return '<div class="alert alert-success text-center" role="alert">'.$msg.'</div>';
}

function alertError($msg){
    return '<div class="alert alert-danger text-center" role="alert">'.$msg.'</div>';
}
