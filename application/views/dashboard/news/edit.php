<?php $this->view('dashboard/header'); ?>

<!-- Sidebar -->
<?php //$this->view('dashboard/sidebar'); ?>

  <div class="container ">
    <hr>
    <br>
    <h4>Items</h4>
    <?php $item = $data['data']['item']; ?>
    
    <?php echo form_open_multipart('items/update/'.$item->id);?>

    <legend>Edit <?php echo $item->title ?></legend>
    
    <label for="">Image</label>
    <img src="<?php echo $item->image ?>" class="img-responsive" alt="Image">
    <br>
    <input class="form-control" type="file" name="image" />
      
    <br>
    <label for="">Title</label>
    <input class="form-control" type="text" name="title" value="<?php echo $item->title ?>" />
      
        
    <br>
    <label for="">Description</label>
    <input class="form-control" type="text" name="desc" value="<?php echo $item->desc ?>" />
          
    <br>
    <label for="">ID</label>
    <input class="form-control" type="text" name="id" readonly value="<?php echo $item->id ?>" />
      
    <br>
    <center><input type="submit" class="btn btn-success" value="Update" /></center>
    <br>

    </form>

    
  
    
  </div>
<!--  -->
<!-- Sticky Footer -->
<?php $this->view('dashboard/footer'); ?>
    