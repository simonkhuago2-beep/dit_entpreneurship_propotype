<?php
	ob_start();
	include '../cctech-admin/core/init.php';
	$id = Input::get('optionName');
	if ($id == 'Daily Rentals') { ?>
		<div class="col-lg-4 col-md-6 col-sm-6 no-padding-left xs-no-padding">
                                                    <div class="form-group no-margin-bottom">
                                                        <label class="text-uppercase white-text">Pick-Up</label>
                                                        <div class="select-style no-border no-margin-top margin-eight">
                                                            <select name="tpick" required="required">
                                                                <option value="">Any</option>
                                                                <?php $point_pick = DB::getInstance()->query("SELECT DISTINCT pick_up FROM transfers WHERE cat = 'daily rentals'"); 
                                                                    foreach($point_pick->results() as $key => $value): ?>
                                                                    <option value="<?php echo $value->pick_up ?>"><?php echo $value->pick_up ?></option>
                                                                <?php endforeach ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-6 no-padding-left xs-no-padding">
                                                    <div class="form-group no-margin-bottom">
                                                        <label class="text-uppercase white-text">Drop-off</label>
                                                        <div class="select-style no-border no-margin-top margin-eight">
                                                            <select name="tdrop" required="required">
                                                                <option value="">Any</option>
                                                                 <?php $point_pick = DB::getInstance()->query("SELECT DISTINCT drop_off FROM transfers WHERE cat = 'daily rentals'"); 
                                                                    foreach($point_pick->results() as $key => $value): ?>
                                                                    <option value="<?php echo $value->drop_off ?>"><?php echo $value->drop_off ?></option>
                                                                <?php endforeach ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
<?php
	}elseif($id == 'Point to Point'){ ?>
		<div class="col-lg-4 col-md-6 col-sm-6 no-padding-left xs-no-padding">
                                                    <div class="form-group no-margin-bottom">
                                                        <label class="text-uppercase white-text">Pick-Up</label>
                                                        <div class="select-style no-border no-margin-top margin-eight">
                                                            <select name="tpick" required="required">
                                                                <option value="">Any</option>
                                                                <?php $point_pick = DB::getInstance()->query("SELECT DISTINCT pick_up FROM transfers WHERE cat = 'point to point'"); 
                                                                    foreach($point_pick->results() as $key => $value): ?>
                                                                    <option value="<?php echo $value->pick_up ?>"><?php echo $value->pick_up ?></option>
                                                                <?php endforeach ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-6 no-padding-left xs-no-padding">
                                                    <div class="form-group no-margin-bottom">
                                                        <label class="text-uppercase white-text">Drop-off</label>
                                                        <div class="select-style no-border no-margin-top margin-eight">
                                                            <select name="tdrop" required="required">
                                                                <option value="">Any</option>
                                                                 <?php $point_pick = DB::getInstance()->query("SELECT DISTINCT drop_off FROM transfers WHERE cat = 'point to point'"); 
                                                                    foreach($point_pick->results() as $key => $value): ?>
                                                                    <option value="<?php echo $value->drop_off ?>"><?php echo $value->drop_off ?></option>
                                                                <?php endforeach ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
<?php 
	}

?>