<?php  
echo($this->extend('Layout/template'));
echo($this->section('content'));
?>

<div class="row">
    <div class="col">
        <h1 class="text-center my-3">Zlínský kraj</h1>
    </div>
</div>


<?= $this->endSection(); ?>