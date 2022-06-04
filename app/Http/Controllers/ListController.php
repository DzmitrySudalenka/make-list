<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;

class ListController extends Controller
{
  public function index(Request $request) {
    
    try {
      
      $jsonContent = $request->has('jsonContent') ? $request->input('jsonContent') : file_get_contents(storage_path()."/list.json");
      
      $background = $request->has('background') ? $request->input('background') : '(241;245;249)';
      
      $depth = $request->has('depth') ? $request->input('depth') : 'max';
      
      if ($depth <= 0 && $depth != 'max') throw new Exception("Depth must be from 1 and above including 'max'.");
      
      $listBg = $this->makeListBg($background);
      
      $htmlList = '';
    
      if ($jsonContent) {
        
        $objectList = json_decode($jsonContent);
        
        $htmlList = $this->renderListFromObject($objectList, $depth, true, $listBg);
        
      }
      
    } catch (Exception $exception) {
      
      return view('list', [
        'jsonContent' => $jsonContent,
        'background' => $background,
        'depth' => $depth
      ])->withErrors($exception->getMessage());;
      
    }
    
    return view('list', [
      'list' => $htmlList,
      'jsonContent' => $jsonContent,
      'background' => $background,
      'depth' => $depth
    ]);

  }
  
  private function makeListBg($background) {
    
    try {
    
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
      
    } catch (Exception $exception) {
      
      throw new Exception("Background error.");
      
    }
    
    return $listBg;
    
  }
  
  private function renderListFromObject($listElement, $depth, $isFirstEntry = false, $background = '') {
    
    try {
    
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
      
    } catch (Exception $exception) {
      
      throw new Exception("JSON content error.");
      
    }
    
    return $renderedList;
    
  }
  
}
