
<?php // var_dump($data['heroes']['data']['heroes']); ?>
<?php // var_dump($data['data']['heroe']); ?>

<?php $skills = $data['data']['heroe']['skills']; ?>

<?php foreach ($skills as $skill) { ?>
    
    <?php echo form_open_multipart('hero/update_skill/'.$skill['id']);?>
    
    <input type="text" name="hero_name" value="<?php echo $data['data']['heroe']['name']; ?>" hidden>
    <input type="text" name="hero_id" value="<?php echo $data['data']['heroe']['id']; ?>" hidden>
    
    <div class="skillsDiv">
    <h3><b><?php echo $skill['skill']; ?></b></h3>

    <table class="table " id="skill<?php echo $skill['id'] ?>" style="width:100%">
        <tr>
            <th>Icon (PNG)</th>
            <td><img src="<?php echo $skill['skillIcon']?>?t=<?php echo time(); ?>"/></td>
        </tr>
        <tr>
            <td colspan="2">
            <input class="form-control" type="file" name="skillIcon" />
            </td>
        </tr>
        <tr>
            <th>
                Skill
            </th>
            <td>
                <input class="form-control" type="text" name="skill" value="<?php echo $skill['skill']; ?>" />
            </td>
        </tr>
        <tr>
            <th>
                Skill Order
            </th>
            <td>
                <input class="form-control" type="number" name="skillOrder" value="<?php echo $skill['skillOrder']; ?>"/>
            </td>
        </tr>
        <tr>
            <th>
                Desc
            </th>
            <td>
                <textarea class="form-control" name="desc"><?php echo $skill['desc']; ?></textarea>
            </td>
        </tr>
        <tr>
            <th>
                lvlUpgrades
            </th>
            <td>
                <textarea class="form-control" name="lvlUpgrades"><?php echo $skill['lvlUpgrades']; ?></textarea>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <center>
                <button class="btn btn-success btn-sm btnActualizarSkill" onclick="actualizaSkill('<?php echo $skill['id'] ?>')">Update</button>
                </center>
            </td>
        </tr>
    </table>
    </div>

</form>

<?php } ?>




