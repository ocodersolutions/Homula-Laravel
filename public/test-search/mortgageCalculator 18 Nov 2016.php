  <div class="row" style='margin-top:20px;' id='mortgageCalculator'>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    
      <form class="form-horizontal well"  name="MortgageCalculator" >
        <div class='row'>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h4 style='text-align:center'><?php print __("Mortgage Calculator"); ?></h4>
            <?php print __("Use this calculator to estimate your monthly mortgage payment"); ?>
            </div>
        </div>  
        <div class="form-group">
          <label class="col-xs-5 col-sm-5 col-md-5 col-lg-5 control-label"><?php print __("House Price"); ?></label>
          <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
            <input type="text" onchange="checkForZero(this)" onblur="checkForZero(this)" class='form-control' value="750000" name="price"></input>
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-5 col-sm-5 col-md-5 col-lg-5 control-label"><?php print __("Interest Rate")." %"; ?></label>
          <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
          <input type="text" onchange="checkForZero(this)" onblur="checkForZero(this)" class='form-control' value="3" name="ir"></input>
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-5 col-sm-5 col-md-5 col-lg-5 control-label"><?php print __("Years"); ?></label>
          <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
          <input type="text" onchange="checkForZero(this)" onblur="checkForZero(this)" class='form-control' value="30" name="term">
          </input>
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-5 col-sm-5 col-md-5 col-lg-5 control-label"><?php print __("Down Payment"); ?></label>
          <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
          <input type="text" class='form-control' onchange="calculatePayment(this.form)" value="0" name="dp">
          
          </input>
          </div>
        </div>
        <br/>
        <div class="form-group">
          <div style='text-align:right;' class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
          <input type="button"  class="btn btn-primary btn-large" onclick="cmdCalc_Click(this.form)" value="<?php print __("Calculate"); ?>" name="cmdCalc">
          </input>
          </div>
        </div>
        <br/>
        <div class="form-group">
          <label class="col-xs-5 col-sm-5 col-md-5 col-lg-5 control-label"><?php print __("Mortgage Principle"); ?></label>
          <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
          <input type="text" class='form-control' readonly name="principle">
          
          </input>
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-5 col-sm-5 col-md-5 col-lg-5 control-label"><?php print __("Total Payments"); ?></label>
          <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
          <input type="text" class='form-control' readonly name="payments">
          
          </input>
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-5 col-sm-5 col-md-5 col-lg-5 control-label"><?php print __("Payment/Month"); ?></label>
          <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
          <input type="text" class='form-control' readonly name="pmt">
          </input>
          </div>
        </div>
        
      </form>
      </div>
 </div>
 