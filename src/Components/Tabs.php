<?php

namespace jCube\Components;

use Illuminate\View\Component;

class Tabs extends Component
{
  public string $tabs;
  public mixed $active;
  
  public function __construct($active)
  {
    $this->tabs = \uniqid('tabs');
    $this->active = $active;
    
    view()->share('tabs', $this->tabs);
    view()->share('active', $this->active);
  }
  
  public function render()
  {
    return view('components::tabs.index');
  }
}
