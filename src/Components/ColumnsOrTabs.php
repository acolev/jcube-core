<?php

namespace jCube\Components;

use Illuminate\View\Component;

class ColumnsOrTabs extends Component
{
  public string $id;
  public string $columns;
  public mixed $active;
  public mixed $cols;
  public mixed $max;
  
  public function __construct(mixed $active, int $max = 2, int $cols = 1)
  {
    $this->columns = \uniqid('columns');
    $this->active = $active;
    $this->cols = $cols;
    $this->max = $max;
    $this->id = genTrx(4, 'qwertyuiopasdfghjklxcvbnm');
    
    
    view()->composer('components::columns.item', function ($view) {
      $view->with([
        'columns' => $this->columns,
        'active' => $this->active,
        'parent' => $this
      ]);
    });
  }
  
  public function render()
  {
    return view('components::columns.index');
  }
}
