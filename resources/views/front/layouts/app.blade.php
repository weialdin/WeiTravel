<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{asset('output.css')}}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <!-- CSS -->
  <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
</head>
<body class="font-poppins text-black">
<section id="content" class="max-w-[640px] w-full mx-auto min-h-screen flex flex-col gap-8 pb-[120px]" style="background-color: rgb(198, 235, 197);">

    @yield('content')
    @stack('before-scripts')
    
    @stack('after-scripts')

</body>
</html>