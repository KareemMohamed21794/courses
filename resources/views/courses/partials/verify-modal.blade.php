<div class="modal fade" id="downloadModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold" id="modalCourseTitle">تحميل الكورس</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs mb-3" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#verifyTab" type="button">التحقق من الهاتف</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#purchaseTab" type="button">اشتراك / شراء</button>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="verifyTab">
                        <p class="text-muted small">أدخل رقم الهاتف المسجل لدينا للتحقق والتحميل.</p>
                        <div id="verifyAlert" class="alert d-none"></div>
                        <form id="verifyForm">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">رقم الهاتف</label>
                                <input type="tel" name="phone_number" class="form-control" placeholder="مثال: 9627xxxxxxxx" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100" id="verifyBtn">تحقق وحمّل</button>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="purchaseTab">
                        <p class="text-muted">لم تشترك بعد؟ انتقل إلى صفحة الاشتراك أو الشراء.</p>
                        <a href="#" id="purchaseLink" class="btn btn-outline-primary w-100">الذهاب إلى صفحة الاشتراك</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
