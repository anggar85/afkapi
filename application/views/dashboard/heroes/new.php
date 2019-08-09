<?php $this->view('dashboard/header'); ?>
<?php $heroes = $data['heroes']['data']['heroes']; ?>
<!-- Sidebar -->
<?php //$this->view('dashboard/sidebar'); ?>

  <div class="container-fluid">
    <hr>
    <br>
    <h4>New Hero</h4>
    
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <?php echo form_open_multipart('hero/save/');?>
                
                <table class="table" id="tableDataOfHeroe">
                    <tbody>
                    <tr>
                        <th>Name *</th>
                        <th >How many Skills have?</th>
            
                    </tr>
                    <tr>
                        <td><input class="form-control" type="text" name="name"></td>
                        <td >
                        <input type="number" max="4" min="3" name="num_skills" class="form-control">
                        </td>
                        
                    </tr>
                    
                    <tr>
                        <th>Rarity</th>
                        <th>Race</th>
                    </tr>
                    <tr>
                        <td>
                            <select name="rarity" class="form-control">            
                            <?php
                                $rarity = [
                                    "Legendary+",
                                    "Ascended"];
                                    foreach ($rarity as $r) {
                                        echo "<option value='".$r."'>".$r."</option>";
                                    }
                                    ?>
                            </select>
                        </td>
                        <td>
                            <select name="race_name" class="form-control">            
                            <?php
                                $races = [
                                    "LIGHTBEARER",
                                    "MAULER",
                                    "WILDER",
                                    "GRAVEBORN",
                                    "CELESTIAL",
                                    "HYPOGEAN"];
                            foreach ($races as $r) {
                                echo "<option value='".$r."'>".$r."</option>";
                            }
                            ?>
                            </select>
                    </td>
                    
                    </tr>
                    
                    <tr>
                        <th>Class *</th>
                    </tr>
                    <tr>
                        <td>
                        <select name="classe" id="classeSelect" class="form-control">            
                            <?php 
                            $classeArray = ["Intelligence","Agility","Strength"];
                            foreach ($classeArray as $p) {
                                echo "<option value='".$p."'>".$p."</option>";
                            }
                            ?>
                        </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                        <center>
                        <input class="btn btn-success" type="submit" id="updateData" value="Create New Hero">
                        </center>
                        </td>
                    </tr>
                    </tbody>
                </table>

            </form>
        </div>
    </div>
    
  </div>
<!--  -->
<!-- Sticky Footer -->
<?php $this->view('dashboard/footer'); ?>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/scripts.js" ></script>

    