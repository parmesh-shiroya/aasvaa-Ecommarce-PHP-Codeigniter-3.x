  <ul id="slide-out" class="side-nav filter_side_nav">
    <li><div>
      <div class="card radius-0 z-depth-0 filter_card_main zero_padding pp-col ps12">
        <div class="card radius-0 teal zero_margin p-padding_5 pp-col ps12">
          <span class="font-18 white-text" style="margin-left:10px;">Color</span>
        </div>
        <div style="overflow-y:hidden;" class="card filter-card radius-0 p-padding_10 zero_margin pp-col ps12">
          <div style="margin:0px 0px 10px 0px;" class="pp-col zero_padding ps12">
             <span class="font12 grey-text text-darken-1">Price range: <span class="min-price-span"><?php echo $this->ccr->cc('INR', $_SESSION['currency_choose'], $select_min_price); ?></span> -  <span class="max-price-span"><?php echo $this->ccr->cc('INR', $_SESSION['currency_choose'], $select_max_price); ?></span></span>
          </div>
  <div class="pp-col  ps12"  style="padding-left: 10px;">
            <div type="range" select-min="<?php echo $select_min_price; ?>" select-max="<?php echo $select_max_price; ?>" mini="<?php echo $min_price; ?>" maximum="<?php echo $max_price; ?>" id="price_ranger2"></div>
          </div>
        </div>
      </div>
      <?php if (!empty($filter_data['fabric_array'])) {
      	?>
      <div class="card radius-0 z-depth-0 filter_card_main zero_padding pp-col ps12">
        <div class="card radius-0 teal zero_margin p-padding_5 pp-col ps12">
          <span class="font-18 white-text" style="margin-left:10px;">Fabric</span>
        </div>
        <div class="card filter-card radius-0 zero_padding zero_margin pp-col ps12">
          <ul class="zero_margin filter_options_ul">
            <?php foreach ($filter_data['fabric_array'] as $key => $value) {
            		?>
            <li><input type="checkbox"
              <?php
              	if (isset($_SESSION['filter']['Fabric']) && in_array($value, $_SESSION['filter']['Fabric'])) {
              				echo " checked='checked' ";
              			}
              		?>
              key="Fabric" vals="<?php echo $value; ?>" class="filled-n filter-checkbox" id="fabric-box_<?php echo $key; ?>"  />
              <label class="font13" for="fabric-box_<?php echo $key; ?>"><?php echo $value; ?></label></li>
              <?php }?>
            </ul>
          </div>
        </div>
        <?php }if (!empty($filter_data['color_array'])) {
        	?>
        <div class="card radius-0 z-depth-0 filter_card_main zero_padding pp-col ps12">
          <div class="card radius-0 teal zero_margin p-padding_5 pp-col ps12">
            <span class="font-18 white-text" style="margin-left:10px;">Color</span>
          </div>
          <div class="card filter-card radius-0 zero_padding zero_margin pp-col ps12">
            <ul class="zero_margin filter_options_ul">
              <?php foreach ($filter_data['color_array'] as $key => $value) {
              		?>
              <li><input type="checkbox"
                <?php
                	if (isset($_SESSION['filter']['Color']) && in_array($value, $_SESSION['filter']['Color'])) {
                				echo " checked='checked' ";
                		}
                		?> key="Color" vals="<?php echo $value; ?>" class="filled-n filter-checkbox" id="color-box_<?php echo $key; ?>"  />
                <label class="font13" for="color-box_<?php echo $key; ?>"><?php echo $value; ?></label></li>
                <?php }?>
              </ul>
            </div>
          </div>
          <?php }
          	if (!empty($filter_data['celebrity_array'])) {
          	?>
          <div class="card radius-0 z-depth-0 filter_card_main zero_padding pp-col ps12">
            <div class="card radius-0 teal zero_margin p-padding_5 pp-col ps12">
              <span class="font-18 white-text" style="margin-left:10px;">Celebrity</span>
            </div>
            <div class="card filter-card radius-0 zero_padding zero_margin pp-col ps12">
              <ul class="zero_margin filter_options_ul">
                <?php foreach ($filter_data['celebrity_array'] as $key => $value) {
                		?>
                <li><input<?php
	if (isset($_SESSION['filter']['Celebrity']) && in_array($value, $_SESSION['filter']['Celebrity'])) {
				echo " checked='checked' ";
		}
		?> type="checkbox" key="Celebrity" vals="<?php echo $value; ?>" class="filled-n filter-checkbox" id="celebrity-box_<?php echo $key; ?>"  />
                  <label class="font13" for="celebrity-box_<?php echo $key; ?>"><?php echo $value; ?></label></li>
                  <?php }?>
                </ul>
              </div>
            </div>
            <?php }if (!empty($filter_data['occasion_array'])) {
            	?>
            <div class="card radius-0 z-depth-0 filter_card_main zero_padding pp-col ps12">
              <div class="card radius-0 teal zero_margin p-padding_5 pp-col ps12">
                <span class="font-18 white-text" style="margin-left:10px;">Occasion</span>
              </div>
              <div class="card filter-card radius-0 zero_padding zero_margin pp-col ps12">
                <ul class="zero_margin filter_options_ul">
                  <?php foreach ($filter_data['occasion_array'] as $key => $value) {
                  		?>
                  <li><input<?php
	if (isset($_SESSION['filter']['Occasion']) && in_array($value, $_SESSION['filter']['Occasion'])) {
				echo " checked='checked' ";
		}
		?> type="checkbox" key="Occasion" vals="<?php echo $value; ?>" class="filled-n filter-checkbox" id="occasion-box_<?php echo $key; ?>"  />
                    <label class="font13" for="occasion-box_<?php echo $key; ?>"><?php echo $value; ?></label></li>
                    <?php }?>
                  </ul>
                </div>
              </div>
              <?php }if (!empty($filter_data['style_array'])) {
              	?>
              <div class="card radius-0 z-depth-0 filter_card_main zero_padding pp-col ps12">
                <div class="card radius-0 teal zero_margin p-padding_5 pp-col ps12">
                  <span class="font-18 white-text" style="margin-left:10px;">Style</span>
                </div>
                <div class="card filter-card radius-0 zero_padding zero_margin pp-col ps12">
                  <ul class="zero_margin filter_options_ul">
                    <?php foreach ($filter_data['style_array'] as $key => $value) {
                    		?>
                    <li><input<?php
	if (isset($_SESSION['filter']['Style']) && in_array($value, $_SESSION['filter']['Style'])) {
				echo " checked='checked' ";
		}
		?> type="checkbox" key="Style" vals="<?php echo $value; ?>" class="filled-n filter-checkbox" id="style-box_<?php echo $key; ?>"  />
                      <label class="font13" for="style-box_<?php echo $key; ?>"><?php echo $value; ?></label></li>
                      <?php }?>
                    </ul>
                  </div>
                </div>
                <?php }if (!empty($filter_data['work_array'])) {
                	?>
                <div class="card radius-0 z-depth-0 filter_card_main zero_padding pp-col ps12">
                  <div class="card radius-0 teal zero_margin p-padding_5 pp-col ps12">
                    <span class="font-18 white-text" style="margin-left:10px;">Work</span>
                  </div>
                  <div class="card filter-card radius-0 zero_padding zero_margin pp-col ps12">
                    <ul class="zero_margin filter_options_ul">
                      <?php foreach ($filter_data['work_array'] as $key => $value) {
                      		?>
                      <li><input<?php
	if (isset($_SESSION['filter']['Work']) && in_array($value, $_SESSION['filter']['Work'])) {
				echo " checked='checked' ";
		}
		?> type="checkbox" key="Work" vals="<?php echo $value; ?>" class="filled-n filter-checkbox" id="work-box_<?php echo $key; ?>"  />
                        <label class="font13" for="work-box_<?php echo $key; ?>"><?php echo $value; ?></label></li>
                        <?php }?>
                      </ul>
                    </div>
                  </div>
                  <?php }if (!empty($filter_data['catalog_array'])) {
                  	?>
                  <div class="card hidden radius-0 z-depth-0 filter_card_main zero_padding pp-col ps12">
                    <div class="card radius-0 teal zero_margin p-padding_5 pp-col ps12">
                      <span class="font-18 white-text" style="margin-left:10px;">Catalog</span>
                    </div>
                    <div class="card filter-card radius-0 zero_padding zero_margin pp-col ps12">
                      <ul class="zero_margin filter_options_ul">
                        <?php foreach ($filter_data['catalog_array'] as $key => $value) {
                        		?>
                        <li><input<?php
	if (isset($_SESSION['filter']['CatalogName']) && in_array($value, $_SESSION['filter']['CatalogName'])) {
				echo " checked='checked' ";
		}
		?> type="checkbox" key="CatalogName" vals="<?php echo $value; ?>" class="filled-n filter-checkbox" id="catalog-box_<?php echo $key; ?>"  />
                          <label class="font13" for="catalog-box_<?php echo $key; ?>"><?php echo $value; ?></label></li>
                          <?php }?>
                        </ul>
                      </div>
                    </div>
                    <?php }?>
    </div></li>

  </ul>
  <a href="#" data-activates="slide-out" class="side_filter center show_on_lage_and_small valign-wrapper side_filter_button"><i class="fa fa-filter pcenter" aria-hidden="true"></i></a>


<script>
  jQuery(document).ready(function($) {
     $(".side_filter").sideNav({
       edge: 'right', // Choose the horizontal origin
      closeOnClick: true // Closes side-nav on <a> clicks, useful for Angular/Meteor
     });
  });
</script>

<style type="text/css" media="screen">
  .filter_side_nav li{
line-height: 30px;
  }
.side_filter_button{
   background-color: #333;
    color: #fff;

    height: 40px;
    font-size: 23px;
    width: 40px;
    position: fixed;
    z-index: 400;
    right: 0;
    display: none;
    top: 118px;
    }
    @media only screen and (max-width : 1300px) {

  .side_filter_button{
    display: block;
  }
}


</style>