<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ $title ?? 'Arunachal Gas Private Limited (AGPL) - Clean Energy for a Greener Arunachal' }}</title>
<meta name="description" content="Arunachal Gas Private Limited (AGPL) - A Joint Venture of BPCL & OIL. Bringing Clean Energy to the Land of the Rising Sun. City Gas Distribution, PNG & CNG.">

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,600&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<!-- Vite Styles and Scripts -->
@vite(['resources/css/app.css', 'resources/js/app.js'])
