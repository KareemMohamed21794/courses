<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('downloadModal');
    if (!modal) return;

    const verifyForm = document.getElementById('verifyForm');
    const verifyAlert = document.getElementById('verifyAlert');
    const verifyBtn = document.getElementById('verifyBtn');
    const purchaseLink = document.getElementById('purchaseLink');
    const modalTitle = document.getElementById('modalCourseTitle');
    let verifyUrl = '';

    modal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        if (!button) return;
        verifyUrl = button.getAttribute('data-verify-url');
        purchaseLink.href = button.getAttribute('data-purchase-url');
        modalTitle.textContent = 'تحميل: ' + button.getAttribute('data-course-title');
        verifyAlert.classList.add('d-none');
        verifyForm.reset();
    });

    verifyForm.addEventListener('submit', function (e) {
        e.preventDefault();
        verifyBtn.disabled = true;
        verifyBtn.textContent = 'جاري التحقق...';
        verifyAlert.classList.add('d-none');

        fetch(verifyUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
            },
            body: JSON.stringify({
                phone_number: verifyForm.phone_number.value
            })
        })
        .then(res => res.json().then(data => ({ ok: res.ok, data })))
        .then(({ ok, data }) => {
            verifyAlert.classList.remove('d-none');
            if (ok && data.success) {
                verifyAlert.className = 'alert alert-success';
                verifyAlert.textContent = data.message;
                window.location.href = data.download_url;
            } else {
                verifyAlert.className = 'alert alert-danger';
                verifyAlert.textContent = data.message || 'حدث خطأ، يرجى المحاولة مرة أخرى.';
            }
        })
        .catch(() => {
            verifyAlert.classList.remove('d-none');
            verifyAlert.className = 'alert alert-danger';
            verifyAlert.textContent = 'حدث خطأ في الاتصال.';
        })
        .finally(() => {
            verifyBtn.disabled = false;
            verifyBtn.textContent = 'تحقق وحمّل';
        });
    });
});
</script>
