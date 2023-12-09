<?php

namespace jCube\Components;

use Illuminate\View\Component;

class ColumnItem extends Component
{
  public string $name;
  
  public function __construct($name = '')
  {
    $this->name = $name;
  }
  
  public function render()
  {
    return view('components::columns.item');
  }
}
