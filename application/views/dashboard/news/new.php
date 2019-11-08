<?php $this->view('dashboard/header'); ?>

<!-- Sidebar -->
<?php //$this->view('dashboard/sidebar'); ?>

  <div class="container ">
    <hr>
    <br>
    <h4>News</h4>

    <?php echo form_open_multipart('news/save/');?>

    <legend>New Noticia</legend>
    
    <br>
    <label for="">Image</label>
    <input class="form-control" type="file" name="image" />
      
    <br>
    <label for="">Title</label>
    <input class="form-control" type="text" name="title" />
      
    <br>
    <label for="">Description</label>
    <input class="form-control" type="text" name="desc" />
          
    <br>
    <center><input type="submit" class="btn btn-success" value="Create New" /></center>
    <br>

    </form>

    
  
    
  </div>
<!--  -->
<!-- Sticky Footer -->
<?php $this->view('dashboard/footer'); ?>
