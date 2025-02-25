<!-- Css -->
<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<link href="https://fonts.googleapis.com/css?family=Lato:400,700%7CRoboto:400,500%7CExo+2:600&display=swap" rel="stylesheet">

<!-- Toastr -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- Preloader -->
<link type="text/css"
      href="{{ asset('frontend/vendor/spinkit.css')}}"
      rel="stylesheet">

<!-- Perfect Scrollbar -->
<link type="text/css"
      href="{{ asset('frontend/vendor/perfect-scrollbar.css')}}"
      rel="stylesheet">

<!-- Material Design Icons -->
<link type="text/css"
      href="{{ asset('frontend/css/material-icons.css')}}"
      rel="stylesheet">

<!-- Font Awesome Icons -->
<link type="text/css"
      href="{{ asset('frontend/css/fontawesome.css')}}"
      rel="stylesheet">

<!-- Preloader -->
<link type="text/css"
      href="{{ asset('frontend/css/preloader.css')}}"
      rel="stylesheet">

<!-- App CSS -->
<link type="text/css"
      href="{{ asset('frontend/css/app.css')}}"
      rel="stylesheet">

<!-- Quill Theme -->
<link type="text/css"
      href="{{ asset('frontend/css/quill.css')}}"
      rel="stylesheet">
<!-- Select2 -->
<link type="text/css"
      href="{{ asset('frontend/vendor/select2/select2.min.css')}}"
      rel="stylesheet">
<link type="text/css"
      href="{{ asset('frontend/css/select2.css')}}"
      rel="stylesheet">

<!-- Toastr -->
<link type="text/css"
      href="{{ asset('frontend/vendor/toastr.min.css')}}"
      rel="stylesheet">
<link type="text/css"
      href="{{ asset('frontend/css/toastr.css')}}"
      rel="stylesheet">

<style>
      .toast {
            background-color: #f44336 !important;
            /* Merah untuk error */
            color: white !important;
            /* Teks putih */
      }

      .toast-success {
            background-color: #4CAF50 !important;
            /* Hijau untuk sukses */
      }

      .toast-error {
            background-color: #f44336 !important;
            /* Pastikan merah untuk error */
      }

      .tox-checklist>li:not(.tox-checklist--hidden) {
            list-style: none;
            margin: 0.25em 0;
            position: relative;
      }

      .tox-checklist>li:not(.tox-checklist--hidden)::before {
            content: url("data:image/svg+xml;charset=UTF-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2216%22%20height%3D%2216%22%20viewBox%3D%220%200%2016%2016%22%3E%3Cg%20id%3D%22checklist-unchecked%22%20fill%3D%22none%22%20fill-rule%3D%22evenodd%22%3E%3Crect%20id%3D%22Rectangle%22%20width%3D%2215%22%20height%3D%2215%22%20x%3D%22.5%22%20y%3D%22.5%22%20fill-rule%3D%22nonzero%22%20stroke%3D%22%234C4C4C%22%20rx%3D%222%22%2F%3E%3C%2Fg%3E%3C%2Fsvg%3E%0A");
            cursor: pointer;
            height: 1em;
            margin-left: -1.5em;
            margin-top: 0.125em;
            position: absolute;
            width: 1em;
      }

      .tox-checklist li:not(.tox-checklist--hidden).tox-checklist--checked::before {
            content: url("data:image/svg+xml;charset=UTF-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2216%22%20height%3D%2216%22%20viewBox%3D%220%200%2016%2016%22%3E%3Cg%20id%3D%22checklist-checked%22%20fill%3D%22none%22%20fill-rule%3D%22evenodd%22%3E%3Crect%20id%3D%22Rectangle%22%20width%3D%2216%22%20height%3D%2216%22%20fill%3D%22%234099FF%22%20fill-rule%3D%22nonzero%22%20rx%3D%222%22%2F%3E%3Cpath%20id%3D%22Path%22%20fill%3D%22%23FFF%22%20fill-rule%3D%22nonzero%22%20d%3D%22M11.5703186%2C3.14417309%20C11.8516238%2C2.73724603%2012.4164781%2C2.62829933%2012.83558%2C2.89774797%20C13.260121%2C3.17069355%2013.3759736%2C3.72932262%2013.0909105%2C4.14168582%20L7.7580587%2C11.8560195%20C7.43776896%2C12.3193404%206.76483983%2C12.3852142%206.35607322%2C11.9948725%20L3.02491697%2C8.8138662%20C2.66090143%2C8.46625845%202.65798871%2C7.89594698%203.01850234%2C7.54483354%20C3.373942%2C7.19866177%203.94940006%2C7.19592841%204.30829608%2C7.5386474%20L6.85276923%2C9.9684299%20L11.5703186%2C3.14417309%20Z%22%2F%3E%3C%2Fg%3E%3C%2Fsvg%3E%0A");
      }
</style>