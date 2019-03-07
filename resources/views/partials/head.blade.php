<head>
	<script>
	document.documentElement.className = document.documentElement.className.replace(/(\s|^)no-js(\s|$)/, '$1js$2');
	</script>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="apple-touch-icon" sizes="180x180" href="@asset('images/icons/apple-touch-icon.png')">
    <link rel="icon" type="image/png" sizes="32x32" href="@asset('images/icons/favicon-32x32.png')">
    <link rel="icon" type="image/png" sizes="16x16" href="@asset('images/icons/favicon-16x16.png')">
    <link rel="icon" type="image/png" sizes="192x192" href="@asset('images/icons/favicon-192x192.png')">
  @php wp_head() @endphp
</head>
