@php
    use Illuminate\Support\Facades\DB;
    $company = DB::table('companyinfos')->first(); // ✅ returns only the first row (an object)
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">




    <!-- Site Title -->
    <title>@yield('title', '')</title>

    <!-- CSS Files -->
    @include('user.partials.head-css')

    <style>
        .skiptranslate span,
        .skiptranslate a,
        .skiptranslate img,
        .skiptranslate::before,
        .skiptranslate::after {
            display: none !important;
        }

        .skiptranslate {
            font-size: 0px !important;
        }
    </style>


    <style>
        /* Floating Language Button */
        .language-fab {
            position: fixed;
            top: 10px;
            right: 10px;
            z-index: 9999;
            cursor: pointer;
            background-color: #022b6d;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .language-fab i {
            color: white;
            font-size: 2rem;
        }

        /* Modal Overlay */
        .modal-overlay {
            display: none;
            /* Hidden by default */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            z-index: 10000;
            justify-content: center;
            align-items: center;
        }

        /* Modal Content */
        .modal-content {
            background: #fff;
            padding: 2rem;
            border-radius: 10px;
            max-width: 400px;
            width: 90%;
            position: relative;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            animation: fadeIn 0.3s ease-in-out;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 1.5rem;
            color: #333;
            cursor: pointer;
        }

        /* Google Translate Dropdown Style */
        #google_translate_element select {
            padding: 0.5rem 1rem;
            font-size: 1rem;
            border-radius: 5px;
            border: 1px solid #ccc;
            width: 100%;
            margin-top: 1rem;
            appearance: none;
            background-color: #f8f8f8;
            color: #333;
        }

        /* Simple Fade In Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>


    {{-- @yield('favicon') --}}
    @php
        $extension = '';

        if (!empty($company->favicon)) {
            $extension = pathinfo($company->favicon, PATHINFO_EXTENSION);
        }

        $faviconPath = $company->favicon ?? 'default/image/favicon/default_favicon.ico';
    @endphp

    @if (!empty($company->favicon))
        @switch($extension)
            @case('svg')
                <link rel="icon" href="{{ asset($faviconPath) }}" type="image/svg+xml">
            @break

            @case('png')
                <link rel="icon" href="{{ asset($faviconPath) }}" type="image/png">
            @break

            @default
                <link rel="icon" href="{{ asset($faviconPath) }}" type="image/x-icon">
        @endswitch
    @else
        <link rel="icon" href="{{ asset($faviconPath) }}" type="image/x-icon">
    @endif

    @yield('style')



    {{-- chat boat script  --}}
    <!--Start of Tawk.to Script-->
    {{-- <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/6891fe2cbe6f23192336d305/1j1t4hodj';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script> --}}
    <!--End of Tawk.to Script-->




    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/6895ce652f4d2419293f781a/1j24isfq2';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    <!--End of Tawk.to Script-->





    <style>
        .google-translate-container {
            position: fixed;
            top: 0.625rem;
            /* 10px */
            right: 0.625rem;
            /* 10px */
            z-index: 9999;
            background-color: #ffffff;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.1);
        }

        #google_translate_element select {
            padding: 0.5rem 0.5rem;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 0.5rem;
            background-color: #f8f8f8;
            color: #333;
            appearance: none;
            /* Remove default arrow */
            -webkit-appearance: none;
            -moz-appearance: none;
            cursor: pointer;
            outline: none;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        /* Custom arrow using background image */
        #google_translate_element select {
            background-image: url("data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%204%205'%3E%3Cpath%20fill='%23333'%20d='M2%200L0%202h4L2%200zM2%205L0%203h4l-2%202z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 0.65rem;
        }

        #google_translate_element select:hover {
            background-color: #e9ecef;
        }

        #google_translate_element select:focus {
            border-color: #007bff;
        }
    </style>






</head>

<body>


    <!-- End Main -->

    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en'
            }, 'google_translate_element');
        }
    </script>

    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
    </script>


    <!-- Floating Language Icon Button -->
    <div class="language-fab" onclick="openLanguageModal()">
        <i class="fas fa-language"></i>
    </div>

    <!-- Modal -->
    <div id="languageModal" class="modal-overlay">
        <div class="modal-content">
            <span class="close-btn" onclick="closeLanguageModal()">&times;</span>
            <h2>Select Your Language</h2>
            <div id="google_translate_element"></div>
        </div>
    </div>




    @include('user.partials.header')
    {{-- Optional custom styles/scripts before content --}}
    @yield('body')

    {{-- Main content section --}}
    @yield('content')

    {{-- Footer --}}
    @include('user.partials.footer')

    {{-- JS Files --}}
    @include('user.partials.vendor-scripts')

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const skipTranslate = document.querySelector('.skiptranslate');
            if (skipTranslate) {
                const originalText = skipTranslate.innerText;
                // Check if it contains "Powered by" and only keep the word "One"
                skipTranslate.innerText = 'One';
            }
        });
    </script>

    <!-- Modal Open/Close Script -->
    <script>
        function openLanguageModal() {
            document.getElementById("languageModal").style.display = "flex";
        }

        function closeLanguageModal() {
            document.getElementById("languageModal").style.display = "none";
        }

        // Close modal when clicking outside content
        window.onclick = function(event) {
            var modal = document.getElementById("languageModal");
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>


    @yield('script')

</body>

</html>
