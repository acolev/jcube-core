<?php

namespace jCube\Components;

use Illuminate\View\Component;

class TabItem extends Component
{
  public bool $is_active;
  public string $name;
  
  public function __construct($name = '')
  {
    $this->name = $name;
    $this->is_active = view()->shared('active') === $name;
  }
  
  public function render()
  {
    return view('components::tabs.item');
  }
}
