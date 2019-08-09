<?php $this->view('dashboard/header'); ?>

<!-- Sidebar -->
<?php //$this->view('dashboard/sidebar'); ?>

  <div class="container-fluid">
    <hr>
    <br>
    <?php $hero = $data['data']['heroe']; ?>
    <h4><?php echo $hero['name'] ?></h4>
    <?php //var_dump($data['data']['heroe']); ?>
    <div class="panel with-nav-tabs panel-default">
        <div class="panel-heading">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab1default" data-toggle="tab">Basic Info</a></li>
                    <li><a href="#tab2default" data-toggle="tab">Skills</a></li>
                    <li><a href="#tab3default" data-toggle="tab">Pros/Cons</a></li>
                    <li><a href="#tab4default" data-toggle="tab">Tier Data</a></li>
                </ul>
        </div>
        <div class="panel-body">
            <div class="tab-content">
                <div class="tab-pane fade in active" id="tab1default">
                <?php $this->view('dashboard/heroes/basic_info', $data['data']['heroe']); ?>
                </div>
                <div class="tab-pane fade " id="tab2default">
                <?php $this->view('dashboard/heroes/skills', $data['data']['heroe']); ?>
                </div>
                <div class="tab-pane fade " id="tab3default">
                <?php $this->view('dashboard/heroes/pros_contras', $data['data']['heroe']); ?>
                </div>
                <div class="tab-pane fade " id="tab4default">
                <?php $this->view('dashboard/heroes/tier_data', $data['data']['heroe']); ?>
                </div>
            </div>
        </div>
    </div>

  </div>
<!--  -->
<!-- Sticky Footer -->
<?php $this->view('dashboard/footer'); ?>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/scripts.js" ></script>

    