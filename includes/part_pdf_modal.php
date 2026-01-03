<!-- PDF Viewer Popup -->
<!-- Clean & Modern Modal without Footer/Download Buttons -->
<div class="popup" id="pdfPopup">
    <div class="popup-content">
        <!-- Header -->
        <div class="popup-header">
            <div>
                <h3 id="popupTitle">Dokumen</h3>
                <p>Preview Dokumen</p>
            </div>
            <button onclick="closePopup()" class="popup-close-btn" aria-label="Close">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <!-- Body -->
        <div class="popup-body">
            <iframe id="pdfFrame" src=""></iframe>
        </div>
    </div>
</div>
