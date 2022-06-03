<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainPageController extends Controller
{
  public function index(Request $request) {
    
    $htmlList = '';
    
    $jsonList = $request->input('jsonContent');
    
    $background = $request->input('background');
    
    if ($background) {
      
      if ($background[0] == '(') {
        
        $rgbRegex = '/(\d{1,3})[,;](\d{1,3})[,;](\d{1,3})/';
        
        preg_match($rgbRegex, $background, $rgbValues);
        
        $background = sprintf("#%02x%02x%02x", $rgbValues[1], $rgbValues[2], $rgbValues[3]);
        
      } else {
        
        $bgUrl = parse_url($background);
        
        $background = "url(//{$bgUrl['host']}{$bgUrl['path']}) top/cover no-repeat";
        
      }
      
    }
    
    $depth = $request->input('depth');

    if ($jsonList) {
      
      $objectList = json_decode($jsonList);
      
      $htmlList = $this->renderListFromObject($objectList, $depth, true, $background);

    }

    return view('main-page', [
      'list' => $htmlList,
      'background' => $background,
      'depth' => $depth
    ]);

  }
  
  private function renderListFromObject($listElement, $depth, $isFirstEntry = false, $background = '') {
    
    $renderedList = '';
    
    if ($listElement->type == 'list') {
      
      if ($depth-- >= 0 || $depth == 'max') {
        
        $renderedList .= "<ul class='list' name='{$listElement->name}'".($isFirstEntry ? "style='background: {$background}';" : '').">
          <div class='list__name'>{$listElement->name}</div>
          <div class='list__content'>";
        
        foreach($listElement->items as $listItem) {
          
          $renderedList .= $this->renderListFromObject($listItem, $depth);
          
        }
        
        $renderedList .= "</div></ul>";
        
      }
      
    } else {
      
      $renderedList .= "<li class='list__item' name='{$listElement->name}'>{$listElement->value}</li>";
      
    }
    
    return $renderedList;
    
  }
}
