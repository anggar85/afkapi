<?php $this->view('dashboard/header'); ?>

<!-- include libraries(jQuery, bootstrap) -->
<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script> 
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script> 

<!-- include summernote css/js -->
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">




<!-- Initialize Quill editor -->

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
    <label for="">Description</label>
    <textarea id="summernote" class="form-control" type="text" name="desc"></textarea>
          
    <br>
    <center><input type="submit" class="btn btn-success" value="Create New" /></center>
    <br>

    </form>

    
  
    
  </div>
<!--  -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>

<script>
  $('#summernote').summernote({
  height: 300,                 // set editor height
  minHeight: null,             // set minimum height of editor
  maxHeight: null,             // set maximum height of editor
  focus: true                  // set focus to editable area after initializing summernote
});
</script>

<!-- Sticky Footer -->
<?php $this->view('dashboard/footer'); ?>
