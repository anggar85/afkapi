
<?php  //var_dump($data['data']['heroe']['early']); ?>
<?php  //echo selects($data['data']['heroe']['early']['overall'], 'early'); ?>
<?php  //var_dump($data['data']['heroe']); ?>
<?php // var_dump($data['data']['heroe']['strengths']); ?>
<?php //var_dump($data['data']['heroe']['weaknesses']); ?>

<?php echo form_open_multipart('hero/update_tier_data/'.$data['data']['heroe']['id'].'/tier_list_earlies/'.$data['data']['heroe']['name']);?>
<table class="table" id="tier_list_earlies">
    <tr><th colspan="6"><b>Early Game</b></th></tr>
        <tr>
        <th>Overall</th>
        <th>PVP</th>
        <th>PVE</th>
        <th>LAB</th>
        <th>Wrizz</th>
        <th>Soren</th>
        </tr>
        <tr>
        <td><?php  echo selects($data['data']['heroe']['early']['overall'], 'overall'); ?></td>
        <td><?php  echo selects($data['data']['heroe']['early']['pvp'], 'pvp'); ?></td>
        <td><?php  echo selects($data['data']['heroe']['early']['pve'], 'pve'); ?></td>
        <td><?php  echo selects($data['data']['heroe']['early']['lab'], 'lab'); ?></td>
        <td><?php  echo selects($data['data']['heroe']['early']['wrizz'], 'wrizz'); ?></td>
        <td><?php  echo selects($data['data']['heroe']['early']['soren'], 'soren'); ?></td>
        </tr>
        <tr>
        <th colspan="6">
            <center>
            <button onclick="updateTierData('tier_list_earlies', '{{name}}')" class="btn btn-xs btn-primary">Update Tier Data</button>
            </center>
        </th>
        </tr>
    </table>
    </form>
    <?php echo form_open_multipart('hero/update_tier_data/'.$data['data']['heroe']['id'].'/tier_list_mids/'.$data['data']['heroe']['name']);?>
    <table class="table" id="tier_list_mids">
    <tr><th colspan="6"><b>Mid Game</b></th></tr>
        <tr>
        <th>Overall</th>
        <th>PVP</th>
        <th>PVE</th>
        <th>LAB</th>
        <th>Wrizz</th>
        <th>Soren</th>
        </tr>
        <tr>
        <td><?php  echo selects($data['data']['heroe']['mid']['overall'], 'overall'); ?></td>
        <td><?php  echo selects($data['data']['heroe']['mid']['pvp'], 'pvp'); ?></td>
        <td><?php  echo selects($data['data']['heroe']['mid']['pve'], 'pve'); ?></td>
        <td><?php  echo selects($data['data']['heroe']['mid']['lab'], 'lab'); ?></td>
        <td><?php  echo selects($data['data']['heroe']['mid']['wrizz'], 'wrizz'); ?></td>
        <td><?php  echo selects($data['data']['heroe']['mid']['soren'], 'soren'); ?></td>
        </tr>
        <tr>
        <th colspan="6">
            <center>
            <button onclick="updateTierData('tier_list_mids', '{{name}}')" class="btn btn-xs btn-primary">Update Tier Data</button>
            </center>
        </th>
        </tr>
    </table>
    </form>
    <?php if($data['data']['heroe']['late']['overall']!= ""){ ?>
        <?php echo form_open_multipart('hero/update_tier_data/'.$data['data']['heroe']['id'].'/tier_list_lates/'.$data['data']['heroe']['name']);?>
    <table class="table" id="tier_list_lates">
    <tr><th colspan="6"><b>Late Game</b></th></tr>
        <tr>
        <th>Overall</th>
        <th>PVP</th>
        <th>PVE</th>
        <th>LAB</th>
        <th>Wrizz</th>
        <th>Soren</th>
        </tr>
        <tr>
        <td><?php  echo selects($data['data']['heroe']['late']['overall'], 'overall'); ?></td>
        <td><?php  echo selects($data['data']['heroe']['late']['pvp'], 'pvp'); ?></td>
        <td><?php  echo selects($data['data']['heroe']['late']['pve'], 'pve'); ?></td>
        <td><?php  echo selects($data['data']['heroe']['late']['lab'], 'lab'); ?></td>
        <td><?php  echo selects($data['data']['heroe']['late']['wrizz'], 'wrizz'); ?></td>
        <td><?php  echo selects($data['data']['heroe']['late']['soren'], 'soren'); ?></td>
        </tr>
        <tr>
        <th colspan="6">
            <center>
            <button onclick="updateTierData('tier_list_lates', '{{name}}')" class="btn btn-xs btn-primary">Update Tier Data</button>
            </center>
        </th>
        </tr>
    </table>
    </form>
    <?php } ?>