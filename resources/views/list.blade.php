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
          <textarea class="form__control json-content" id="jsonContent" name="jsonContent">{{ $jsonContent }}</textarea>
          
          <div class="form__groups">
            
            <div class="form__group">
              <label for="background">Background:</label>
              <input class="form__control" type="text" id="background" name="background" value="{{ $background }}">
            </div>
            
            <div class="form__group">
              <label for="depth">Depth:</label>
              <input class="form__control" type="text" id="depth" name="depth" value="{{ $depth }}">
            </div>
            
          </div>
          
          <button type="submit" class="btn">Generate</button>
        </form>
        
      </section>
      
      <section class="section">
        
        <h2 class="generated-list__title">Generated list</h2>
        
        <div class="generated-list__content">
        
          @if($errors->any())
            <div class="error">{{ $errors->first() }}</div>
          @elseif ($list)
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
