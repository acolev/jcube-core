<?php

namespace jCube\Components;

use Illuminate\View\Component;

class TabItem extends Component
{
  public function __construct()
  {
  
  }
  
  public function render()
  {
    return view('components::tabs.item');
  }
}
