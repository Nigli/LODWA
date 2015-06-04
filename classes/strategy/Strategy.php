<?php
namespace strategy;
class Strategy {
    public $id_strategy;
    public $strategy_name;
    public $futures_name;
    
public function __construct() {
    $this->futures_name=explode(',', $this->futures_name);
}
}
