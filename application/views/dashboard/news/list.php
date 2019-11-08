<?php $this->view('dashboard/header'); ?>

  <div class="container ">
    <br>
    <h4>News</h4>
    
    <a href="<?php echo base_url('news/new');?>"  class="btn btn-primary fa-pull-right">New Item</a>
    <br>
    <br>
    <table class="table table-hover">
      <?php
      foreach ($data['data']['news'] as $news) {
        echo "<tr>";
        echo "<td width='200px'><a target='new' href='".base_url("assets/heroes/news/{$news['image']}")."'><img width='200px' src='".base_url("assets/heroes/news/{$news['image']}")."'></a></td>";
        echo "<td>".$news['title']."</td>";
        echo "<td>".$news['desc']."</td>";
        echo "<td><a class='deleteItem' href='delete/".$news['id']."'><span class='fa fa-trash'></span></a></td>";
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
