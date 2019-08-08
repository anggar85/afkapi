<?php $hero = $data['data']['heroe']; ?>
<?php echo form_open_multipart('hero/update/'.$hero['id']);?>
    
    <table class="table" id="tableDataOfHeroe">
        <tbody>
        <tr>
            <th>Name *</th>
            <th>Image ICON (JPG)</th>
            <th>Group</th>
            <th>Type</th>
        </tr>
        <tr>
            <td><input class="form-control" type="text" readonly name="name" value="<?php echo $hero['name']?>"></td>
            <td>
            <center>
                <a target="new" href="<?php echo $hero['smallImage']?>">
                <img width="80px" height="80px" src="<?php echo $hero['smallImage']?>?t=<?php echo time(); ?>"/>
                </a>
            </center>
            <br>
            <input class="form-control" placeholder="URL for icon of hero" type="file" name="image_icon" />
            </td>
            <td><input class="form-control" type="text" name="group" value="<?php echo $hero['group']?>"></td>
            <td>
            <input class="form-control" type="text" value="<?php echo $hero['type']?>" name="type" id="type" />
            <input class="form-control"  type="number" value="<?php echo $hero['id']?>" name="id" id="idHeroe" readonly>
            </td>
        </tr>
        
        <tr>
            <th>Description</th>
            <th>Rarity</th>
            <th>Race</th>
            <th>Role</th>
        </tr>
        <tr>
            <td><textarea class="form-control"  name="desc"><?php echo $hero['desc']?></textarea></td>
            <td>
                
                <select name="rarity" class="form-control">            
                <?php
                    $rarity = [
                        "Legendary+",
                        "Common",
                        "Ascended"];
                        foreach ($rarity as $r) {
                            if ($r == $hero['rarity']) {
                                echo "<option selected='selected' value='".$r."'>".$r."</option>";
                            } else {
                                echo "<option value='".$r."'>".$r."</option>";
                            }
                        }
                        ?>
                </select>
            </td>
            <td>
                <select name="rarity" class="form-control">            
                <?php
                    $races = [
                        "LIGHTBEARER",
                        "MAULER",
                        "WILDER",
                        "GRAVEBORN",
                        "CELESTIAL",
                        "HYPOGEAN"];
                foreach ($races as $r) {
                    if ($r == strtoupper($hero['race_name'])) {
                        echo "<option selected='selected' value='".$r."'>".$r."</option>";
                    } else {
                        echo "<option value='".$r."'>".$r."</option>";
                    }
                }
                ?>
                </select>
        </td>
        <td><input class="form-control" type="text" name="role" value="<?php echo $hero['role']?>"></td>
        
        </tr>
        <tr>
            <th>Synergy</th>
            <th>Position</th>
            <th>Artifact</th>
            <th>Union</th>
        </tr>
        <tr>
            <td>
                <select name="synergy[]" multiple="multiple" id="synergiSelect" class="form-control">            
                <?php
                $hero_list = [];
                foreach ($data['heroes']['data']['heroes'] as $h) {
                    echo "<option value='".$h['name']."'>".$h['name']."</option>";
                    array_push($hero_list, str_replace(" ", "",$h['name']));
                }
                ?>
                </select>
            <input type="text" id="input_synergy" value="<?php echo str_replace(" ", "",$hero['synergy']); ?>" hidden>
            <input type="text" id="heroes_list" value="<?php echo implode(",", $hero_list); ?>" hidden>
            </td>
            <td>
                <select name="position" id="positionSelect" class="form-control">            
                    <?php 
                    $positionArray = ["Any","Back","Front"];
                    foreach ($positionArray as $p) {
                        if ($p == $hero['position']) {
                            echo "<option selected='selected' value='".$p."'>".$p."</option>";
                        } else {
                            echo "<option value='".$p."'>".$p."</option>";
                        } 
                    }
                    ?>
                </select>        
            </td>
            <td>
            
            <select name="artifact[]" multiple="multiple" id="artifactSelect" class="form-control">
                <option value="nothing">Select Artifact</option>
                <option value="Dura's Grace">Dura's Grace</option>
                <option value="Dura's Eye">Dura's Eye</option>
                <option value="Dura's Call">Dura's Call</option>
                <option value="Dura's Drape">Dura's Drape</option>
                <option value="Dura's Blade">Dura's Blade</option>
                <option value="Dura's Chalice of Vitality">Dura's Chalice of Vitality</option>
                <option value="Dura's Conviction">Dura's Conviction</option>
            </select>
            <input type="text" id="input_artifac" value="<?php echo $hero['artifact']; ?>" hidden >
            </td>
            <td>
                <select name="union" id="unionSelect" class="form-control">            
                    <?php 
                    $unionArray = [" -","Yes","No"];
                    foreach ($unionArray as $p) {
                        if ($p == $hero['union']) {
                            echo "<option selected='selected' value='".$p."'>".$p."</option>";
                        } else {
                            echo "<option value='".$p."'>".$p."</option>";
                        } 
                    }
                    ?>
                </select>        
            </td>
        </tr>
        
        <tr>
            <th>Class *</th>
            <th>Introduction</th>
            <th>Lore</th>
            <th>Status</th>
        </tr>
        <tr>
            <td>
            <select name="classe" id="classeSelect" class="form-control">            
                <?php 
                $classeArray = ["Intelligence","Agility","Strength"];
                foreach ($classeArray as $p) {
                    if ($p == $hero['classe']) {
                        echo "<option selected='selected' value='".$p."'>".$p."</option>";
                    } else {
                        echo "<option value='".$p."'>".$p."</option>";
                    } 
                }
                ?>
            </select>
            </td>
            <td><textarea class="form-control"  name="introduction" ><?php echo $hero['introduction']; ?></textarea></td>
            <td><input class="form-control" type="text" name="lore" value="<?php echo $hero['lore']?>"></td>
            <td><input class="form-control" type="number" name="status" value="<?php echo $hero['status']; ?>"></td>
        </tr>>
        </tbody>
    </table>
    <center>
        <button class="btn btn-success" type="button" id="updateData">Update Information</button>
    </center>
</form>
