<div class="modal fade" id="deletepopup" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post" id="deletedata">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-white" id="staticBackdropLabel">Are you Sure ?</h5>
                    <button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span class="fas fa-times fs--1 text-white"></span></button>
                </div>
                <div class="modal-body">
                    @csrf()
                    <input type="hidden" name="id" id="delete_id">
                    <input type="hidden" name="table" id="delete_table">
                    <input type="hidden" name="type" id="delete_type">

                    <div class="mt-2 text-center">
                        <span class="delete_icon"></span>
                        <div class="mt-4 pt-2 fs-15 mx-4">
                            <p class="text-muted mx-4 mb-0">Are you Sure You want to <span class="delete_text">Remove</span> this Record ?</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="justify-content-center mt-2 mb-2 submitbtn" style="display: grid;">
                        <button type="submit" class="btn w-sm" style="color: white;" id="delete-record">Yes, <span class="delete_text">Remove</span> It!</button>
                        <span id="delsucc_resp" class="text-success"></span>
                        <span id="delerr_resp" class="text-danger"></span>
                    </div>
                    <div class="spinner-border text-primary" role="status" style="display: none;">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<script src="https://cdn.lordicon.com/fudrjiwc.js"></script>
<script>
    function deletepopup(id, table, type) {
        $("#delete_id").val(id);
        $("#delete_table").val(table);
        $("#delete_type").val(type);
        $(".delete_text").html(type);

        $(".modal-header").removeClass('bg-danger');
        $(".modal-header").removeClass('bg-success');
        $(".modal-header").removeClass('bg-warning');
        $("#delete-record").removeClass('bg-danger');
        $("#delete-record").removeClass('bg-success');
        $("#delete-record").removeClass('bg-warning');

        if (type == 'delete') {
            $(".delete_icon").html('<lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>');
            $(".modal-header").addClass('bg-danger');
            $("#delete-record").addClass('bg-danger');
        } else if (type == 'activate') {
            $(".delete_icon").html('<lord-icon src = "https://cdn.lordicon.com/hjeefwhm.json" trigger = "loop" colors = "primary:#109121" style = "width:100px;height:100px"></lord-icon>');
            $(".modal-header").addClass('bg-success');
            $("#delete-record").addClass('bg-success');
        } else if (type == 'deactivate') {
            $(".delete_icon").html('<lord-icon src = "https://cdn.lordicon.com/rslnizbt.json" trigger = "loop" colors = "primary:#e5780b" style = "width:100px;height:100px"></lord-icon>');
            $(".modal-header").addClass('bg-warning');
            $("#delete-record").addClass('bg-warning');
        }
    }



    $(document).on('submit', '#deletedata', function(ev) {
        ev.preventDefault(); // Prevent browers default submit.
        var formData = new FormData(this);
        $.ajax({
            url: "{{ url('admin/delete')}}",
            type: 'post',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $(".submitbtn").css('display', 'none');
                $(".spinner-border").css('display', 'block');
            },
            success: function(result) {
                if (result.code == 200) {
                    $("#delsucc_resp").text(result.message)
                    reloadpage();
                } else {
                    $("#delerr_resp").text(result.message)
                }
            },
            error: function(xhr) {
                $(".submitbtn").css('display', 'grid');
                $(".spinner-border").css('display', 'none');
            },
            complete: function() {
                $(".submitbtn").css('display', 'grid');
                $(".spinner-border").css('display', 'none');
            },
        })
    })
</script>