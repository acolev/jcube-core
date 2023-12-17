<?php

namespace jCube\Components;

use Illuminate\View\Component;

class Table extends Component
{
  public string $id;
  public int $perPage;
  public int $currentPage;
  public bool $dark;
  public bool $responsive;
  public array $fields;
  public bool $header;
  public bool $footer;
  public bool $nowrap;
  public bool $striped;
  public bool $stripedColumns;
  public bool $hover;
  public bool $card;
  
  public function __construct(
    $perPage = 20,
    $currentPage = 1,
    $dark = false,
    $responsive = true,
    $fields = [],
    $header = true,
    $footer = false,
    $nowrap = true,
    $striped = false,
    $stripedColumns = false,
    $hover = false,
    $card = false,
    $id = null
  )
  {
    $this->id = $id ?: genTrx(6, 'qwertyuiopasdfghjklzxcvbnm');
    $this->perPage = $perPage;
    $this->currentPage = $currentPage;
    $this->dark = $dark;
    $this->responsive = $responsive;
    $this->fields = $fields;
    $this->header = $header;
    $this->footer = $footer;
    $this->nowrap = $nowrap;
    $this->striped = $striped;
    $this->stripedColumns = $stripedColumns;
    $this->hover = $hover;
    $this->card = $card;
    
    view()->composer('components::table.item', function ($view) {
      $view->with([
        'fields' => $this->fields,
      ]);
    });
  }
  
  public function render()
  {
    return view('components::table.index');
  }
}
