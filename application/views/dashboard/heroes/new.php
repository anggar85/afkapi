<?php $this->view('dashboard/header'); ?>

<!-- Sidebar -->
<?php //$this->view('dashboard/sidebar'); ?>

  <div class="container ">
    <hr>
    <br>
    <h4>Items</h4>

    <?php echo form_open_multipart('items/save/');?>

    <legend>New Item</legend>
    
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
    <center><input type="submit" class="btn btn-success" value="Create Item" /></center>
    <br>

    </form>

    
  
    
  </div>
<!--  -->
<!-- Sticky Footer -->
<?php $this->view('dashboard/footer'); ?>
    