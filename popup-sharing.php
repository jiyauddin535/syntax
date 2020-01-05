<!--== sharing a charing ==-->
<?php 
			$shq = "select * from user_sharing_data where postId='$post_id' and (type='whatsapp' or type='facebook' or type='twitter' or type='linkedin' or type='pinterest' or type='other')";
			$shr = $user->getResult($shq);
		?>
<div class="col-md-12 col-sm-12 col-xs-12  m-pl-3 m-pr-3 p-4 Sharing-a-caring text-left" id = "sharingCaringPopup">
	<div class="col-md-12 col-sm-12 col-xs-12  mt p-0">
		<div class="col-md-6 col-sm-6 col-xs-6 m-p-0"><p class="text-grey head-ing font-size-18">Sharing a Caring</p></div>
		<div class="col-md-5 col-sm-5 col-xs-5 "><p class="text-info pull-right head-ing font-size-18"><?php echo count($shr); ?> Shares</p></div>
		<div class="col-md-1 col-sm-1 col-xs-1 m-p-0"><button type="button" class="close" data-dismiss="modal">×</button></div>
	</div> 
	<div class="col-md-12 col-sm-12 col-xs-12  p-0 social-icon">
		<ul>
			<?php //echo $url_gm ;	?>
			<li><a onClick="engagedData('whatsapp');" class="whatsapp" title="Whatsapp" data-text="<?=urlencode($seo_title) ; ?>" data-link="<?=$url_gm ; ?>" ><img src="<?=$base_url ;?>images/social-icon/whts-app.png" class="wh-60"></a></li>
		<!-- 	<li><a onClick="window.open('http://www.facebook.com/sharer.php?s=<?=$url_gm ?>', 'sharer', 'toolbar=0,status=0,width=548,height=325'); engagedData('facebook');" title="Facebook" target="_parent" href="javascript: void(0)" ><img src="<?=$base_url ;?>images/social-icon/facebook.png" width="60"></a></li> -->

			<li><a onclick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?=urlencode($seo_title) ; ?>&amp;p[url]=<?=$url_gm ; ?>&amp;&amp;p[images][0]=<?=$base_url.$og_iamge ;?>', 'sharer', 'toolbar=0,status=0,width=548,height=325'); engagedData('facebook');" target="_parent" href="javascript: void(0)"><img src="<?=$base_url ;?>images/social-icon/facebook.png" class="wh-60"></a></li>

			<li><a onClick="window.open('http://twitter.com/share?text=<?=urlencode($seo_title) ?>&amp;url=<?=$url_gm ?>','toolbar=0,status=0,width=548,height=325'); engagedData('twitter');" title="Twitter" target="_parent" href="javascript: void(0)"><img src="<?=$base_url ;?>images/social-icon/twitter.png" class="wh-60"></a></li>
			
			<li><a href="javascript: void(0)" onClick="window.open('https://www.linkedin.com/shareArticle?mini=true&url=<?=$url_gm ?>','toolbar=0,status=0,width=548,height=325'); engagedData('linkedin');" target="_parent" title="linkedin"><img src="<?=$base_url ;?>images/social-icon/linked-in.png" class="wh-60"></a></li>
			<li><a target="blank" onclick="engagedData('other');" href="https://mail.google.com/mail/?view=cm&amp;fs=1&amp;su=<?=urlencode($seo_title); ?>%20|%20My%20SuperHumanRace%20&amp;body=Hello%20Dear,%0D%0A%0D%0A%20%20<?=urlencode($seo_desc) ;?>%0D%0A%0D%0A<?php echo $url_gm ; ?>" target="_top"><img src="<?=$base_url ;?>images/social-icon/messanger.png" title="GooglePlus" class="wh-60"></a></li>
			<!-- <li><a href="javascript: void(0)" onClick="window.open('http://pinterest.com/pin/create/bookmarklet/?url=<?=$url_gm ?>','toolbar=0,status=0,width=548,height=325'); engagedData('pinterest');" title="pinterest" target="_parent"><img src="images/social-icon/share.png" width="60"></a></li> -->
			<li><a onclick="engagedData('other');" href="#" title="Friends"><img src="<?=$base_url ;?>images/social-icon/friends.png" class="wh-60"></a></li>
		
			
		</ul>

	
	</div> 
</div><!--== end Sharing a charing ==-->



