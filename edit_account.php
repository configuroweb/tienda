<section class="py-5">
    <div class="container">
        <div class="card rounded-0">
            <div class="card-body">
                <div class="w-100 justify-content-between d-flex">
                    <h4><b>Actualizar Información de Cuenta</b></h4>
                    <a href="./?p=my_account" class="btn btn btn-default btn-flat bg-maroon"><div class="fa fa-angle-left"></div> Volver</a>
                </div>
                    <hr class="border-warning">
                    <div class="col-md-6">
                        <form action="" id="update_account">
                        <input type="hidden" name="id" value="<?php echo $_settings->userdata('id') ?>">
                            <div class="form-group">
                                <label for="firstname" class="control-label">Nombre</label>
                                <input type="text" name="firstname" class="form-control form" value="<?php echo $_settings->userdata('firstname') ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="lastname" class="control-label">Apellido</label>
                                <input type="text" name="lastname" class="form-control form" value="<?php echo $_settings->userdata('lastname') ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="" class="control-label">Contacto</label>
                                <input type="text" class="form-control form-control-sm form" name="contact" value="<?php echo $_settings->userdata('contact') ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="" class="control-label">Género</label>
                                <select name="gender" id="" class="custom-select select" required>
                                    <option <?php echo $_settings->userdata('gender') == "Masculino" ? "selected" : '' ?>>Masculino</option>
                                    <option <?php echo $_settings->userdata('gender') == "Femenino" ? "selected" : '' ?>>Femenino</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="" class="control-label">Dirección de entrega predeterminada</label>
                                <textarea class="form-control form" rows='3' name="default_delivery_address"><?php echo $_settings->userdata('default_delivery_address') ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="email" class="control-label">Correo</label>
                                <input type="text" name="email" class="form-control form" value="<?php echo $_settings->userdata('email') ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="password" class="control-label">Nueva Contraseña</label>
                                <input type="password" name="password" class="form-control form" value="" placeholder="(Ingrese el valor para cambiar la contraseña)">
                                <small class="text-muted"><i>Deje esto en blanco si no desea actualizar su contraseña.</i></small>
                            </div>
                            <div class="form-group">
                                <label for="cpassword" class="control-label">Contraseña actual</label>
                                <input type="password" name="cpassword" class="form-control form" value="" required>
                                <small class="text-muted"><i>Introduzca su contraseña actual para actualizar sus datos.</i></small>
                            </div>
                            <div class="form-group d-flex justify-content-end">
                                <button class="btn btn-dark btn-flat">Actualizar</button>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</section>
<script>
$(function(){
        $('#update_account').submit(function(e){
            e.preventDefault();
            start_loader()
            if($('.err-msg').length > 0)
                $('.err-msg').remove();
            $.ajax({
                url:_base_url_+"classes/Master.php?f=update_account",
                method:"POST",
                data:$(this).serialize(),
                dataType:"json",
                error:err=>{
                    console.log(err)
                    alert_toast("Ocurrió un error",'error')
                    end_loader()
                },
                success:function(resp){
                    if(typeof resp == 'object' && resp.status == 'success'){
                        location.reload()
                    }else if(resp.status == 'failed' && !!resp.msg){
                        var _err_el = $('<div>')
                            _err_el.addClass("alert alert-danger err-msg").text(resp.msg)
                        $('#update_account').prepend(_err_el)
                        $('body, html').animate({scrollTop:0},'fast')
                        end_loader()
                        
                    }else{
                        console.log(resp)
                        alert_toast("Ocurrió un error",'error')
                    }
                    end_loader()
                }
            })
        })
    })
</script>