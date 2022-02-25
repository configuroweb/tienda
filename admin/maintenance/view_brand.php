<?php

require_once('../../config.php');
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `brands` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
}
?>
<style>
	#uni_modal #brand-logo{
		width:100%;
		max-height:20vh;
		object-fit:scale-down;
		object-position:center center;
	}
    #uni_modal .modal-footer{
        display:none !important;
    }
</style>
<div class="container-fluid">
    <div class="text-center">
        <img src="<?= validate_image(isset($image_path)? $image_path : "") ?>" alt="Brand Logo" class="img-fluid rounded-0" id="brand-log">
    </div>
    <div class="clear-fix mb-3"></div>
    <dl>
        <dt class="muted">Marca</dt>
        <dd class="pl-4"><?= isset($name) ? $name : "" ?></dd>
        <dt class="muted">Descripción</dt>
        <dd class="pl-4"><?= isset($description) ? $description : "" ?></dd>
        <dt class="muted">Estado</dt>
        <dd class="pl-4">
            <?php if($status == 1): ?>
                <span class="badge badge-success px-3 rounded-pill">Activo</span>
            <?php else: ?>
                <span class="badge badge-danger px-3 rounded-pill">Inactivo</span>
            <?php endif; ?>
        </dd>
    </dl>
    <div class="clear-fix mb-3"></div>
    <div class="text-right">
        <button class="btn btn-dark btn-flat btn-sm" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
    </div>
</div>