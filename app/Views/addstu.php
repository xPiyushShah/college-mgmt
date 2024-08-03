<form id="addform">
    <div class="row">
        <div class="col-md-6">
            <div class="purchasegrp">
                <label class="purchaseinfo"><span class="aster">* </span>Name</label>
                <input type="text" class="form-control purchaseselects" name="name" placeholder="Enter Name" required>
            </div>
        </div>

        <div class="col-md-6">
            <div class="purchasegrp">
                <label class="purchaseinfo"><span class="aster">* </span>Mobile Number</label>
                <input type="text" class="form-control purchaseselects" name="number" placeholder="Enter Mob.Num." required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="purchasegrp">
                <label class="purchaseinfo"><span class="aster">* </span>Email</label>
                <input type="text" class="form-control purchaseselects" name="email" placeholder="Enter Email" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="purchasegrp">
                <label class="d-block">Gender</label>
                <input type="radio" id="male" name="gender" value="Male">
                <label class="purchaseinfo" for="male">Male</label>
                <input type="radio" id="female" name="gender" value="Female">
                <label class="purchaseinfo" for="female">Female</label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label class="purchaseinfo mt-2">Degree and Department</label>
                <div class="purchasegrps">
                    <div class=" dropdown-with-icon dropdownalignment">
                        <select class="selectpicker form-control " id="depOp" title="Select Degree & Dept"
                            name="department">
                            <option disabled>Degree & Department</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 blkftr">
                <div class="modal-footer taskfooter">
                    <button type="submit" class="tasksave1">
                        SAVE
                    </button>
                </div>
            </div>
        </div>
</form>
<script>
    $(document).ready(function () {
        $('#addform').on('submit', function (event) {
            event.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: '<?= base_url() ?>stuSave',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function (response) {
                    // console.log(response);
                    $('#modal_md').modal('hide');
                    alert('Student Registerd!');
                    stuData();
                },
                error: function (xhr, status, error) {
                    console.error('Error details:', status, error, xhr.responseText);
                    alert('An error occurred: ' + error);
                }
            });
        });
    });
    $(document).ready(function () {
        $.ajax({
            url: '<?= base_url() ?>fetch', 
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                var dropdown = $('#depOp');
                // dropdown.empty(); 
                // dropdown.append('<option value="">Degree & Department</option>');
                $.each(data, function (index, item) {
                    dropdown.append('<option value="' + item.department + '">' + item.department + '</option>'); 
                });
                $('.selectpicker').selectpicker('refresh');
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error: ' + status + error);
            }
        });
    });
</script>