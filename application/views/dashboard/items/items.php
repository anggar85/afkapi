<?php $this->view('dashboard/header'); ?>

<!-- Sidebar -->
<?php //$this->view('dashboard/sidebar'); ?>


  <div class="container ">
    <br>
    <h4>Items</h4>
    <table class="table table-hover">
      <?php
      foreach ($data['data']['items'] as $item) {
        echo "<tr>";
        echo "<td><img src='".$item->image."'></td>";
        echo "<td>".$item->title."</td>";
        echo "<td>".$item->desc."</td>";
        echo "<td><a href='edit/".$item->id."'><span class='fa fa-edit'></span></a></td>";
        echo "<td><a href='edit/".$item->id."'><span class='fa fa-trash'></span></a></td>";
        echo "</tr>";
      }
      ?>       
    </table>
  </div>
<!--  -->
<!-- Sticky Footer -->
<?php $this->view('dashboard/footer'); ?>
    