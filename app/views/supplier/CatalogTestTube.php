<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://kit.fontawesome.com/594166b593.js" crossorigin="anonymous"></script>
  <link rel="stylesheet"  href="<?php echo APPROOT.'\public\css\Catalog\testtube.css';?>">
</head>

<body>
  <section>
    <div class="container flex">
      <div class="left">
        <div class="main_image">
        <img src="<?php echo APPROOT.'/public/';?>img/Supplier/tube1.jpg" alt="">
        </div>
        
        <div class="option flex">
        <img src="<?php echo APPROOT.'/public/';?>img/Supplier/tube1.jpg" alt="">
        <img src="<?php echo APPROOT.'/public/';?>img/Supplier/tube2.jpeg" alt="">
        <img src="<?php echo APPROOT.'/public/';?>img/Supplier/tube3.jpg" alt="">
          
        </div>
      </div>
      <div class="right">
        <h2>Type-Test tubes</h2>
        <h3>Test tube (quartz glass, Cork stopper, interchangable stopper)</h3>
        <h4> <small>starting price Rs.</small>60</h4>
        <p>Science house manufacturers give the test tube products with a fair price and a discount</p>
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