            </div>
        </div>
    </div>
</section>
<footer>
    <div class="d-flex justify-content-between align-items-center w-100 p-3 main-footer" style="background-color: #262b3c">
        <div>Copyright© 2021 All rights reserved</div>
        <div>Developed by <b>AUNG MIN OO</b></div>
    </div>
</footer>

<script src="../vendor/jquery.min.js"></script>
<script src="../vendor/way_point/jquery.waypoints.min.js"></script>
<script src="../vendor/counter_up/counter_up.js"></script>
<script src="../vendor/chart_js/chart.min.js"></script>
<script src="../vendor/"></script>
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="../vendor/summer_note/summernote.min.js"></script>
<script src="assets/js/main.js"></script>

<script>
    let option = {
        animation:true,
        delay:10000
    }
    let toastElList = [].slice.call(document.querySelectorAll('.toast'))
    let toastList = toastElList.map(function (toastEl) {
        return new bootstrap.Toast(toastEl, option).show();
    })
</script>
</body>
</html>