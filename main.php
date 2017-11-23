<?php 
    defined('lock_key') or die('В доступе отказано!');
?>
<div class="carousel fade-carousel slide" data-ride="carousel" data-interval="3000" id="bs-carousel">
  <!-- Overlay -->
  <div class="overlay">
      <div class="hero">
        <hgroup>
            <h1>Это не просто хобби</h1>        
            <h3>Начни свою историю коллекционирования</h3>
        </hgroup>
        <button class="btn btn-hero btn-lg" role="button">Перейти в каталог</button>
      </div>
  </div>

  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#bs-carousel" data-slide-to="0" class="active"></li>
    <li data-target="#bs-carousel" data-slide-to="1"></li>
    <li data-target="#bs-carousel" data-slide-to="2"></li>
  </ol>
  
  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item slides active">
      <div class="slide-1"></div>
      <div class="hero">
        <hgroup>
        </hgroup>
      </div>
    </div>
    <div class="item slides">
      <div class="slide-2"></div>
      <div class="hero">        
        <hgroup>
        </hgroup>       
      </div>
    </div>
    <div class="item slides">
      <div class="slide-3"></div>
      <div class="hero">        
        <hgroup>
        </hgroup>
      </div>
    </div>
  </div> 
</div>