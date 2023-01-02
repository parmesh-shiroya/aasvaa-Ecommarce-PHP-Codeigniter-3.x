  <div class="pp-row">
  <div class="pp-container">
    <div class="pp-col ps12">
      <ul class="tabs border3-1px">
        <li class="tab pp-col ps12 pm6 pl105"><a href="#slider_test1" class="active text-tran_none"><?php echo $this->pp_loader_helper->product_slider_title_writer($slider1['slider_product_by']['show_product_by']); ?></a></li>
        <li class="tab pp-col ps12 pm6 pl105"><a class=" text-tran_none" href="#slider_test2"><?php echo $this->pp_loader_helper->product_slider_title_writer($slider2['slider_product_by']['show_product_by']); ?></a></li>
      </ul>
    </div>
</div>
    <div id="slider_test1" class="pp-col ps12">

<?php

$data1['slider_product']    = $slider1['slider_product'];
$data1['slider_product_by'] = $slider1['slider_product_by'];
$this->view('web/contents/sliders/product_slider1', $data1);?>
    </div>
    <div id="slider_test2" class="pp-col ps12">
<?php
$data1['slider_product']    = $slider2['slider_product'];
$data1['slider_product_by'] = $slider2['slider_product_by'];
$this->view('web/contents/sliders/product_slider1', $data1);?>
    </div>

  </div>

  <style>
  .indicator{
    display: none;
  }
  #slider_test1 .pp-container,#slider_test2 .pp-container{
margin-top: 0px !important;
margin-bottom: 0px !important;
  }


  </style>