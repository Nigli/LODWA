<?php
namespace program;
class Program {
    public $tr_program_name;
    public $futures_name;
    
public function __construct() {
    $this->futures_name=explode(',', $this->futures_name);
}
}