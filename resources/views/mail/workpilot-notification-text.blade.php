WORKPILOT — {{ $eyebrow }}

{{ $title }}

{{ $intro }}

{{ $content }}

@foreach ($details as $label => $value)
{{ $label }} : {{ $value }}
@endforeach

@if (!empty($actionUrl))
{{ $actionLabel }} : {{ $actionUrl }}
@endif

Message automatique envoyé par WorkPilot à votre boîte professionnelle {{ $professionalDomain }}.
