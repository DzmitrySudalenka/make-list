<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainPageController extends Controller
{
  public function index(Request $request) {
    
    $jsonContent = $request->has('jsonContent') ? $request->input('jsonContent') : file_get_contents(storage_path()."/list.json");
    
    $background = $request->has('background') ? $request->input('background') : '(241;245;249)';
    
    $depth = $request->has('depth') ? $request->input('depth') : 'max';
    
    $htmlList = '';
    
    $listBg = '';
    
    if ($background) {
      
      if ($background[0] == '(') {
        
        $rgbRegex = '/(\d{1,3})[,;](\d{1,3})[,;](\d{1,3})/';
        
        preg_match($rgbRegex, $background, $rgbValues);
        
        $listBg = sprintf("#%02x%02x%02x", $rgbValues[1], $rgbValues[2], $rgbValues[3]);
        
      } else {
        
        $bgUrl = parse_url($background);
        
        $listBg = "url(//{$bgUrl['host']}{$bgUrl['path']}) top/cover no-repeat";
        
      }
      
    }

    if ($jsonContent) {
      
      $objectList = json_decode($jsonContent);
      
      $htmlList = $this->renderListFromObject($objectList, $depth, true, $listBg);

    }

    return view('main-page', [
      'list' => $htmlList,
      'jsonContent' => $jsonContent,
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
