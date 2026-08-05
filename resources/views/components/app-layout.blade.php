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

    @if(($settings['show_floating_bar'] ?? '1') === '1' || true)
        <div
            x-data="{ open: false }"
            @keydown.escape.window="open = false"
            @click.outside="open = false"
            class="fixed bottom-5 right-5 z-50 flex flex-col items-end gap-3 sm:bottom-7 sm:right-7"
            style="position: fixed; bottom: 24px; right: 24px; z-index: 9999; display: flex; flex-direction: column; align-items: flex-end; gap: 12px;"
        >
            <div
                id="floating-contact-menu"
                x-cloak
                x-show="open"
                x-transition:enter="transition duration-200 ease-out"
                x-transition:enter-start="translate-y-3 opacity-0"
                x-transition:enter-end="translate-y-0 opacity-100"
                x-transition:leave="transition duration-150 ease-in"
                x-transition:leave-start="translate-y-0 opacity-100"
                x-transition:leave-end="translate-y-3 opacity-0"
                class="flex flex-col items-center gap-2 rounded-[28px] border border-white/15 bg-gradient-to-b from-[#B36D2A] via-[#A85E22] to-[#8B451A] p-2.5 shadow-[0_18px_36px_rgba(0,0,0,0.24)] backdrop-blur-xl"
                style="display: flex; flex-direction: column; align-items: center; gap: 8px; padding: 10px; border-radius: 28px; border: 1px solid rgba(255,255,255,0.15); background: linear-gradient(to bottom, #B36D2A, #A85E22, #8B451A); box-shadow: 0 18px 36px rgba(0,0,0,0.24); backdrop-filter: blur(12px);"
            >
                @if(($settings['show_floating_zalo'] ?? '1') === '1' && filled($settings['floating_zalo'] ?? 'https://zalo.me/0643586494'))
                    <a href="{{ $settings['floating_zalo'] ?? 'https://zalo.me/0643586494' }}" target="_blank" rel="noopener noreferrer" @click="open = false" class="flex h-11 w-11 items-center justify-center rounded-full bg-white/10 text-[10px] font-extrabold tracking-wide text-white transition duration-300 hover:-translate-y-0.5 hover:bg-white/20" style="display: flex; width: 44px; height: 44px; align-items: center; justify-content: center; border-radius: 50%; background: rgba(255,255,255,0.15); font-size: 11px; font-weight: 800; color: #ffffff; text-decoration: none;" title="Chat Zalo" aria-label="Chat Zalo">
                        Zalo
                    </a>
                @endif

                @if(($settings['show_floating_phone'] ?? '1') === '1' && filled($settings['floating_phone'] ?? '064.358.6494'))
                    <a href="tel:{{ str_replace(['.', ' '], '', $settings['floating_phone'] ?? '064.358.6494') }}" @click="open = false" class="flex h-11 w-11 items-center justify-center rounded-full bg-white/10 text-white transition duration-300 hover:-translate-y-0.5 hover:bg-white/20" style="display: flex; width: 44px; height: 44px; align-items: center; justify-content: center; border-radius: 50%; background: rgba(255,255,255,0.15); color: #ffffff; text-decoration: none;" title="{{ __('navigation.hotline') }}" aria-label="{{ __('navigation.hotline') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width: 20px; height: 20px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </a>
                @endif

                @if(($settings['show_floating_chat'] ?? '1') === '1' && filled($settings['floating_chat'] ?? 'mailto:cayxanhhonam.vt@gmail.com'))
                    <a href="{{ $settings['floating_chat'] ?? 'mailto:cayxanhhonam.vt@gmail.com' }}" @click="open = false" class="flex h-11 w-11 items-center justify-center rounded-full bg-white/10 text-white transition duration-300 hover:-translate-y-0.5 hover:bg-white/20" style="display: flex; width: 44px; height: 44px; align-items: center; justify-content: center; border-radius: 50%; background: rgba(255,255,255,0.15); color: #ffffff; text-decoration: none;" title="{{ __('navigation.consulting') }}" aria-label="{{ __('navigation.consulting') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width: 20px; height: 20px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </a>
                @endif

                @if(($settings['show_floating_facebook'] ?? '1') === '1' && filled($settings['floating_facebook'] ?? 'https://facebook.com/cayxanhhonam'))
                    <a href="{{ $settings['floating_facebook'] ?? 'https://facebook.com/cayxanhhonam' }}" target="_blank" rel="noopener noreferrer" @click="open = false" class="flex h-11 w-11 items-center justify-center rounded-full bg-white/10 text-sm font-bold text-white transition duration-300 hover:-translate-y-0.5 hover:bg-white/20" style="display: flex; width: 44px; height: 44px; align-items: center; justify-content: center; border-radius: 50%; background: rgba(255,255,255,0.15); font-size: 16px; font-weight: 700; color: #ffffff; text-decoration: none;" title="Facebook" aria-label="Facebook">
                        f
                    </a>
                @endif
            </div>

            <button
                type="button"
                @click="open = !open"
                :aria-expanded="open.toString()"
                aria-controls="floating-contact-menu"
                class="flex h-14 w-14 items-center justify-center rounded-full bg-gradient-to-br from-[#C99A50] to-[#9A6329] text-white shadow-[0_12px_30px_rgba(0,0,0,0.28)] ring-1 ring-white/30 transition duration-300 hover:-translate-y-0.5 hover:shadow-[0_16px_36px_rgba(0,0,0,0.32)] focus:outline-none focus:ring-4 focus:ring-gold/30"
                style="display: flex; width: 56px; height: 56px; align-items: center; justify-content: center; border-radius: 50%; background: linear-gradient(135deg, #C99A50, #9A6329); color: #ffffff; border: none; cursor: pointer; box-shadow: 0 12px 30px rgba(0,0,0,0.28);"
                title="Mở menu liên hệ"
                aria-label="Mở hoặc đóng menu liên hệ"
            >
                <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" style="width: 24px; height: 24px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8a9.86 9.86 0 01-4.255-.949L3 20l1.395-3.72A7.51 7.51 0 013 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                <svg x-cloak x-show="open" xmlns="http://www.w3.org/2000/svg" style="width: 24px; height: 24px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    @endif

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
