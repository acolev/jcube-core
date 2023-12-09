<?php

namespace jCube\Components;

use Illuminate\View\Component;

class Tabs extends Component
{
  public string $tabs;
  public string $active;
  
  public function __construct(string $active)
  {
    $this->tabs = \uniqid('tabs');
    $this->active = $active;
    
    \view()->share('tabs', $this->tabs);
  }
  
  public function render()
  {
    return view('components::tabs.index');
  }
}
