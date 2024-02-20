<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://kit.fontawesome.com/594166b593.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="<?php echo APPROOT.'\public\css\Catalog\VolumetricFlask.css';?>">
</head>

<body>
  <section>
    <div class="container flex">
      <div class="left">
        <div class="main_image">
        <img src="<?php echo APPROOT.'/public/';?>img/Supplier/flask1.jpeg" alt="">
        </div>
        
        <div class="option flex">
        <img src="<?php echo APPROOT.'/public/';?>img/Supplier/flask1.jpeg" alt="">
        <img src="<?php echo APPROOT.'/public/';?>img/Supplier/flask2.jpeg" alt="">
        <img src="<?php echo APPROOT.'/public/';?>img/Supplier/flask3.jpeg" alt="">
        <img src="<?php echo APPROOT.'/public/';?>img/Supplier/flask4.jpeg" alt="">
        </div>
      </div>
      <div class="right">
        <h2>Type-Volumetric flasks</h2>
        <h3>Volumetric flask</h3>
        <h4> <small>Starting price Rs.</small>2500</h4>
        <p>LSS SRILANKA company manufactured Borosilicate volumetric flasks with 250ml, 500ml, 750ml and 1000ml</p>
      
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