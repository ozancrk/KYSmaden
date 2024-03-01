<script src="view/panel/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="view/panel/assets/libs/simplebar/simplebar.min.js"></script>
<script src="view/panel/assets/libs/node-waves/waves.min.js"></script>
<script src="view/panel/assets/libs/feather-icons/feather.min.js"></script>
<script src="view/panel/assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
<script src="view/panel/assets/js/plugins.js"></script>


<!--datatable js-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script src="view/panel/assets/js/pages/datatables.init.js"></script>
<!-- Sweet Alerts js -->
<script src="view/panel/assets/libs/sweetalert2/sweetalert2.min.js"></script>

<!-- Sweet alert init js-->
<script src="view/panel/assets/js/pages/sweetalerts.init.js"></script>
<!-- dropzone min -->
<script src="view/panel/assets/libs/dropzone/dropzone-min.js"></script>

<!-- filepond js -->
<script src="view/panel/assets/libs/filepond/filepond.min.js"></script>
<script src="view/panel/assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js"></script>
<script src="view/panel/assets/libs/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js"></script>
<script src="view/panel/assets/libs/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js"></script>
<script src="view/panel/assets/libs/filepond-plugin-file-encode/filepond-plugin-file-encode.min.js"></script>

<script src="view/panel/assets/js/pages/form-file-upload.init.js"></script>
<!-- App js -->
<script src="view/panel/assets/libs/quill/quill.min.js"></script>
<script src="view/panel/assets/js/app.js"></script>
<script src="view/panel/assets/js/formAction.js"></script>
<script src="view/panel/assets/js/login.js"></script>,
<script src="view/panel/assets/js/pages/form-editor.init.js"></script>
<script>

    $(".mesaj").change(function () {

        var select = this;


        $.get("api/bildiri/APImesaj.php?id=" + this.value, function (data) {
            var lang = $("#lang").val();
            obj = JSON.parse(data);
            if (lang === 'tr') {
                $("#" + select.id + "mesaj > .ql-editor").html(obj.tr)
            } else {
                $("#" + select.id + "mesaj > .ql-editor").html(obj.tr)
            }

        });


    });
    $(document).ready(function () {
        $('table#example1').DataTable();
    });

</script>


</form>
</body>
</html>
