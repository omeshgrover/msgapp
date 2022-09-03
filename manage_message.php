<section class="py-5">
    <div class="container">
        <h2 class="fw-bolder text-center"><b><?= isset($id) ? "Edit Message" : "Create New Message" ?></b></h2>
        <hr>
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 col-sm-12 col-xs-12">
                <form action="" id="message-form">
                    <input type="hidden" name="id" value="<?= isset($id) ? $id : '' ?>">
    
                    <div class="form-group mb-3">
                        <label for="recipient_email" class="form-label">Recipient <span class="text-primary">*</span></label>
                        <input type="search" id="recipient_email" name="recipient_email" value="" autofocus class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="creation_time" class="form-label">Creation Time <span class="text-primary">*</span></label>
                        <input type="text" id="creation_time" name="creation_time" value="<?=time()?>" class="form-control" required="required">
                    </div>
                    <div class="form-group mb-3">
                        <label for="creation_time" class="form-label">Message Type <span class="text-primary">*</span></label>
                        <select name="message_type" id="message_type">
                            <option value="sys">System</option>
                            <option value="man">Manual</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="message" class="form-label">Message Text<span class="text-primary">*</span></label>
                        <textarea rows="10" id="message" name="message" class="form-control" required="required"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn bg-primary bg-gradient btn-sm text-light w-25"><span class="material-icons">send</span> Send</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    $(function() {
        $('#message-form').submit(function(e){
            e.preventDefault()
            $('.pop-alert').remove()
            var _this = $(this)
            var el = $('<div>')
            el.addClass("pop-alert alert alert-danger text-light")
            el.hide()
            if($('[name="recipient_email"]').val() == ''){
                el.text('Recepient is required.')
                _this.prepend(el)
                el.show('slow')
                $('html, body').scrollTop(_this.offset().top - '150')
                return false;
            }
            start_loader()
            $.ajax({
                url:'./classes/Master.php?f=save_message',
                method:'POST',
                data:$(this).serialize(),
                dataType:'json',
                error:err=>{
                    console.error(err)
                    el.text("An error occured while saving data")
                    _this.prepend(el)
                    el.show('slow')
                    $('html, body').scrollTop(_this.offset().top - '150')
                    end_loader()
                },
                success:function(resp){
                    if(resp.status == 'success'){
                        location.href= './?page=inbox';
                    }else if(!!resp.msg){
                        el.text(resp.msg)
                        _this.prepend(el)
                        el.show('slow')
                        $('html, body').scrollTop(_this.offset().top - '150')
                    }else{
                        el.text("An error occured while saving data")
                        _this.prepend(el)
                        el.show('slow')
                        $('html, body').scrollTop(_this.offset().top - '150')
                    }
                    end_loader()
                    console

                }
            })
        })
    })
</script>