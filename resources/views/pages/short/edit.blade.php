<div id="edit-modal" class="hidden bg-white border rounded z-10 p-3 fixed top-[50%] w-5/5">
    <div class="text-center mb-3 pb-3 border-b">
        <h3>Edit link here</h3>
    </div>
    <form id="editForm">
        @csrf
        <div>
            <div class="mb-5 ">
                <input type="text" id="short-url" class="rounded-md border-2 border-slate-700  " placeholder="makan-soto-sapi">
                <br/>
                <span class="text-red-500 text-[12px] ml-1" id="error-edit"></span>
            </div>
            <div class="text-right">
                <button type="submit" id="submit-btn" class="bg-primary-orange py-2 px-4  text-white">submit</button>
                {{-- <button id="close-edit-modal" class="bg-red-500 py-2 px-4 text-white">cancel</button> --}}
            </div> 
        </div>
        
    </form>
</div>
<div id="edit-overlay" class="hidden fixed inset-0 bg-black z-5 opacity-40"></div>

<script>
    $(document).ready(function(){
        $('#open-edit-modal').click(function(e){
            // close modal view
            var modal = $('#modalOverlay').removeClass('modal-open');
            setTimeout(function() {
                modal.hide();
            },200);

            var dataShort = $('#open-edit-modal').data('short');
            // var short_id = $('#open-edit-modal').data('id')
            // console.log(short_id);

            // open modal edit

            $('#edit-modal').removeClass('hidden');
            $('#edit-overlay').removeClass('hidden');
            $('#short-url').val(dataShort);

        });

        $('#edit-overlay').click(function(){
            $('#edit-modal').addClass('hidden');
            $('#edit-overlay').addClass('hidden');
        });

        $('#close-edit-modal').click(function(e){
            e.preventDefault();
            $('#edit-modal').addClass('hidden');
            $('#edit-overlay').addClass('hidden');
        })

        // form validation
        $('#short-url').on('keyup', function() {
            var val = $(this).val();
            val = val.replace(/\s+/g, '-').replace(/[^a-zA-Z0-9-]/g, '');
            $(this).val(val);
        });

        // edit form
        $('#editForm').on('submit', function(e) {
            e.preventDefault();
            var id = $('#open-edit-modal').data('id');
            var input_short = $('#short-url').val();
            var token = $('input[name="_token"]').val()

            // console.log(token);
            $.ajax({
                url: `/submit-edit/${id}`,
                type: 'PUT',
                dataType: 'json',
                data : {
                    _token: token,
                    newShort : input_short,
                },
                success: function (response) {
                    if(response.success) {
                        $('#edit-modal').addClass('hidden');
                        $('#edit-overlay').addClass('hidden');
                        
                        // 
                        $('#alert-success').show();
                        $('#alert-success').html(response.message);
                        setTimeout(function () {
                            $('#alert-success').hide();
                            location.reload();
                        }, 2000)
                    }
                },
                error : function (xhr) {
                    // console.log(xhr.responseJSON.message)
                    var errMsg = xhr.responseJSON.message;
                    $('#error-edit').html(errMsg);
                    

                },
            });
        });

    });


</script>