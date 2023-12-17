<?php

namespace jCube\Components;

use Illuminate\View\Component;

class TableItem extends Component
{
  public mixed $cols;
  
  public function __construct($cols = [])
  {
    $this->cols = $cols;
  }
  
  public function render()
  {
    return view('components::table.item');
  }
}
