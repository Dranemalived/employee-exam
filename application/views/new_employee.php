<div class="container-fluid">
    <div class="m-5 card">
        <div class="card-header">
            <h4 class="card-title text-left">Create Employee</h4>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="">First Name</label>
                <input type="text" id="firstName" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Last Name</label>
                <input type="text" id="lastName" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Date of birth</label>
                <input type="date" id="dateOfBirth" class="form-control">
            </div>
        </div>
        <div class="card-footer">
            <a type="button" class="btn btn-secondary" href="<?= site_url('Employee') ?>">Close</a>
            <button type="button" id="saveBtn" class="btn btn-primary">Save</button>
        </div>
    </div>
</div>



<script>
    $(document).ready(function() {
        $('#saveBtn').click(function() {
            $.ajax({
                'url': '<?= site_url("Employee/create") ?>',
                "type": "POST",
                "dataType": "json",
                "data": {
                    firstName: $('#firstName').val(),
                    lastName: $('#lastName').val(),
                    dateOfBirth: $('#dateOfBirth').val()
                },
                "success": function(data) {
                    if (data.error != true) {
                        window.location.href = "<?= site_url('Employee') ?>"
                    }
                }
            })
        })
    })
</script>