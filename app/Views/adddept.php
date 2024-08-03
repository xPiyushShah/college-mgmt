<form id="addform">
    <div class="row">
        <div class="col-md-12">
            <div class="purchasegrp">
                <label class="purchaseinfo"><span class="aster">* </span>Degree and Department</label>
                <input type="text" class="form-control purchaseselects" name="department" placeholder="Sample: B.Tech. - ECE">
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
                url: '<?= base_url() ?>admiSave',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function (response) {
                    // console.log(response);
                    $('#modal_md').modal('hide');
                    alert('Department Added!');
                },
                error: function (xhr, status, error) {
                    console.error('Error details:', status, error, xhr.responseText);
                    alert('An error occurred: ' + error);
                }
            });
        });
    });
</script>
