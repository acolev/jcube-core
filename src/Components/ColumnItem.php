<?php

namespace jCube\Components;

use Illuminate\View\Component;

class ColumnItem extends Component
{
  public string $name;
  public string $id;
  
  public function __construct($name = '')
  {
    $this->name = $name;
    $this->id = genTrx(3, 'qwertyuiopasdfghjklxcvbnm');
  }
  
  public function render()
  {
    return view('components::columns.item');
  }
}
