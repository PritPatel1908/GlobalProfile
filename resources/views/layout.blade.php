<!DOCTYPE html>
<html>

<head>
    <title>Global Profile</title>
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet"> -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css" />

    @yield('extra_css')
</head>

<body>

    <div class="container" style="margin-top: 15px;">
        @yield('content')
    </div>

    <!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script> -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- datetimepicker jQuery CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js">
    </script>
    <script type="text/javascript">
        jQuery(function() {
            jQuery('.datepicker').datetimepicker({
                format: 'Y-m-d'
            });

            jQuery('#card_date_of_issue').datetimepicker({
                format: 'Y-m-d',

                onShow: function(ct) {
                    this.setOptions({
                        maxDate: jQuery('#card_valid_till').val() ? jQuery('#card_valid_till')
                            .val() : false
                    })
                },
            });
            jQuery('#card_valid_till').datetimepicker({
                format: 'Y-m-d',

                onShow: function(ct) {
                    this.setOptions({
                        minDate: jQuery('#card_date_of_issue').val() ? jQuery(
                            '#card_date_of_issue').val() : false
                    })
                },
            });

        });
    </script>

    <script>
        $(document).ready(function() {

            function handleKeyup() {
                $(this).val('');
            }

            function handleKeypress(e) {
                e.preventDefault();
            }

            $('.txt_datepicker').on('keyup', handleKeyup);
            $('.txt_datepicker').on('keypress', handleKeypress);
        });

        function checkMaxLength(input, maxLength) {
            if (input.value.length > maxLength) {
                input.value = input.value.slice(0, maxLength);
            }
        }
    </script>

    @yield('extra_js')

</body>

</html>
