<?php  
echo($this->extend('Layout/template'));
echo($this->section('content'));
?>

<div class="row">
    <div class="col">
        <h1 class="text-center my-3">Zlínský kraj</h1>
    </div>
</div>

<?php $parametr = service('uri')->getSegment(1); ?>
<h4>Počet stránek na řádek</h4>
<ul class="nav">
  <li class="nav-item">
    <?= anchor('kraj/' . '/10', "10", ['class' => 'nav-link']) ?>
  </li>
  <li class="nav-item">
    <?= anchor('kraj/' . '/20', "20", ['class' => 'nav-link']) ?>
  </li>
  <li class="nav-item">
    <?= anchor('kraj/' . '/50', "50", ['class' => 'nav-link']) ?>
  </li>
  <li class="nav-item">
    <?= anchor('kraj/' . '/100', "100", ['class' => 'nav-link']) ?>
  </li>
</ul>

<?php
$table = new \CodeIgniter\View\Table();
$template = array(
    'table_open'=> '<table class="table table-border table-hover text-center">',
    'thead_open'=> '<thead>',
    'thead_close'=> '</thead>',
    'heading_row_start'=> '<tr>',
    'heading_row_end'=>' </tr>',
    'heading_cell_start'=> '<th class="h6">',
    'heading_cell_end' => '</th>',
    'tbody_open' => '<tbody>',
    'tbody_close' => '</tbody>',
    'row_start' => '<tr>',
    'row_end'  => '</tr>',
    'cell_start' => '<td>',
    'cell_end' => '</td>',
    'row_alt_start' => '<tr>',
    'row_alt_end' => '</tr>',
    'cell_alt_start' => '<td>',
    'cell_alt_end' => '</td>',
    'table_close' => '</table>'
    );
    $table->setTemplate($template);
$table->setHeading('Pořadí', 'Název obce', 'Počet adresních míst');

$poradi = 1;
foreach($krajData as $row) {
    $table->addRow(($page - 1) * $page + $poradi, $row->nazev, $row->pocet_adresnich_mist);
    $poradi++;
}?>
<div class="row my-3">
    <div class="col-sm-8 mx-auto">
        <div class="row"><?php echo $table->generate();?></div>
        <div class="row mt-5 "><?php echo $pager->links();?></div>
    </div>
</div>

<?= $this->endSection(); ?>