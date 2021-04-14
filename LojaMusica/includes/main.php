<main>
	<style>
.mySlides {display: none}
img {height: 450px;}

/* Slideshow container */
.slideshow-container {
  position: relative;
  margin: 35px;
  width: 100%;
   min-height: 400px;
}

/* Next & previous buttons */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: 25px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.8);
}

/* Caption text */
.text {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */
.dot {
  cursor: pointer;
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active, .dot:hover {
  background-color: #717171;
}

/* Fading animation */
.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 1.5s;
}

@-webkit-keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .prev, .next,.text {font-size: 11px}
}
</style>
</head>
<body>

<div class="slideshow-container">

<div class="mySlides fade">
  <div class="numbertext">1 / 2</div>
  <img src="img/1.jpg" style="width:100%">
</div>

<div class="mySlides fade">
  <div class="numbertext">2 / 2</div>
  <img src="img/10.jpg" style="width:100%">
  
</div>

<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
<a class="next" onclick="plusSlides(1)">&#10095;</a>

</div>
<br>

<div style="text-align:center">
  <span class="dot" onclick="currentSlide(1)"></span> 
  <span class="dot" onclick="currentSlide(2)"></span> 
</div>

<script>
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}
</script>

<div class="Novidades">
	<h2>Destaques</h2>
	<h4>Confira os nossos destaques:</h4>
	<div class ="destaque">
    <?php
    destaques1();
    ?>    
        <div class ="limpa"></div>
    </div>
	<!--<div class="novidades_conteudos">
		<div class="novidades_item">
			<img src="img/2.jpg"></img>
			<h3>VALETE</h3>
			<p>SERVIÇO PÚBLICO (2LP)</p>
			<p1>30.44€</p1>
			<button><n>Comprar</n></button>
		</div>
		<div class="novidades_item">
			<img src="img/3.jpg"></img>
			<h3>VALETE</h3>
			<p>EDUCAÇÃO VISUAL</p>
			<h5>
			
		</div>
		<div class="novidades_item">
			<img src="img/4.jpg"></img>
			
		</div>
		<div class="novidades_item">
			<img src="img/5.jpg"></img>
			
		</div>
		<div class="novidades_item">
			<img src="img/6.jpg"></img>
			
		</div>
		<div class="novidades_item">
			<img src="img/7.jpg"></img>
			
		</div>
		<div class="novidades_item">
			<img src="img/8.jpg"></img>
			
		</div>
		<div class="novidades_item">
			<img src="img/9.jpg"></img>
			
		</div>
		<div class="novidades_item">
			<img src="img/11.jpg"></img>
			
		</div>
		<div class="novidades_item">
			<img src="img/12.jpg"></img>
			
		</div>
		<div class="novidades_item">
			<img src="img/13.jpg"></img>
			
		</div>
		<div class="novidades_item">
			<img src="img/14.jpg"></img>
			
		</div>
		<div class="novidades_item">
			<img src="img/15.jpg"></img>
			
		</div>
		<div class="novidades_item">
			<img src="img/16.jpg"></img>
			
		</div>
		<div class="novidades_item">
			<img src="img/17.jpg"></img>
			
		</div>
		<div class="novidades_item">
			<img src="img/18.jpg"></img>
			<h3>VALETE</h3>
			<p>SERVIÇO PÚBLICO (2LP)</p>
			<p1>30.44€</p1>
			<button><n>Comprar</n></button>
			-->
			
		</div>
	</div>
</div>


</main>