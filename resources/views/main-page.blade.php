<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Make List</title>
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <link href="css/style.css" rel="stylesheet">
  </head>
  <body>
    <main class="px-4 py-5 my-5 d-flex flex-column align-items-center">
    
      <h1>Make List</h1>
      
      <form class="form w-100 my-3 text-start" method="POST" action="/">
        @csrf
        <div class="form-group">
          <label for="jsonContent">JSON content</label>
          <textarea class="form-control" id="jsonContent" rows="5"></textarea>
        </div>
        <button type="submit" class="btn btn-primary w-100 my-4">Submit</button>
      </form>
      
    </main>
  </body>
</html>
