<?php $this->view('dashboard/header'); ?>

<!-- Sidebar -->
<?php //$this->view('dashboard/sidebar'); ?>


  <div class="container ">
    <br>
    <h4>Items</h4>
    
    <a href="<?php echo base_url('items/new');?>"  class="btn btn-primary fa-pull-right">New Item</a>
    <br>
    <br>
    <table class="table table-hover">
      <?php
      foreach ($data['data']['items'] as $item) {
        echo "<tr>";
        echo "<td><img src='".$item->image."'></td>";
        echo "<td>".$item->title."</td>";
        echo "<td>".$item->desc."</td>";
        echo "<td><a href='edit/".$item->id."'><span class='fa fa-edit'></span></a></td>";
        echo "<td><a class='deleteItem' href='delete/".$item->id."'><span class='fa fa-trash'></span></a></td>";
        echo "</tr>";
      }
      ?>       
    </table>
  </div>
<!--  -->
<!-- Sticky Footer -->
<?php $this->view('dashboard/footer'); ?>

<script>

      $(".deleteItem").click(function (e) { 
        e.preventDefault();
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.value) {
            var url = $(this).attr("href");
            window.location.href = url;


          }
        })
      });

</script>
    