<?php echo $data['data']['news']['desc']; ?>


<script>
	var images = document.getElementsByTagName('img')
	console.log(images.length)
	for (x = 0; x < images.length; x++){
        images[x].removeAttribute('sizes')
        images[x].removeAttribute('srcset')
	    images[x].minWidth = screen.availWidth
	}

</script>
