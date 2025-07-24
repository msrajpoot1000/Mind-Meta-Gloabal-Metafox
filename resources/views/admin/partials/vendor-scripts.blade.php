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

<script src="{{ URL::asset('default/js/default-script.js') }}"></script>


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


<script src="https://cdn.ckeditor.com/4.22.1/standard-all/ckeditor.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const descriptionFields = document.querySelectorAll('[id^="description"]');

        descriptionFields.forEach((element) => {
            CKEDITOR.replace(element.id, {
                extraPlugins: 'colorbutton,font',


                colorButton_colors: '000000,FF0000,00FF00,0000FF,F1C40F,9B59B6,34495E,1ABC9C,FFFFFF',
                colorButton_enableMore: true, // shows “More Colors...” popup

                toolbar: [{
                        name: 'basicstyles',
                        items: ['Bold', 'Italic', 'Underline', 'Font', 'FontSize']
                    },
                    {
                        name: 'colors',
                        items: ['TextColor', 'BGColor']
                    },
                    {
                        name: 'paragraph',
                        items: ['NumberedList', 'BulletedList']
                    },
                    {
                        name: 'tools',
                        items: ['Maximize']
                    }
                ],
                height: 200
            });

        });
    });
</script>




<script>
    window.validationErrors = {!! json_encode($errors->all()) !!};
</script>




@yield('scripts')
