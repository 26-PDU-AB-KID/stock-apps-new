<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bolder" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <i>Choose "Log Out" below when you are ready to end your current session.</i>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-secondary" type="button" data-dismiss="modal"><span data-feather="x"></span> Cancel</button>
                <a class="btn btn-sm btn-danger" href="<?= base_url('auth/logout') ?>"><span data-feather="log-out"></span> Sign Out</a>
            </div>
        </div>
    </div>
</div>


<script src="<?= base_url('assets/jquery.js') ?>"></script>
<script src="<?= base_url('assets/bootstrap-4.6.0/js/bootstrap.bundle.js') ?>"></script>

</body>
</html>