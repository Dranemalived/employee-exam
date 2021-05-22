<?php if ($this->session->flashdata('alertSuccess')) : ?>
    <div class="alert alert-success" role="alert">
        <?= $this->session->flashdata('alertSuccess') ?>
    </div>
<?php endif; ?>

<div class="container-fluid">
    <div class="m-5 card">
        <div class="card-header">
            <h4 class="card-title text-left">Employee List</h4>
        </div>
        <div class="card-body">
            <a class="btn btn-primary mb-5" href="<?= site_url('Employee/new') ?>">Create</a>
            <table id="employeeTable" class="table table-striped table-hover">
                <thead>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Date of Birth</th>
                    <th>Edit</th>
                </thead>
                <tbody>
                </tbody>
            </table>
            <button id="refreshBtn" class="btn btn-secondary">Refresh</button>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <input type="hidden" id="eId" name="">
            <div class="modal-body">
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
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="saveBtn" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        load_employees();

        $('#refreshBtn').click(function() {
            load_employees();
        });

        $(document).on('click', '.selectToUpdate', function() {
            var id = $(this).attr('data-eId');

            $.ajax({
                'url': '<?= site_url("Employee/getEmployeeById") ?>',
                "type": "POST",
                "dataType": "json",
                "data": {
                    eId: id
                },
                "success": function(data) {
                    $('#eId').val(data.id);
                    $('#firstName').val(data.firstName);
                    $('#lastName').val(data.lastName);
                    $('#dateOfBirth').val(data.dateOfBirth);
                }
            })
        })

        $('#saveBtn').click(function() {
            $.ajax({
                'url': '<?= site_url("Employee/update") ?>',
                "type": "POST",
                "dataType": "json",
                "data": {
                    eId: $('#eId').val(),
                    firstName: $('#firstName').val(),
                    lastName: $('#lastName').val(),
                    dateOfBirth: $('#dateOfBirth').val()
                },
                "success": function(data) {
                    if (data.error != true) {
                        load_employees();
                        $('#updateModal').modal('hide');
                    }
                }
            })
        })
    })

    function load_employees() {
        var table = $('#employeeTable tbody');
        table.empty();

        $.ajax({
            "url": '<?= site_url("Employee/getEmployees") ?>',
            "type": "POST",
            "dataType": "json",
            "success": function(data) {

                for (i = 0; i < data.length; i++) {
                    var tr = $('<tr/>');

                    tr.append(`<td>${data[i].firstName}</td>`);
                    tr.append(`<td>${data[i].lastName}</td>`);
                    tr.append(`<td>${data[i].dateOfBirth}</td>`);
                    tr.append(`<td><button class="btn btn-info selectToUpdate" data-bs-toggle="modal" data-bs-target="#updateModal" data-eId="${data[i].id}"><i data-feather="edit-3"></i></button></td>`);

                    table.append(tr);
                    feather.replace()
                }

            }
        })
    }
</script>