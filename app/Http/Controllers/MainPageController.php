<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainPageController extends Controller
{
  public function index(Request $request) {
    
    $htmlList = '';
    
    $jsonList = $request->input('jsonContent');

    if ($jsonList) {
      
      $objectList = json_decode($jsonList);
      
      $htmlList = $this->renderListFromObject($objectList);

    }

    return view('main-page', ['list' => $htmlList]);

  }
  
  private function renderListFromObject($listElement) {
    
    $renderedList = '';
    
    if ($listElement->type == 'list') {
      
      $renderedList .= "<ul class='list' name='{$listElement->name}'>
        <div class='list__name'>{$listElement->name}</div>
        <div class='list__content'>";
      
      foreach($listElement->items as $listItem) {
        
        $renderedList .= $this->renderListFromObject($listItem);
        
      }
      
      $renderedList .= "</div></ul>";
      
    } else {
      
      $renderedList .= "<li class='list__item' name='{$listElement->name}'>{$listElement->value}</li>";
      
    }
    
    return $renderedList;
    
  }
}
