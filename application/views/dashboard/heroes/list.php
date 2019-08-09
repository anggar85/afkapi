<?php $this->view('dashboard/header'); ?>

<!-- Sidebar -->


  <div class="container-fluid">
    <br>
    <h4>Heroes</h4>
    
    <a href="<?php echo base_url('hero/new');?>"  class="btn btn-primary fa-pull-right">New Hero</a>
    <br>
    <br>
      <?php
      foreach ($data['data']['heroes'] as $hero) {
        echo "<div class='col-md-1 col-xs-2'><a href='edit/".$hero['id']."'><img  src='".$hero['smallImage']."'></a></div>";
      }
      ?>       
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
    