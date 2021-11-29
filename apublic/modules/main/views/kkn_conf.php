
              <form class="go-right" name="konfirmasi_kkn" id="konfirmasi_kkn" action="<?php echo site_url('konfirmasi/kkn/' . (($id_peserta) ? $id_peserta : '')); ?>" method="post">
                <div class="text-center">
                   <!-- <img class="mb-4" src="<?php //echo base_url(); ?>asset/images/favicon.jpg" alt="" width="100"> -->
                   <h1 class="h3 mb-3 font-weight-normal"><?=$title;?></h1>
                   <p>Masukkan password anda untuk pengaktifan akun.</p>
                 </div>

                 <div class="form-label-gr">
                   <input type="text" id="namauser" name="username" class="form-control form-control-lg" value="<?=($mhs['email']) ? $mhs['email'] : '';?>" placeholder="Username" readonly>
                   <label for="namauser"><i class="fa fa-user-circle"></i> Username</label>
                 </div>

                 <div class="form-label-gr">
                   <input type="password" id="inputPassword" name="password" class="form-control form-control-lg" value="" placeholder="Password" required>
                   <label for="inputPassword"><i class="fa fa-lock"></i> Password</label>
                 </div>

                 <div class="form-label-gr">
                   <input type="password" id="confPassword" name="conf_password" class="form-control form-control-lg" value="" placeholder="Konfirmasi Password" required>
                   <label for="confPassword"><i class="fa fa-lock"></i> Konfirmasi Password</label>
                 </div>

                 <hr>

                <div class="row form-label-gr">
                    <div class="col-md-5">
                        <?php echo $image; ?>
                    </div>
                    <div class="col-md-7">
                        <input type="text" name="security_code" id="security_code"  value="" class="form-control form-control-lg" placeholder="Kode Captcha" required>
                        <label for="security_code">&nbsp;&nbsp;Kode Captcha</label>
                    </div>
                </div>

                <hr>

                 <button class="btn btn-lg btn-primary btn-block" type="submit">Konfirmasi</button>

                 <br>
           </form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
$(document).ready(function(){
        $("footer.sticky-footer").css("position", "fixed");
    });

 $("#konfirmasi_kkn").validate({
    errorClass: "is-invalid",
    validClass: "is-valid",
    wrapper: "span",
    rules:{
            password: { required: true },
            conf_password: { required: true },
        },
    messages:{
            password: { required: 'Password harus diisi'  },
            conf_password: { required: 'Konfirmasi password harus diisi'  },
        },

    submitHandler: function() {
        var frm=$("#konfirmasi_kkn");
        $.ajax({
            url       : frm.attr("action"),
            type      : frm.attr("method"),
            dataType  : "html",
            data      : frm.serialize(),
            beforeSend:function(data){
                $("#ajax_loader").fadeIn(100);
            },
            success:function(data){
                    obj = JSON.parse(data);
                    if(obj.status=="OK"){
                        Swal.fire({
                            icon: 'success',
                            title: obj.status,
                            text: obj.msg,
                        }).then(function(){
                            window.location.href = "<?=base_url()?>";
                        })
                    }else
                    if(obj.status=="ERROR"){
                        Swal.fire({
                            icon: 'error',
                            title: obj.status,
                            text: obj.msg,
                        })
                    }
                    $("#ajax_loader").fadeOut(100);
            }
        });
    }
});
</script>
