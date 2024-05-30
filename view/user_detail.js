function showRejectForm(transactionId) {
    var rejectForm = document.getElementById('reject-form');
    document.getElementById('rejectTransactionId').value = transactionId;
    rejectForm.style.display = "flex";
    setTimeout(function() {
        rejectForm.classList.add('show');
    }, 5); // Delay to ensure display:flex is set before adding the show class
}

function approveLoan(transactionId) {
    document.getElementById('approveTransactionId').value = transactionId;
    document.getElementById('approveForm').submit();
}

function closeNoteForm() {
    var rejectForm = document.getElementById('reject-form');
    rejectForm.classList.remove('show');
    setTimeout(function() {
        rejectForm.style.display = "none";
    }, 50); // Delay to allow transition to complete before hiding the form
}

function showImageModal(imageSrc, imageAlt) {
    var modal = document.getElementById("imageModal");
    var modalImg = document.getElementById("modalImage");
    
    modal.style.display = "flex";
    modalImg.src = imageSrc;

}

function closeModal() {
    var modal = document.getElementById("imageModal");
    modal.style.display = "none";
}

document.querySelectorAll('.uploads img').forEach(img => {
    img.onclick = function() {
        showImageModal(this.src, this.alt);
    }
});