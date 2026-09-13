 <!-- Footer -->
<footer class="sticky-footer bg-white mt-auto">
                        <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Clinique 2026</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <!-- <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span> 
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div> -->

    <!-- Bootstrap core JavaScript-->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/js/sb-admin-2.min.js"></script>

    <!-- select2 -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- //creet reception -->
    <!-- <script>
document.addEventListener('DOMContentLoaded', function () {

    const amoSelect = document.getElementById('amo');
    const tarifInput = document.getElementById('tarif');

    if (!amoSelect || !tarifInput) return;

    function recalculer() {

        let prix = parseFloat(tarifInput.value) || 0;

        // 🔥 sécurité totale dataset
        let tauxAmo = parseFloat(amoSelect.getAttribute('data-taux-amo') || 0);

        let reduction = 0;
        let final = prix;

        if (amoSelect.value === "1") {
            reduction = (prix * tauxAmo) / 100;
            final = prix - reduction;
        }

        console.log("AMO:", reduction, "Final:", final);

        let amoOut = document.getElementById('montantAmo');
        let payeOut = document.getElementById('montantPayer');

        if (amoOut) amoOut.textContent = reduction.toFixed(0);
        if (payeOut) payeOut.textContent = final.toFixed(0);
    }

    amoSelect.addEventListener('change', recalculer);
    tarifInput.addEventListener('input', recalculer);

    recalculer();
});
</script> -->
<!-- edit reception -->
<!-- <script>
document.addEventListener('DOMContentLoaded', function () {

    const amo = document.getElementById('amo');
    const tarif = document.getElementById('tarif');

    if (!amo || !tarif) return;

    function recalculer() {

        let prix = parseFloat(tarif.value) || 0;
        let taux = parseFloat(amo?.dataset?.tauxAmo || 0);

        let reduction = 0;
        let final = prix;

        if (amo.value == "1") {
            reduction = (prix * taux) / 100;
            final = prix - reduction;
        }

        console.log("AMO:", reduction, "Final:", final);
    }

    amo.addEventListener('change', recalculer);
    tarif.addEventListener('input', recalculer);

    recalculer();
});
</script> -->


</body>

</html>