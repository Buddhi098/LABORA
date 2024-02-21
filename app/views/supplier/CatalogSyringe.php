<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://kit.fontawesome.com/594166b593.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="<?php echo APPROOT.'\public\css\Catalog\Syringe.css';?>">
</head>

<body>
  <section>
    <div class="container flex">
      <div class="left">
        <div class="main_image">
        <img src="<?php echo APPROOT.'/public/';?>img/Supplier/syringe1.jpeg" alt="">
        </div>
        
        <div class="option flex">
        <img src="<?php echo APPROOT.'/public/';?>img/Supplier/syringe1.jpeg" alt="">
        <img src="<?php echo APPROOT.'/public/';?>img/Supplier/syringe2.jpeg" alt="">
        <img src="<?php echo APPROOT.'/public/';?>img/Supplier/syringe3.jpeg" alt="">
          
        </div>
      </div>
      <div class="right">
        <h2>Type-Syringes</h2>
        <h3>Syringes(Protection cap on/off, 25ml-100ml volumetric ranges, type of the sharpness)</h3>
        <h4> <small>Starting price Rs.</small>30</h4>
        <p>Medihelp and Diagoncare are the main medical syringe distributors in sri lanka </p>
      
        <button>Add to quotation</button>
      </div>
    </div>
  </section>
  <script>
    function img(anything) {
      document.querySelector('.slide').src = anything;
    }

    function change(change) {
      const line = document.querySelector('.home');
      line.style.background = change;
    }
  </script>
</body>

</html>