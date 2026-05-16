</main>

<!-- Footer -->
<footer class="admin-footer">
    <p>&copy; <?= date('Y') ?> <?php echo SITE_NAME ?? 'Arbain'; ?>. All Rights Reserved.</p>
</footer>
</div>
</div>

<!-- Admin Scripts -->
<script src="<?= BASE_URL ?>/assets/js/admin.js?v=<?= time() ?>"></script>
<script src="<?= BASE_URL ?>/assets/js/main.js?v=<?= time() ?>"></script>



<!-- TAMBAHKAN SCRIPT TINYMCE INI -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.10.7/tinymce.min.js"></script>
<script>
    if (typeof tinymce !== 'undefined') {
        tinymce.init({
            selector: '#kbKonten, .rich-text',
            height: 300,
            menubar: false,
            branding: false,
            plugins: [
                'advlist autolink lists link charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime table paste code help wordcount'
            ],
            toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat',
            setup: function (editor) {
                editor.on('change', function () {
                    editor.save();
                });
            }
        });
    }
</script>
<!-- BATAS PENAMBAHAN TINYMCE -->

</body>

</html>