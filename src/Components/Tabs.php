<?php

namespace jCube\Components;

use Illuminate\View\Component;

class Tabs extends Component
{
  public string $id;
  public string $tabs;
  public mixed $active;
  
  public function __construct($active)
  {
    $this->tabs = \uniqid('tabs');
    $this->active = $active;
    $this->id = $this->tabs;

    view()->composer('components::tabs.item', function ($view) {
      $view->with([
        'tabs' => $this->tabs,
        'active' => $this->active,
      ]);
    });
  }
  
  public function render()
  {
    return view('components::tabs.index');
  }
}
