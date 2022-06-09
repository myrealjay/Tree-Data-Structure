<?php
namespace Playground;

class Node{
    public $val;
    public $left;
    public $right;
    
    public function __construct($val){
        $this->val = $val;
        $this->left = null;
        $this->right = null;
    }
}