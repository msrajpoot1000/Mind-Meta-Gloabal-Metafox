<!-- JAVASCRIPT -->
{{-- <script src="https://unpkg.com/eva-icons"></script> --}}


<script src="{{ URL::asset('build/libs/eva-icons/eva.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/metismenujs/metismenujs.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/simplebar/simplebar.min.js') }}"></script>

<script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/jsvectormap/maps/world-merc.js') }}"></script>
<script src="{{ URL::asset('build/js/pages/dashboard.init.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>

<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Toastr JS & CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


{{-- Custom Script  --}}
<script src="{{ URL::asset('build/js/custom-script.js') }}"></script>



<script>
    $(document).ready(function() {
        @if (Session::has('message'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            };
            toastr.success("{{ session('message') }}");
        @endif

        @if (Session::has('error'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            };
            toastr.error("{{ session('error') }}");
        @endif

        @if (Session::has('success'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            };
            toastr.success("{{ session('success') }}");
        @endif
    });
</script>



{{-- // CKEditor --}}
<script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>;
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Select all elements with IDs that start with 'description'
        const descriptionFields = document.querySelectorAll('[id^="description"]');

        descriptionFields.forEach((element) => {
            ClassicEditor.create(element)
                .catch((error) => {
                    console.error(`Error initializing CKEditor on #${element.id}:`, error);
                });
        });
    });
</script>

<script>
    window.validationErrors = {!! json_encode($errors->all()) !!};
</script>




@yield('scripts')
