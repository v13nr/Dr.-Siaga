<?php 

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Template			: 
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//print_r($listakseslevel); exit;
?>
<div class="content-wrapper">
	<div class="container-fluid">
		<div class="box_general padding_bottom">
			<div class="header_box version_2">
				<h2><i class="fa fa-user"></i><?=$subtitle." ".$group_info[0]['desc'];?></h2>
			</div>
			<form name="formcrud" method="POST" action="<?=$action?>" class="form-horizontal" role="form">
				<div class="row">
					<div class="table-responsive">
						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<td align="center">Class</td>
								<td align="center">Read</td>
								<td align="center">Add</td>
								<td align="center">Edit</td>
								<td align="center">Delete</td>
							</tr>
						</thead>	
						<tbody>
						<?php 
						foreach($listakseslevel as $val=>$key){ 
						?>
							<tr>
								<td><?=$key['rule_class'];?></td>
								<td align="center">
								<?php 
									if($key['rsindex']>0){ ?> 
									<input name="rule_id[]" id="rule_id" type="checkbox" value="<?=$key['rsindex'];?>"
								<?php 
										foreach($canread as $m=>$n){ 
											if($key['rsindex']==$n['rule_id']){ echo "checked"; } 
										}
								?> />					
								<?php
									}
								?>
								<?php //$key['rsindex'];?>
								</td>
								<td align="center">
								<?php 
									if($key['rsadd']>0){ ?> 
									<input name="rule_id[]" id="rule_id" type="checkbox" value="<?=$key['rsadd'];?>"
								<?php 
										foreach($canadd as $a=>$b){ 
											if($key['rsadd']==$b['rule_id']){ echo "checked"; } 
										}
								?> />
								<?php
									} else {
										echo "-"; //$key['rsadd'];
									}
								?>
								</td>
								<td align="center">
								<?php 
									if($key['rsedit']>0){ ?> 
									<input name="rule_id[]" id="rule_id" type="checkbox" value="<?=$key['rsedit'];?>"
								<?php 
										foreach($canedit as $a=>$b){ 
											if($key['rsedit']==$b['rule_id']){ echo "checked"; } 
										}
								?> />
								<?php
									} else {
										echo "-"; //$key['rsadd'];
									}
								?>
								</td>
								<td align="center">
								<?php 
									if($key['rsdelete']>0){ ?> 
									<input name="rule_id[]" id="rule_id" type="checkbox" value="<?=$key['rsdelete'];?>"
								<?php 
										foreach($candelete as $a=>$b){ 
											if($key['rsdelete']==$b['rule_id']){ echo "checked"; } 
										}
								?> />
								<?php
									} else {
										echo "-"; //$key['rsdelete'];
									}
								?>
								</td>
							</tr>
						<?php
						}
						?>						
						</tbody>
						<thead>
							<tr>
								<td align="center">Class</td>
								<td align="center">Read</td>
								<td align="center">Add</td>
								<td align="center">Edit</td>
								<td align="center">Delete</td>
							</tr>
						</thead>
						</table>
					</div>
				</div>
				<div class="row" style="padding-top:20px">
					<div class="col-md-8">
					<input type="submit" id="" value="Save" class="btn btn-inversed btn-primary">
					<a href="<?=base_url('grouprule');?>" class="btn btn-default btn-inversed btn-small" style="width:100px;height:38px;padding:8px">Cancel</a>
					</div>
				</div>
				<input type="hidden" name="button" value="Save">
				<input type="hidden" name="group_id" id="group_id" value="<?=$group_id;?>">
			</form>
		</div>
		<!-- /box_general-->
		
	</div>
	<!-- /.container-fluid-->
</div>
<!-- /.container-wrapper-->