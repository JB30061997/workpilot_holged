<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
</head>
<body style="margin:0;background:#eef2f7;color:#172033;font-family:Inter,Arial,sans-serif;padding:0;">
<div style="display:none;max-height:0;overflow:hidden;opacity:0;color:transparent;">{{ $preheader }}</div>
<table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background:#eef2f7;">
    <tr>
        <td align="center" style="padding:32px 12px;">
            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="max-width:640px;">
                <tr>
                    <td style="background:#080b12;border-radius:22px 22px 0 0;padding:23px 30px;border-bottom:3px solid {{ $accent }};">
                        <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
                            <tr>
                                <td valign="middle">
                                    <img src="{{ $logoUrl }}" width="174" alt="WorkPilot" style="display:block;width:174px;max-width:100%;height:auto;border:0;">
                                </td>
                                <td align="right" valign="middle" style="color:#8ea2c1;font-size:11px;font-weight:800;letter-spacing:1.5px;text-transform:uppercase;">
                                    Plan smart. Work better.
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="background:#ffffff;border-radius:0 0 22px 22px;padding:34px 30px 30px;box-shadow:0 14px 40px rgba(15,23,42,.10);">
                        <span style="display:inline-block;border-radius:999px;background:{{ $badgeBackground }};color:{{ $accent }};font-size:11px;font-weight:900;letter-spacing:1.2px;padding:7px 11px;text-transform:uppercase;">
                            {{ $eyebrow }}
                        </span>
                        <h1 style="margin:18px 0 10px;color:#111827;font-size:26px;line-height:1.25;font-weight:900;">{{ $title }}</h1>
                        <p style="margin:0 0 22px;color:#64748b;font-size:15px;line-height:1.7;">{{ $intro }}</p>

                        <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="margin:0 0 24px;">
                            <tr>
                                <td style="border:1px solid #dbe4f0;border-left:4px solid {{ $accent }};border-radius:14px;background:#f8fafc;padding:19px 20px;color:#334155;font-size:15px;line-height:1.7;white-space:pre-line;">{{ $content }}</td>
                            </tr>
                        </table>

                        @if (!empty($details))
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="margin:0 0 26px;border-collapse:separate;border-spacing:0 8px;">
                                @foreach ($details as $label => $value)
                                    <tr>
                                        <td style="width:34%;color:#94a3b8;font-size:12px;font-weight:800;text-transform:uppercase;letter-spacing:.7px;">{{ $label }}</td>
                                        <td style="color:#334155;font-size:14px;font-weight:700;">{{ $value }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        @endif

                        @if (!empty($actionUrl))
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0">
                                <tr>
                                    <td style="border-radius:12px;background:{{ $accent }};">
                                        <a href="{{ $actionUrl }}" style="display:inline-block;padding:14px 22px;color:#ffffff;font-size:14px;font-weight:900;text-decoration:none;">{{ $actionLabel }}</a>
                                    </td>
                                </tr>
                            </table>
                        @endif

                        <div style="height:1px;background:#e8edf4;margin:30px 0 20px;"></div>
                        <p style="margin:0;color:#94a3b8;font-size:12px;line-height:1.6;">
                            Message automatique envoyé par WorkPilot à votre boîte professionnelle {{ $professionalDomain }}.
                            Merci de ne pas répondre directement à cet email.
                        </p>
                    </td>
                </tr>
                <tr>
                    <td align="center" style="padding:18px 20px 0;color:#9aa8ba;font-size:11px;line-height:1.6;">
                        © {{ date('Y') }} HOLGED · WorkPilot<br>
                        Pilotage des projets, actions et processus.
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
