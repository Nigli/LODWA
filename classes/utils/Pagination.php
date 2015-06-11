<?php
namespace utils;
class Pagination {
    public $total;
    public $limit;
    public $pages;
    public $page;
    public $offset;
    public $start;
    public $end;
    
    public function __construct($getpage, $count) {        
        $this->total = $count;
        $this->limit = 5;
        $this->pages = ceil($this->total / $this->limit);
        $this->page = min($this->pages,$getpage['page']);
        $this->offset = ($this->page - 1) * $this->limit;
        $this->start = $this->offset + 1;
        $this->end = min(($this->offset + $this->limit), $this->total);;
    }
    public function createLinks( $links ) {
        $last = ceil( $this->total / $this->limit );
        $start = (($this->page - $links['page'] ) > 0) ? $this->page - $links['page'] : 1;
        $end = (($this->page + $links['page'] ) < $last) ? $this->page + $links['page'] : $last;
        $html = "<div id='paginate'>";
        $class = ($this->page == 1 ) ? "disabled" : "";
        $html .= "<div class='element " . $class . "'><a href='".$links['p']."/" . ( $this->page - 1 ) . "'>&laquo;</a></div>";

        if ( $start > 1 ) {
            $html   .= "<div class='element'><a href='".$links['p']."/1'>1</a></div>";
            $html   .= "<div class='element disabled'><span>...</span></div>";
        }
        for ( $i = $start ; $i <= $end; $i++ ) {
            $class  = ( $this->page == $i ) ? "active" : "";
            $html   .= "<div class='element " . $class . "'><a href='".$links['p']."/" . $i . "'>" . $i . "</a></div>";
        }
        if ( $end < $last ) {
            $html   .= "<div class='element disabled'><span>...</span></div>";
            $html   .= "<div class='element'><a href='".$links['p']."/" . $last . "'>" . $last . "</a></div>";
        }
        $class = ( $this->page == $last ) ? "disabled" : "";
        $html .= "<div class='element " . $class . "'><a href='".$links['p']."/" . ( $this->page + 1 ) . "'>&raquo;</a></div>";
        $html .= "</div>";
        return $html;
    }
}
