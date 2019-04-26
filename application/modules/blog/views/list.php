<?php 

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Template			: 
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//print_r($results); exit;

?>
<div class="content-wrapper">
	<div class="container-fluid">
		<div class="card mb-3">
			<div class="card-header">
				<i class="fa fa-table"></i> <?=$subtitle;?>
			</div>
			<div class="card-body">
				<div class="row" style="padding-bottom:20px">
					<div class="col-md-3">					
						<button class="btn btn-success" value="login" type="submit" name="action" id="add">Add</button>
					</div>				
				</div>
				<ul>
				<?php
				if(count($results) > 0){
					for($i=0; $i < count($results['data']); $i++){
				?>
					<li>
						<span><?=$results['data'][$i]['messages']['data'][0]['created_time'];?></span>
						<figure><img src="//graph.facebook.com/<?=$results['data'][$i]['senders']['data'][0]['id'];?>/picture" alt=""></figure>
						<h4><a href="<?=base_url('facebook/messenger/edit');?>"><?=$results['data'][$i]['senders']['data'][0]['name'];?></a> <i class="unread">Unread</i></h4>
						<p>
						<?php
						if(empty($results['data'][$i]['messages']['data'][0]['message']) AND isset($results['data'][$i]['messages']['data'][0]['sticker'])){
							// user send sticker, thumb, emoji
							echo '<img src="'.$results['data'][$i]['messages']['data'][0]['sticker'].'" height=110>';

						} else if( empty($results['data'][$i]['messages']['data'][0]['message']) AND isset($results['data'][$i]['messages']['data'][0]['shares']) ){
							if(!isset($results['data'][$i]['messages']['data'][0]['shares']['data'][0]['link'])){
								// bot response 
								echo $results['data'][$i]['messages']['data'][0]['shares']['data'][0]['name'];
							} else {
							
								// user share location
								echo '<a href="'.$results['data'][$i]['messages']['data'][0]['shares']['data'][0]['link'].'" target="_blank">'.$results['data'][$i]['messages']['data'][0]['shares']['data'][0]['name'].'</a>';
							}
							
						} else if(isset($results['data'][$i]['messages']['data'][0]['shares'])){
							// user share link
							echo '<a href="'.$results['data'][$i]['messages']['data'][0]['shares']['data'][0]['link'].'" target="_blank">'.$results['data'][$i]['messages']['data'][0]['shares']['data'][0]['name'].'</a>';							
							
						} else if( empty($results['data'][$i]['messages']['data'][0]['message']) AND isset($results['data'][$i]['messages']['data'][0]['attachments']) ){						
							// user send attachments
							if($results['data'][$i]['messages']['data'][0]['attachments']['data'][0]['mime_type']=='image/gif' OR $results['data'][$i]['messages']['data'][0]['attachments']['data'][0]['mime_type']=='image/jpeg'){
								//user send image gif/jpeg
								echo '<img src="'.$results['data'][$i]['messages']['data'][0]['attachments']['data'][0]['image_data']['preview_url'].'" height=200>';
							} else if($results['data'][$i]['messages']['data'][0]['attachments']['data'][0]['mime_type']=='video/mp4'){
								//user send video
								$video 	= '<video controls>';
								$video .= '<source src="'.$results['data'][$i]['messages']['data'][0]['attachments']['data'][0]['video_data']['url'].'" type="video/mp4">Your browser does not support the video tag.</video>';
								
								echo $video;
							}

						} else {
							// default text message
							echo $results['data'][$i]['messages']['data'][0]['message'];
						} 
						?>
						</p>
					</li>
				<?php
					}
				} else {
				?>
					<li>
						<p> Tidak ada data</p>
					</li>
				<?php
				}
				?>
				</ul>
			</div>
		</div>
		<!-- /box_general-->
	</div>
</div>