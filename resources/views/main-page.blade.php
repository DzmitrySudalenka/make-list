<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Make List</title>
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="css/style.css" rel="stylesheet">
  </head>
  <body>
    <main class="main">
    
      <section class="section">
      
        <h1>Make List</h1>
        
        <form class="form" method="POST" action="/">
          @csrf
          <label for="jsonContent">JSON content</label>
          <textarea class="json-content" id="jsonContent" name="jsonContent">{
    "name": "list",
    "type": "list",
    "items": [
      {
        "name": "subList_lvl-1_child-1",
        "type": "list",
        "items": [
          {"name": "subList_lvl-1_child-1_item-1", "type": "list-item", "value": "1"},
          {
            "name": "subList_lvl-1_child-1_lvl-2_child-1",
            "type": "list",
            "items": [
              {"name": "subList_lvl-1_child-1_lvl-2_child-1_item-1", "type": "list-item", "value": "1"},
              {"name": "subList_lvl-1_child-1_lvl-2_child-1_item-2", "type": "list-item", "value": "2"}
            ]
          },
          {"name": "subList_lvl-1_child-1_item-3", "type": "list-item", "value": "3"}
        ]
      },
      {
        "name": "subList_lvl-1_child-2",
        "type": "list",
        "items": [
          {"name": "subList_lvl-1_child-2_item-1", "type": "list-item", "value": "1"},
          {"name": "subList_lvl-1_child-2_item-2", "type": "list-item", "value": "2"}
        ]
      }
    ]
  }</textarea>
          <button type="submit" class="btn">Generate</button>
        </form>
        
      </section>
      
      <section class="section">
      
        <h2 class="generated-list__title">Generated list</h2>
        
        <div class="generated-list__content">
        
        @if ($list)
          
          {!! $list !!}
          
        @else
          
          Empty.

        @endif
        
        </div>
      
      </section>
      
    </main>
    
    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
      integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
      crossorigin="anonymous"></script>
    
    <script src="js/functions.js"></script>
  </body>
</html>
