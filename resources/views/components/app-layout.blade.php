@php
    $settings = \Illuminate\Support\Facades\Schema::hasTable('settings')
        ? \App\Models\Setting::pluck('value', 'key')->all()
        : [];
    $siteName = $settings['site_name'] ?? 'Hồ Nam Landscape';
    $currentLocale = app()->getLocale();
@endphp
<!DOCTYPE html>
<html lang="{{ $currentLocale }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? $siteName }}</title>
    <meta name="description" content="{{ $description ?? $siteName }}">
    <style>
        .goog-te-banner-frame,
        .goog-te-gadget,
        .skiptranslate {
            display: none !important;
        }

        body {
            top: 0 !important;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-charcoal antialiased">
    @include('partials.header')

    <main>
        {{ $slot }}
    </main>

    @include('partials.footer')

    <!-- Thanh thông tin liên hệ cố định 100% hiển thị (Dùng CSS Inline trực tiếp) -->
    <div style="position: fixed; right: 16px; top: 50%; transform: translateY(-50%); z-index: 9999; display: flex; flex-direction: column; align-items: center; gap: 12px; padding: 12px 10px; border-radius: 28px; border: 1px solid rgba(255,255,255,0.2); background: linear-gradient(to bottom, #B36D2A, #A85E22, #8B451A); box-shadow: 0 18px 36px rgba(0,0,0,0.32); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px);">
        <a href="{{ $settings['floating_zalo'] ?? 'https://zalo.me/0643586494' }}" target="_blank" rel="noopener noreferrer" style="display: flex; width: 44px; height: 44px; align-items: center; justify-content: center; border-radius: 50%; background: rgba(255,255,255,0.15); font-size: 11px; font-weight: 800; color: #ffffff; text-decoration: none; transition: transform 0.2s;" title="Chat Zalo" aria-label="Chat Zalo">
            Zalo
        </a>

        <a href="tel:{{ str_replace(['.', ' '], '', $settings['floating_phone'] ?? '064.358.6494') }}" style="display: flex; width: 44px; height: 44px; align-items: center; justify-content: center; border-radius: 50%; background: rgba(255,255,255,0.15); color: #ffffff; text-decoration: none; transition: transform 0.2s;" title="{{ __('navigation.hotline') }}" aria-label="{{ __('navigation.hotline') }}">
            <svg xmlns="http://www.w3.org/2000/svg" style="width: 20px; height: 20px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
            </svg>
        </a>

        <a href="{{ $settings['floating_chat'] ?? 'mailto:cayxanhhonam.vt@gmail.com' }}" style="display: flex; width: 44px; height: 44px; align-items: center; justify-content: center; border-radius: 50%; background: rgba(255,255,255,0.15); color: #ffffff; text-decoration: none; transition: transform 0.2s;" title="{{ __('navigation.consulting') }}" aria-label="{{ __('navigation.consulting') }}">
            <svg xmlns="http://www.w3.org/2000/svg" style="width: 20px; height: 20px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </a>

        <a href="{{ $settings['floating_facebook'] ?? 'https://facebook.com/cayxanhhonam' }}" target="_blank" rel="noopener noreferrer" style="display: flex; width: 44px; height: 44px; align-items: center; justify-content: center; border-radius: 50%; background: rgba(255,255,255,0.15); font-size: 16px; font-weight: 700; color: #ffffff; text-decoration: none; transition: transform 0.2s;" title="Facebook" aria-label="Facebook">
            f
        </a>
    </div>

    @if($currentLocale === 'en')
        <div id="google_translate_element" class="hidden"></div>
        <script>
            document.cookie = 'googtrans=/vi/en;path=/';
            document.cookie = 'googtrans=/vi/en;domain=' + window.location.hostname + ';path=/';

            window.googleTranslateElementInit = function () {
                new google.translate.TranslateElement({
                    pageLanguage: 'vi',
                    includedLanguages: 'vi,en',
                    autoDisplay: false
                }, 'google_translate_element');

                window.setTimeout(function () {
                    var combo = document.querySelector('.goog-te-combo');
                    if (combo) {
                        combo.value = 'en';
                        combo.dispatchEvent(new Event('change'));
                    }
                }, 500);
            };
        </script>
        <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    @else
        <script>
            document.cookie = 'googtrans=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/';
            document.cookie = 'googtrans=;expires=Thu, 01 Jan 1970 00:00:00 GMT;domain=' + window.location.hostname + ';path=/';
        </script>
    @endif
</body>
</html>
