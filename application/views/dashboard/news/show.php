<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<meta name="viewport" content="width=device-width, user-scalable=no">

<div class="container">
	<br>
	<?php echo $data['data']['news']['desc']; ?>

</div>


<script>
    var images = document.getElementsByTagName('img')
    var links = document.getElementsByTagName('a')
	console.log(images.length)
	for (x = 0; x < images.length; x++){
        images[x].removeAttribute('sizes')
        images[x].style.display = "block"
        images[x].style.margin = "0px auto"
        images[x].style.maxWidth = "60%"
        images[x].style.height = "auto"
		console.log(images[x].src)
	}

    for (i = 0; i < links.length; i++) {
		links[i].href = "#"
    }

    textos = document.getElementsByTagName('p')
    for(x= 0 ; x < textos.length; x++){

    textos[x].style.wordBreak = "break-all"


    }


</script>
