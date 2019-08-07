
<?php // var_dump($data['heroes']['data']['heroes']); ?>
<?php // var_dump($data['data']['heroe']['strengths']); ?>
<?php //var_dump($data['data']['heroe']['weaknesses']); ?>

<?php $strengths = $data['data']['heroe']['strengths']; ?>
<?php $weaknesses = $data['data']['heroe']['weaknesses']; ?>

<div class="row">


<?php // if ?>

<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
<span class="streweakness_1">Strengths</span>
<button type="button" onclick="createStrengthWeakness(1)" class="btn btn-xs btn-primary pull-right">Add</button>
<table class="table" id="tablaStrengths">
    <?php foreach ($strengths as $strength) { $strength = (array) $strength; ?>
        <tr id="streweakness{{id}}">
            <td><?php echo $strength['desc']; ?> 
            <a href="<?php echo base_url("hero/strengthweakenes_delete/").$strength['id']."/hero/".$strength['hero_id']; ?>" class="btn btn-xs btn-danger">x</a>
            </td>
        </tr>
    <?php } ?>
</table>
</div>

<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
<span class="streweakness_2">Weakness</span>
<button type="button" onclick="createStrengthWeakness(2)" class="btn btn-xs btn-primary">Add</button>
<table class="table" id="tablaStrengths">
    <?php foreach ($weaknesses as $weakness) { $weakness = (array) $weakness; ?>
        <tr id="streweakness{{id}}">
            <td><?php echo $weakness['desc']; ?> 
            <a href="<?php echo base_url("hero/strengthweakenes_delete/").$weakness['id']."/hero/".$weakness['hero_id']; ?>" class="btn btn-xs btn-danger">x</a>
            </td>
        </tr>
    <?php } ?>
</table>
</div>



</div>




