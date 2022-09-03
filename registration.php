<?php 
require_once('config.php');
$page = isset($_GET['page']) ? $_GET['page'] : 'registration';
$page_name = explode("/",$page)[count(explode("/",$page)) -1];
?>
<!DOCTYPE html>
<html lang="en" itemscope itemtype="http://schema.org/WebPage">

<?php include_once('includes/header.php') ?>
<style>
    html, body{
        height:100%;
        width:100%;
    }
    body{
        background-image:url('<?= validate_image($_settings->info('cover')) ?>');
        background-size:cover;
        background-position:center center;
        background-repeat:no-repeat;
        overflow:auto;
        display:flex;
        flex-direction:column;
        align-items:center;
        justify-content:center;
        backdrop-filter:brightness(.8)
    }
    footer *{
        color: var(--bs-primary) !important;
    }
</style>
<body class="index-page bg-gray-200">
    <script>start_loader()</script>
    <div class="content w-100">
    <div class="row justify-content-center mx-0">
        <div class="col-lg-8 col-md-10 col-sm-12 col-xs-12">
            <div class="card card-body shadow-blur mx-3 mx-md-4 rounded-0">
                <?php 
                if(isset($_SESSION['msg'])):
                ?>
                <div class="alert alert-<?= $_SESSION['msg']['type'] ?> rounded-0 text-light py-1 px-4 mx-3">
                    <div class="d-flex w-100 align-items-center">
                        <div class="col-10">
                            <?= $_SESSION['msg']['text'] ?>
                        </div>
                        <div class="col-2 text-end">
                            <button class="btn m-0 text-sm" type="button" onclick="$(this).closest('.alert').remove()"><i class="material-icons mb-0">close</i></button>
                        </div>
                    </div> 
                </div>
                <?php unset($_SESSION['msg']); ?>
                <?php endif; ?>
                <div class="container">
                    <h4 class="fw-bolder text-center">Create New Account</h4>
                    <hr class="bg-primary">
                    <br>
                    <form action="" id="registration-form">
                        <input type="hidden" name="id">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3 input-group input-group-dynamic">
                                    <label for="firstname" class="form-label">First Name <span class="text-primary">*</span></label>
                                    <input type="text" name="firstname" id="firstname" autofocus class="form-control form-control-lg" required="required">
                                </div>
                                <div class="form-group mb-3 input-group input-group-dynamic">
                                    <label for="middlename" class="form-label">Middle Name</label>
                                    <input type="text" name="middlename" id="middlename" class="form-control form-control-lg">
                                </div>
                                <div class="form-group mb-3 input-group input-group-dynamic">
                                    <label for="lastname" class="form-label">Last Name <span class="text-primary">*</span></label>
                                    <input type="text" name="lastname" id="lastname" class="form-control form-control-lg" required="required">
                                </div>
                                <div class="form-group mb-3">
                                    <div class="d-flex">
                                        <div class="col-auto">
                                            <label for="gender" class="form-label">Gender <span class="text-primary">*</span></label>
                                        </div>
                                        <div class="col-auto">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender" id="male" value="Male" checked>
                                                <label class="form-check-label" for="male">
                                                    Male
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender" id="female" value="Female" >
                                                <label class="form-check-label" for="female">
                                                    Female
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-3 input-group input-group-dynamic is-filled">
                                    <label for="dob" class="form-label">Birthday <span class="text-primary">*</span></label>
                                    <input type="date" name="dob" id="dob" class="form-control form-control-lg" required="required">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3 input-group input-group-dynamic">
                                    <label for="username" class="form-label">Username</label>
                                    <span class="input-group-text"><i class="material-icons" aria-hidden="true">person_outline</i></span>
                                    <input type="text" name="username" id="username" class="form-control form-control-lg" required="required">
                                </div>
                                <div class="form-group mb-3 input-group input-group-dynamic">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" id="password" class="form-control form-control-lg" required="required">
                                    <button type="button" tabindex="-1" class="btn btn-outline-primary btn-lg mb-0 rounded-0 border-0 px-1 pass_view"><i class="material-icons">visibility_off</i></button>
                                </div>
                                <div class="form-group mb-3 input-group input-group-dynamic">
                                    <label for="cpassword" class="form-label">Confirm Password</label>
                                    <input type="password" id="cpassword" class="form-control form-control-lg" required="required">
                                    <button type="button" tabindex="-1" class="btn btn-outline-primary btn-lg mb-0 rounded-0 border-0 px-1 pass_view"><i class="material-icons">visibility_off</i></button>
                                </div>
                                <div class="form-group mb-3 input-group input-group-dynamic is-filled">
                                    <label for="image" class="form-label">Avatar <span class="text-primary">*</span></label>
                                    <input type="file" name="image" id="image" class="form-control form-control-lg" accept="image/jpeg, image/png" required="required">
                                </div>
                            </div>
                        </div>
                        
                    <br>
                    <div class="row justify-content-between align-items-center">
                        <div class="col-sm-6">
                            <a href="./login.php" class="text-primary">Already have an Account</a>
                        </div>
                        <div class="col-sm-6 text-end">
                            <button class="btn btn-primary bg-gradient rounded-0 mb-0">Login</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>


    <?php include_once('includes/footer.php') ?>
    <script>
        $(function(){
            $('.pass_view').click(function(){
                var type = $(this).siblings('input').attr('type')
                if(type == 'password'){
                    $(this).siblings('input').attr('type','text').focus()
                    $(this).html('<i class="material-icons">visibility</i>')
                }else{
                    $(this).siblings('input').attr('type','password').focus()
                    $(this).html('<i class="material-icons">visibility_off</i>')
                }
            })
            $('#registration-form').submit(function(e){
                e.preventDefault()
                $('.pop-alert').remove()
                var _this = $(this)
                var el = $('<div>')
                el.addClass("pop-alert alert alert-danger text-light mb-3 rounded-0 px-1 py-2")
                el.hide()
                if($('#password').val() != $('#cpassword').val()){
                    el.text('Passwords do not match.')
                    _this.prepend(el)
                    el.show('slow')
                    $('html, body').scrollTop(_this.offset().top - '150')
                    return false;
                }
                start_loader()
                $.ajax({
                    url:'./classes/Users.php?f=save_user',
                    data: new FormData($(this)[0]),
                    cache: false,
                    contentType: false,
                    processData: false,
                    method: 'POST',
                    type: 'POST',
                    dataType: 'json',
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
                            location.href= './login.php';
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
                    }
                })
            })
        })
    </script>

</body>

</html>