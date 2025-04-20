<!-- JavaScript -->
<!-- jQuery -->
<script src="{{ asset('frontend/vendor/jquery.min.js')}}"></script>

<!-- Bootstrap -->
<script src="{{ asset('frontend/vendor/popper.min.js')}}"></script>
<script src="{{ asset('frontend/vendor/bootstrap.min.js')}}"></script>

<!-- Perfect Scrollbar -->
<script src="{{ asset('frontend/vendor/perfect-scrollbar.min.js')}}"></script>

<!-- DOM Factory -->
<script src="{{ asset('frontend/vendor/dom-factory.js')}}"></script>

<!-- MDK -->
<script src="{{ asset('frontend/vendor/material-design-kit.js')}}"></script>

<!-- App JS -->
<script src="{{ asset('frontend/js/app.js')}}"></script>

<!-- Preloader -->
<script src="{{ asset('frontend/js/preloader.js')}}"></script>

<!-- Global Settings -->
<script src="{{ asset('frontend/js/settings.js')}}"></script>

<!-- Flatpickr -->
<script src="{{ asset('frontend/vendor/flatpickr/flatpickr.min.js')}}"></script>
<script src="{{ asset('frontend/js/flatpickr.js')}}"></script>

<!-- Moment.js -->
<script src="{{ asset('frontend/vendor/moment.min.js')}}"></script>
<script src="{{ asset('frontend/vendor/moment-range.js')}}"></script>

<!-- Chart.js -->
<script src="{{ asset('frontend/vendor/Chart.min.js')}}"></script>
<script src="{{ asset('frontend/js/chartjs.js')}}"></script>

<!-- UI Charts Page JS -->
<script src="{{ asset('frontend/js/chartjs-rounded-bar.js')}}"></script>
<script src="{{ asset('frontend/js/chartjs.js')}}"></script>

<!-- Chart.js Samples -->
<script src="{{ asset('frontend/js/page.student-dashboard.js')}}"></script>

<!-- List.js -->
<script src="{{ asset('frontend/vendor/list.min.js')}}"></script>
<script src="{{ asset('frontend/js/list.js')}}"></script>

<!-- Tables -->
<script src="{{ asset('frontend/js/toggle-check-all.js')}}"></script>
<script src="{{ asset('frontend/js/check-selected-row.js')}}"></script>

<!-- Quill -->
<script src="{{ asset('frontend/vendor/quill.min.js')}}"></script>
<script src="{{ asset('frontend/js/quill.js')}}"></script>

<!-- Select2 -->
<script src="{{ asset('frontend/vendor/select2/select2.min.js')}}"></script>
<script src="{{ asset('frontend/js/select2.js')}}"></script>

<!-- Highlight.js -->
<script src="{{ asset('frontend/js/hljs.js')}}"></script>

<!-- Toastr -->
<script src="{{ asset('frontend/vendor/toastr.min.js')}}"></script>
<script src="{{ asset('frontend/js/toastr.js')}}"></script>

    <!-- TinyMCE Script -->
    <script src="https://cdn.tiny.cloud/1/mb6v1mpb85o4tfoc78yvirj7mmxd68gfsthuoizmybjhhak1/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://cdn.ckbox.io/ckbox/latest/ckbox.js"></script>
    
    <script>
  tinymce.init({
    selector: 'textarea#myeditorinstance',
    setup: function (editor) {
    editor.on('init', function () {
      console.log('TinyMCE initialized');
    });
  },
    file_picker_types: 'file image media',
    plugins: [
      'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
      'checklist', 'mediaembed', 'casechange', 'export', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'editimage', 'advtemplate', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown',
      'importword', 'exportword', 'exportpdf'
    ],
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Author name',
    image_title: true,
    automatic_uploads: true,
    file_picker_types: 'image',
    file_picker_callback: (cb, value, meta) => {
      const input = document.createElement('input');
      input.setAttribute('type', 'file');
      input.setAttribute('accept', 'image/*');
  
      input.addEventListener('change', (e) => {
        const file = e.target.files[0];
  
        // Check if the file is larger than 10MB (10MB = 10485760 bytes)
        const MAX_SIZE = 10485760; // 10 MB
        if (file.size > MAX_SIZE) {
          alert('The selected file is too large. Maximum size is 10MB.');
          return; // Stop further processing if the file is too large
        }
  
        const reader = new FileReader();
        reader.addEventListener('load', () => {
          /*
            Now we need to register the blob in TinyMCE's image blob
            registry. This is necessary for handling images locally
            in the editor without needing a server-side upload.
          */
          const id = 'blobid' + (new Date()).getTime();
          const blobCache =  tinymce.activeEditor.editorUpload.blobCache;
          const base64 = reader.result.split(',')[1];
          const blobInfo = blobCache.create(id, file, base64);
          blobCache.add(blobInfo);
  
          /* call the callback and populate the Title field with the file name */
          cb(blobInfo.blobUri(), { title: file.name });
        });
  
        // Start reading the file as base64
        reader.readAsDataURL(file);
      });
  
      input.click();
    },
    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
  });
</script>

<script>
    // Initialize Toastr
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "timeOut": "5000",
        "positionClass": "toast-top-right"
    };

    // Display error message if any
    @if ($errors->any())
    toastr.error("{{ $errors->first() }}", "Terjadi Kesalahan");
    @endif

    // Display success message if any
    @if (session('success'))
        toastr.success("{{ session('success') }}", "Berhasil");
    @endif
</script>