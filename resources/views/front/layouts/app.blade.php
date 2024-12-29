<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <!-- TailwindCSS -->
  <link href="{{asset('output.css')}}" rel="stylesheet">
  
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  
  <!-- Flickity CSS -->
  <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="font-poppins text-black">
  <!-- Content Section -->
  <section id="content" class="max-w-[640px] w-full mx-auto min-h-screen flex flex-col gap-8 pb-[120px]" style="background-color: rgb(233, 239, 236);">

    @yield('content')
    
  </section>

  @stack('before-scripts')
  
  <!-- Stack After Scripts -->
  @stack('after-scripts')

</body>
</html>
