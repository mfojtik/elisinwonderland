<?php
    $frmt=['-','970x250','970x90','728x90','468x60','336x280','320x100','320x50','300x1050','300x600','300x250','250x250','234x60','200x200','180x150','160x600','125x125','120x600','120x240','responsive'];
	$ra1 = get_option('BegnAds');
	$ra2 = get_option('BegnRnd');
	$rm1 = get_option('MiddAds');
	$rm2 = get_option('MiddRnd');	
	$rb1 = get_option('EndiAds');
	$rb2 = get_option('EndiRnd');	
	$rr1 = get_option('MoreAds');
	$rr2 = get_option('MoreRnd');	
	$rp1 = get_option('LapaAds');
	$rp2 = get_option('LapaRnd');		
	$rc = 3;
	for ($j=1;$j<=$rc;$j++) {
		$rc1[$j] = get_option('Par'.$j.'Ads');	
		$rc2[$j] = get_option('Par'.$j.'Rnd');		
		$rc3[$j] = get_option('Par'.$j.'Nup');			
		$rc4[$j] = get_option('Par'.$j.'Con');			
	}	
	$rd1 = get_option('Img1Ads');	
	$rd2 = get_option('Img1Rnd');		
	$rd3 = get_option('Img1Nup');		
	$rd4 = get_option('Img1Con');			
	$aps = get_option('AppPost');
	$apg = get_option('AppPage');
	$ahm = get_option('AppHome');	
	$act = get_option('AppCate');
	$aar = get_option('AppArch');
	$atg = get_option('AppTags');
	$amx = get_option('AppMaxA');	
	$asd = get_option('AppSide');	
	$lgg = get_option('AppLogg');		
	$aqt = get_option('QckTags');
	$aqr = get_option('QckRnds');
	$aqf = get_option('QckOffs');
	$aqp = get_option('QckOfPs');
	$optionsupdate = '';
	foreach (speedsense::$Preselected as $key => $value) {
		$optionsupdate .= $key.',' ;
	}			
	foreach ($this->QData['DefaultAdsName'] as $key => $value) {
		$optionsupdate .= $value.',' ;
	}			
	$optionsupdate = substr($optionsupdate, 0, -1);
	function truefalse($arg) {
		if($arg){ return 'true';}else{ return 'false';}
	}			
?>
	
<script type="text/javascript">
<?php /*
	function defaultoptions() {
//		document.getElementById("DisTot<?php echo(speedsense::$Preselected['AdsDisp']) ?>").selected = true;
		document.getElementById("BegnAds").checked = <?php echo(truefalse(speedsense::$Preselected['BegnAds'])) ?>;
		document.getElementById("BegnRnd").selectedIndex = <?php echo(speedsense::$Preselected['BegnRnd']) ?>;
		document.getElementById("MiddAds").checked = <?php echo(truefalse(speedsense::$Preselected['MiddAds'])) ?>;
		document.getElementById("MiddRnd").selectedIndex = <?php echo(speedsense::$Preselected['MiddRnd']) ?>;		
		document.getElementById("EndiAds").checked = <?php echo(truefalse(speedsense::$Preselected['EndiAds'])) ?>;
		document.getElementById("EndiRnd").selectedIndex = <?php echo(speedsense::$Preselected['EndiRnd']) ?>;		
		document.getElementById("MoreAds").checked = <?php echo(truefalse(speedsense::$Preselected['MoreAds'])) ?>;
		document.getElementById("MoreRnd").selectedIndex = <?php echo(speedsense::$Preselected['MoreRnd']) ?>;
		document.getElementById("LapaAds").checked = <?php echo(truefalse(speedsense::$Preselected['LapaAds'])) ?>;
		document.getElementById("LapaRnd").selectedIndex = <?php echo(speedsense::$Preselected['LapaRnd']) ?>;			
		<?php for ($j=1;$j<=$rc;$j++) { ?>	
			document.getElementById("Par<?php echo $j; ?>Ads").checked = <?php echo(truefalse(speedsense::$Preselected['Par'.$j.'Ads'])) ?>;
			document.getElementById("Par<?php echo $j; ?>Rnd").selectedIndex = <?php echo(speedsense::$Preselected['Par'.$j.'Rnd']) ?>;		
			document.getElementById("Par<?php echo $j; ?>Nup").selectedIndex = <?php echo(speedsense::$Preselected['Par'.$j.'Nup']) ?>;			
			document.getElementById("Par<?php echo $j; ?>Con").checked = <?php echo(truefalse(speedsense::$Preselected['Par'.$j.'Con'])) ?>;	
		<?php } ?>
		document.getElementById("Img1Ads").checked = <?php echo(truefalse(speedsense::$Preselected['Img1Ads'])) ?>;
		document.getElementById("Img1Rnd").selectedIndex = <?php echo(speedsense::$Preselected['Img1Rnd']) ?>;		
		document.getElementById("Img1Nup").selectedIndex = <?php echo(speedsense::$Preselected['Img1Nup']) ?>;	
		document.getElementById("Img1Con").checked = <?php echo(truefalse(speedsense::$Preselected['Img1Con'])) ?>;		
		document.getElementById("AppHome").checked = <?php echo(truefalse(speedsense::$Preselected['AppHome'])) ?>;
		document.getElementById("AppPost").checked = <?php echo(truefalse(speedsense::$Preselected['AppPost'])) ?>;
		document.getElementById("AppPage").checked = <?php echo(truefalse(speedsense::$Preselected['AppPage'])) ?>;
		document.getElementById("AppCate").checked = <?php echo(truefalse(speedsense::$Preselected['AppCate'])) ?>;
		document.getElementById("AppArch").checked = <?php echo(truefalse(speedsense::$Preselected['AppArch'])) ?>;
		document.getElementById("AppTags").checked = <?php echo(truefalse(speedsense::$Preselected['AppTags'])) ?>;
		document.getElementById("AppMaxA").checked = <?php echo(truefalse(speedsense::$Preselected['AppMaxA'])) ?>;		
		document.getElementById("AppSide").checked = <?php echo(truefalse(speedsense::$Preselected['AppSide'])) ?>;		
		document.getElementById("AppLogg").checked = <?php echo(truefalse(speedsense::$Preselected['AppLogg'])) ?>;		
		document.getElementById("QckTags").checked = <?php echo(truefalse(speedsense::$Preselected['QckTags'])) ?>;
		document.getElementById("QckRnds").checked = <?php echo(truefalse(speedsense::$Preselected['QckRnds'])) ?>;
		document.getElementById("QckOffs").checked = <?php echo(truefalse(speedsense::$Preselected['QckOffs'])) ?>;		
		document.getElementById("QckOfPs").checked = <?php echo(truefalse(speedsense::$Preselected['QckOfPs'])) ?>;		
		for(i=1;i<=<?php echo(speedsense::$Ads) ?>;i++){
			tp=document.getElementById("AdsCode"+i.toString()).innerHTML;
			if(tp==''){
				document.getElementById("AdsMargin"+i.toString()).value = "<?php echo($this->QData['DefaultAdsOpt']['AdsMargin']) ?>";
				document.getElementById("OptAgn"+i.toString()+"<?php echo($this->QData['DefaultAdsOpt']['AdsAlign']) ?>").selected = true;
			}
		}		
		deftcheckinfo();
	}
*/ ?>
	function selectinfo(ts) {
		if (ts.selectedIndex == 0) { return; }
		cek = new Array(
			document.getElementById('BegnRnd'),
			document.getElementById('MiddRnd'),
			document.getElementById('EndiRnd'),
			document.getElementById('MoreRnd'),
			document.getElementById('LapaRnd'),				
			document.getElementById('Par1Rnd'),
			document.getElementById('Par2Rnd'),
			document.getElementById('Par3Rnd'),
			document.getElementById('Img1Rnd') );
		for (i=0;i<cek.length;i++) {
			if (ts != cek[i] && ts.selectedIndex == cek[i].selectedIndex) {
				cek[i].selectedIndex = 0;
			}
		}
	}
	function selectmultipleformat() {
        var ts=jQuery('#multiple_format');
		if (ts.val() == 'responsive') {
            jQuery('#multiple_responsive_section').show();
        }else{
            jQuery('#multiple_responsive_section').hide();
        }
	}
	function showhidemultiplepost() {
		if ((jQuery('#AppHome').is(':checked')) || (jQuery('#AppCate').is(':checked')) || (jQuery('#AppArch').is(':checked')) || (jQuery('#AppTags').is(':checked'))) {
            jQuery('#multipletab').show();
        }else{
            jQuery('#multipletab').hide();
        }
	}
	function showhidesinglepost() {
		if ((jQuery('#AppPost').is(':checked')) || (jQuery('#AppPage').is(':checked')) ) {
            jQuery('#singletab').show();
        }else{
            jQuery('#singletab').hide();
        }
	}
	function selectsingleformat(n) {
        var ts=jQuery('#AdsFrmt'+n);
		if (ts.val() == 'responsive') {
            jQuery('#single_responsive_section'+n).show();
        }else{
            jQuery('#single_responsive_section'+n).hide();
        }
	}
	function checkinfo1(selnme,ts) {
		document.getElementById(selnme).disabled=!ts.checked;
	}
	function checkinfo2(ts,selnm1,selnm2,selnm3,selnm4) {
		if(selnm1){document.getElementById(selnm1).disabled=!ts.checked};
		if(selnm2){document.getElementById(selnm2).disabled=!ts.checked};		
		if(selnm3){document.getElementById(selnm3).disabled=!ts.checked};		
	}	
	function deftcheckinfo() {
		checkinfo1('BegnRnd',document.getElementById('BegnAds'));
		checkinfo1('MiddRnd',document.getElementById('MiddAds'));
		checkinfo1('EndiRnd',document.getElementById('EndiAds'));
		checkinfo1('MoreRnd',document.getElementById('MoreAds'));
		checkinfo1('LapaRnd',document.getElementById('LapaAds'));		
		for (i=1;i<=3;i++) {
			checkinfo2(document.getElementById('Par'+i+'Ads'),'Par'+i+'Rnd','Par'+i+'Nup','Par'+i+'Con');		
		}	
		checkinfo2(document.getElementById('Img1Ads'),'Img1Rnd','Img1Nup','Img1Con');				
	}	
</script>

<div class="adminpage" style="background-color: inherit;">
<h2>Speed Sense <?php _e('Settings'); ?> <span style="font-size:9pt;font-style:italic">( Version <?php echo($this->QData['Version']) ?> )</span></h2>

<form method="post" id="config-form" action="options.php">
<div class="wrap" data-ng-app="dynamic-grid">

  <!-- Nav tabs -->
  <ul class="nav nav-pills" role="tablist">
    <li role="presentation"><a id="tab_general" href="#general" aria-controls="home" role="tab" data-toggle="tab">General</a></li>
    <li role="presentation" id="multipletab"><a href="#multiple" aria-controls="multiple" role="tab" data-toggle="tab">Multiple Posts</a></li>
    <li role="presentation" id="singletab"><a href="#single" aria-controls="single" role="tab" data-toggle="tab">Single Post</a></li>
<!--
    <li role="presentation"><a href="#widget" aria-controls="widget" role="tab" data-toggle="tab">Widget</a></li>
-->
    <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Other Settings</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">


      
    <div role="tabpanel" class="tab-pane active" id="general">
        <input type="hidden" name="AdsDisp" value="3" />
	<?php 
		$gen_id = htmlentities(get_option('gen_id')); 
		$gen_dataslot = htmlentities(get_option('gen_dataslot'));
        $multiple_position = htmlentities(get_option('multiple_position'));
        $multiple_align = htmlentities(get_option('multiple_align'));
        $multiple_margin = htmlentities(get_option('multiple_margin'));
        $multiple_format = htmlentities(get_option('multiple_format'));
		$multiple_responsive = htmlentities(get_option('multiple_responsive'));
	?>	
        <br>
                <div class="input-group control-group">
                    <span class="input-group-addon" id="basic-addon1">Adsense Publisher ID</span>
                    <input type="number" class="form-control" name="gen_id" id="gen_id" placeholder="Only Numbers" aria-describedby="basic-addon1" value = "<?php echo $gen_id; ?>">
                    <span class="input-group-addon" for="name">
                        <a target="_blank" href="//support.google.com/adsense/answer/105516">Help</a>
                    </span>
                </div>
        <br>
                <div class="input-group control-group">
                    <span class="input-group-addon" for="name">Adsense Data Ad Slot</span>
                    <input type="number" class="form-control" name="gen_dataslot" id="gen_dataslot" placeholder="Only Numbers" value = "<?php echo $gen_dataslot; ?>">
                    <span class="input-group-addon" for="name">
                        <a target="_blank" href="//support.google.com/adsense/answer/3221666">Help</a>
                    </span>
                </div>

        
        
        <br>
        <h3><?php _e('Show'); ?>:</h3>
                <div class="input-group">
                        <span>[ </span>
                            <input type="checkbox" onchange="showhidesinglepost()" id="AppPost" name="AppPost" value="true" <?php if($aps){echo('checked');} ?> /> <?php _e('Posts'); ?>
                            <input type="checkbox" onchange="showhidesinglepost()" id="AppPage" name="AppPage" value="true" <?php if($apg){echo('checked');} ?> /> <?php _e('Pages'); ?><span> ]</span><br/>
                </div>
                <br>
                <div class="input-group">
                        <span>[ </span>
                            <input type="checkbox" onchange="showhidemultiplepost()" id="AppHome" name="AppHome" value="true" <?php if($ahm){echo('checked');} ?> /> <?php _e('Homepage'); ?>				
                            <input type="checkbox" onchange="showhidemultiplepost()" id="AppCate" name="AppCate" value="true" <?php if($act){echo('checked');} ?> /> <?php _e('Categories'); ?>
                            <input type="checkbox" onchange="showhidemultiplepost()" id="AppArch" name="AppArch" value="true" <?php if($aar){echo('checked');} ?> /> <?php _e('Archives'); ?>
                            <input type="checkbox" onchange="showhidemultiplepost()" id="AppTags" name="AppTags" value="true" <?php if($atg){echo('checked');} ?> /> <?php _e('Tags'); ?><span> ]
                </div>
<!--
                <br>
                <div class="input-group">
                        <span>[ </span>
                            <input type="checkbox" id="AppSide" name="AppSide" value="true" <?php if($asd){echo('checked');} ?> /> <?php _e('Disable AdsWidget on Homepage'); ?><span> ]</span><br/>
                </div>
-->
                <br>
                <div class="input-group">
                        <span>[ </span>				
                            <input type="checkbox" id="AppLogg" name="AppLogg" value="true" <?php if($lgg){echo('checked');} ?> /> <?php _e('Hide ads on my PC (protection against accidental clicks)'); ?><span> ]</span><br/>
                        <br/>
                </div>
        
        
        
        
<!--
        <br>
    	<p style="margin-top:20px">( <a href="javascript:defaultoptions()"><?php _e('Load Default Setting') ?></a> )<br/><br/></p>
-->
    </div>















    
    <div role="tabpanel" class="tab-pane" id="single">
        <br>
        <div class="input-group">
				<input type="checkbox" id="BegnAds" name="BegnAds" value="true" <?php if($ra1){echo('checked');} ?> onchange="checkinfo1('BegnRnd',this)" /> <?php _e('Assign') ; ?> <select id="BegnRnd" name="BegnRnd" onchange="selectinfo(this)">
					<?php for ($i=0;$i<=speedsense::$Ads;$i++) { ?>
						<option id="OptBegn<?php echo $i; ?>" value="<?php echo $i; ?>" <?php if($ra2==(string)$i){echo('selected');} ?>><?php _e(($i==0)?'Random Ads':'Ads'.$i) ; ?></option>
					<?php } ?></select> <?php _e('to <b>Beginning of Post</b>') ?><br/>
        </div>
        <br>
        <div class="input-group">
				<input type="checkbox" id="MiddAds" name="MiddAds" value="false" <?php if($rm1){echo('checked');} ?> onchange="checkinfo1('MiddRnd',this)" /> <?php _e('Assign') ; ?> <select id="MiddRnd" name="MiddRnd" onchange="selectinfo(this)">
					<?php for ($i=0;$i<=speedsense::$Ads;$i++) { ?>
						<option id="OptMidd<?php echo $i; ?>" value="<?php echo $i; ?>" <?php if($rm2==(string)$i){echo('selected');} ?>><?php _e(($i==0)?'Random Ads':'Ads'.$i) ; ?></option>
					<?php } ?></select> <?php _e('to <b>Middle of Post</b>') ?><br/>					
        </div>
        <br>
        <div class="input-group">
				<input type="checkbox" id="EndiAds" name="EndiAds" value="false" <?php if($rb1){echo('checked');} ?> onchange="checkinfo1('EndiRnd',this)" /> <?php _e('Assign') ; ?> <select id="EndiRnd" name="EndiRnd" onchange="selectinfo(this)">
					<?php for ($i=0;$i<=speedsense::$Ads;$i++) { ?>
						<option id="OptEndi<?php echo $i; ?>" value="<?php echo $i; ?>" <?php if($rb2==(string)$i){echo('selected');} ?>><?php _e(($i==0)?'Random Ads':'Ads'.$i) ; ?></option>
					<?php } ?></select> <?php _e('to <b>End of Post</b>') ?><br/> 
        </div>
        <br>
        <div class="input-group">
				<input type="checkbox" id="MoreAds" name="MoreAds" value="false" <?php if($rr1){echo('checked');} ?> onchange="checkinfo1('MoreRnd',this)" /> <?php _e('Assign') ; ?> <select id="MoreRnd" name="MoreRnd" onchange="selectinfo(this)">
					<?php for ($i=0;$i<=speedsense::$Ads;$i++) { ?>
						<option id="OptMore<?php echo $i; ?>" value="<?php echo $i; ?>" <?php if($rr2==(string)$i){echo('selected');} ?>><?php _e(($i==0)?'Random Ads':'Ads'.$i) ; ?></option>
					<?php } ?></select> <?php _e('right after <b>the') ?> <span style="font-family:Courier New,Courier,Fixed;">&lt;!--more--&gt;</span> <?php _e('tag') ?></b><br/> 					
        </div>
        <br>
        <div class="input-group">
				<input type="checkbox" id="LapaAds" name="LapaAds" value="false" <?php if($rp1){echo('checked');} ?> onchange="checkinfo1('LapaRnd',this)" /> <?php _e('Assign') ; ?> <select id="LapaRnd" name="LapaRnd" onchange="selectinfo(this)">
					<?php for ($i=0;$i<=speedsense::$Ads;$i++) { ?>
						<option id="OptLapa<?php echo $i; ?>" value="<?php echo $i; ?>" <?php if($rp2==(string)$i){echo('selected');} ?>><?php _e(($i==0)?'Random Ads':'Ads'.$i) ; ?></option>
					<?php } ?></select> <?php _e('right before <b>the last Paragraph</b>') ?><span style="color:#a00;"> <b>(New)</b></span><br/> 
				<?php for ($j=1;$j<=$rc;$j++) { ?>	
        </div>
        <br>
        <div class="input-group">
					<input type="checkbox" id="Par<?php echo $j; ?>Ads" name="Par<?php echo $j; ?>Ads" value="false" <?php if($rc1[$j]){echo('checked');} ?> onchange="checkinfo2(this,'Par<?php echo $j; ?>Rnd','Par<?php echo $j; ?>Nup','Par<?php echo $j; ?>Con')" /> <?php _e('Assign') ; ?> <select id="Par<?php echo $j; ?>Rnd" name="Par<?php echo $j; ?>Rnd" onchange="selectinfo(this)">
						<?php for ($i=0;$i<=speedsense::$Ads;$i++) { ?>
							<option id="OptPar<?php echo $j; ?><?php echo $i; ?>" value="<?php echo $i; ?>" <?php if($rc2[$j]==(string)$i){echo('selected');} ?>><?php _e(($i==0)?'Random Ads':'Ads'.$i) ; ?></option>
						<?php } ?></select> <?php _e('<b>After Paragraph</b> ') ?> <select id="Par<?php echo $j; ?>Nup" name="Par<?php echo $j; ?>Nup">
							<?php for ($i=1;$i<=50;$i++) { ?>
								<option id="Opt<?php echo $j; ?>Nu<?php echo $i; ?>" value="<?php echo $i; ?>" <?php if($rc3[$j]==(string)$i){echo('selected');} ?>><?php echo $i; ?></option>
							<?php } ?></select> &rarr; 
							<input type="checkbox" id="Par<?php echo $j; ?>Con" name="Par<?php echo $j; ?>Con" value="false" <?php if($rc4[$j]){echo('checked');} ?> /> <?php _e('to <b>End of Post</b> if fewer paragraphs are found.') ; ?><br/>
				<?php } ?>
        </div>
        <br>
        <div class="input-group">
				<input type="checkbox" id="Img1Ads" name="Img1Ads" value="false" <?php if($rd1){echo('checked');} ?> onchange="checkinfo2(this,'Img1Rnd','Img1Nup','Img1Con')" /> <?php _e('Assign') ; ?> <select id="Img1Rnd" name="Img1Rnd" onchange="selectinfo(this)">
					<?php for ($i=0;$i<=speedsense::$Ads;$i++) { ?>
						<option id="OptImg1<?php echo $i; ?>" value="<?php echo $i; ?>" <?php if($rd2==(string)$i){echo('selected');} ?>><?php _e(($i==0)?'Random Ads':'Ads'.$i) ; ?></option>
					<?php } ?></select> <?php _e('<b>After Image</b> ') ?> <select id="Img1Nup" name="Img1Nup">
						<?php for ($i=1;$i<=50;$i++) { ?>
							<option id="Opt1Im<?php echo $i; ?>" value="<?php echo $i; ?>" <?php if($rd3==(string)$i){echo('selected');} ?>><?php echo $i; ?></option>
						<?php } ?></select> &rarr; 
						<input type="checkbox" id="Img1Con" name="Img1Con" value="false" <?php if($rd4){echo('checked');} ?> /> <?php _e('after <b>Image&#39;s outer</b>'); ?><b><span style="font-family:Courier New,Courier,Fixed;"> &lt;div&gt; wp-caption</span></b> if any.<span style="color:#a00;"> <b>(New)</b></span><br/>
        </div>
				<br/>
				<script type="text/javascript">deftcheckinfo();</script>


        <h3>Ads</h3>
        <hr/>
        <div class="col-xs-1" style="width: 100px;"> <!-- required for floating -->
          <!-- Nav tabs -->
          <ul class="nav nav-tabs tabs-left">


<?php for ($i=1;$i<=speedsense::$Ads;$i++) {
    if($i==1){
?>
            <li class="active">
<?php   
    }else{
?>
            <li>
<?php   
    }
?>
                <a href="#sads<?php echo $i; ?>" data-toggle="tab">Ads<?php echo $i; ?></a></li>
<?php } ?>
          </ul>
        </div>

        <div style="width: calc(100% - 120px); float: left;">
<!--
        <div class="col-xs-9">
          <!-- Tab panes -->
          <div class="tab-content">
              
              
              
            
            
        <?php for ($i=1;$i<=speedsense::$Ads;$i++) {
            $cod = htmlentities(get_option('AdsCode'.$i)); 
            $agn = get_option('AdsAlign'.$i);
            $fmt = get_option('AdsFrmt'.$i);
            $mar = get_option('AdsMargin'.$i);
            $optionsupdate .= ',AdsCode'.$i.',AdsAlign'.$i.',AdsFrmt'.$i.',AdsMargin'.$i;
            if($i==1){
?>
            <div class="tab-pane active" id="sads<?php echo $i; ?>">
<?php   
            }else{
?>
            <div class="tab-pane" id="sads<?php echo $i; ?>">
<?php   
            }
?>
                <br>
                <div class="row">
                    <div class="col-md-1">
                        <label for="margin_leadin"><?php _e('Margin') ?>:</label><br>
                        <input type="number" style="width: 60px;" id="AdsMargin<?php echo $i; ?>" name="AdsMargin<?php echo $i; ?>" value="<?php echo stripslashes(htmlspecialchars($mar)); ?>">
                    </div>
                    <div class="col-md-2">
                        <label for="margin_leadin"><?php _e('Align') ?>:</label><br/>
                        <select name="AdsAlign<?php echo $i; ?>">
                            <option id="OptAgn<?php echo $i; ?>1" value="1" <?php if($agn=="1"){echo('selected');} ?>><?php _e('Left') ; ?></option>
                            <option id="OptAgn<?php echo $i; ?>2" value="2" <?php if($agn=="2"){echo('selected');} ?>><?php _e('Center') ; ?></option>
                            <option id="OptAgn<?php echo $i; ?>3" value="3" <?php if($agn=="3"){echo('selected');} ?>><?php _e('Right') ; ?></option>
                            <option id="OptAgn<?php echo $i; ?>4" value="4" <?php if($agn=="4"){echo('selected');} ?>><?php _e('None') ; ?></option>
                            <option id="OptAgn<?php echo $i; ?>5" value="5" <?php if($agn=="5"){echo('selected');} ?>><?php _e('Left, separated') ; ?></option>
                            <option id="OptAgn<?php echo $i; ?>6" value="6" <?php if($agn=="6"){echo('selected');} ?>><?php _e('Right, separated') ; ?></option>
                        </select>        
                    </div>
                    <div class="col-md-2">
                        <label for="margin_leadin"><?php _e('Format') ?>:</label>
                        <select id="AdsFrmt<?php echo $i; ?>" name="AdsFrmt<?php echo $i; ?>" class="form-control" onchange="selectsingleformat(<?php echo $i; ?>)">
                        <?php
                        for ($ii=0;$ii<count($frmt);$ii++) {
                            if($fmt==$frmt[$ii]){
                                echo('<option value="' . $frmt[$ii] . '" selected>' . $frmt[$ii] . '</option>');
                            }else{
                                echo('<option value="' . $frmt[$ii] . '">' . $frmt[$ii] . '</option>');
                            }
                        }
                        ?>
                        </select>
                    </div>
                </div>
                <br />
            
                <div id="single_responsive_section<?php echo $i; ?>">
                    <h3 class="label-primary" style="color:white;border-radius: 2px;text-align: center;"><?php _e('Ad Responsive Settings'); ?></h3>
                    <div class="dyn_resp">
                        <div data-dynamic-grid="AdsCode<?php echo $i; ?>" data-grid-value='<?php echo $cod; ?>'></div>
                    </div>
                </div>
            </div>
        <?php } ?>	
            
          </div>
        </div>

        <div class="clearfix"></div>


        
    </div>















    
    <div role="tabpanel" class="tab-pane" id="multiple">
        <br>
        <div class="row">
            <div class="col-md-3">
                <label for="margin_leadin"><?php _e('Position') ?>:</label>
                <select id="multiple_position" name="multiple_position" class="form-control">
                <?php
                $opt=["top"=>"At the beginning of each post","middle"=>"In the middle of each post","bottom"=>"At the end of each post"];
                foreach ($opt as $key => $value){
                    if($multiple_position==$key){
                        echo('<option value="' . $key . '" selected>' . __($value) . '</option>');
                    }else{
                        echo('<option value="' . $key . '">' . __($value) . '</option>');
                    }
                }
                ?>
                </select>
                
                        
            </div>







<?php
$i=0;
            $cod = htmlentities(get_option('AdsCode'.$i)); 
            $agn = get_option('AdsAlign'.$i);
            $fmt = get_option('AdsFrmt'.$i);
            $mar = get_option('AdsMargin'.$i);
            $optionsupdate .= ',AdsCode'.$i.',AdsAlign'.$i.',AdsFrmt'.$i.',AdsMargin'.$i;
?>
<!--
                <div class="row">
-->
                    <div class="col-md-1">
                        <label for="margin_leadin"><?php _e('Margin') ?>:</label><br>
                        <input type="number" style="width: 60px;" id="AdsMargin<?php echo $i; ?>" name="AdsMargin<?php echo $i; ?>" value="<?php echo stripslashes(htmlspecialchars($mar)); ?>">
                    </div>
                    <div class="col-md-2">
                        <label for="margin_leadin"><?php _e('Align') ?>:</label><br/>
                        <select name="AdsAlign<?php echo $i; ?>">
                            <option id="OptAgn<?php echo $i; ?>1" value="1" <?php if($agn=="1"){echo('selected');} ?>><?php _e('Left') ; ?></option>
                            <option id="OptAgn<?php echo $i; ?>2" value="2" <?php if($agn=="2"){echo('selected');} ?>><?php _e('Center') ; ?></option>
                            <option id="OptAgn<?php echo $i; ?>3" value="3" <?php if($agn=="3"){echo('selected');} ?>><?php _e('Right') ; ?></option>
                            <option id="OptAgn<?php echo $i; ?>4" value="4" <?php if($agn=="4"){echo('selected');} ?>><?php _e('None') ; ?></option>
                            <option id="OptAgn<?php echo $i; ?>5" value="5" <?php if($agn=="5"){echo('selected');} ?>><?php _e('Left, separated') ; ?></option>
                            <option id="OptAgn<?php echo $i; ?>6" value="6" <?php if($agn=="6"){echo('selected');} ?>><?php _e('Right, separated') ; ?></option>
                        </select>        
                    </div>
                    <div class="col-md-2">
                        <label for="margin_leadin"><?php _e('Format') ?>:</label>
                        <select id="AdsFrmt<?php echo $i; ?>" name="AdsFrmt<?php echo $i; ?>" class="form-control" onchange="selectsingleformat(<?php echo $i; ?>)">
                        <?php
                        for ($ii=0;$ii<count($frmt);$ii++) {
                            if($fmt==$frmt[$ii]){
                                echo('<option value="' . $frmt[$ii] . '" selected>' . $frmt[$ii] . '</option>');
                            }else{
                                echo('<option value="' . $frmt[$ii] . '">' . $frmt[$ii] . '</option>');
                            }
                        }
                        ?>
                        </select>
                    </div>
                </div>
                <br />
            
                <div id="single_responsive_section<?php echo $i; ?>">
                    <h3 class="label-primary" style="color:white;border-radius: 2px;text-align: center;"><?php _e('Ad Responsive Settings'); ?></h3>
                    <div class="dyn_resp">
                        <div data-dynamic-grid="AdsCode<?php echo $i; ?>" data-grid-value='<?php echo $cod; ?>'></div>
                    </div>
                </div>










    </div>






    
    
<!--
    <div role="widget" class="tab-pane" id="widget">
        <h4><?php _e('Ads on Sidebar Widget '); ?><span style="font-weight:normal">(<a href="widgets.php"><?php _e('Drag to Sidebar'); ?></a>)</span> :</h4>	
        <table border="0" cellspacing="0" cellpadding="0">
        <?php for ($i=1;$i<=$this->QData['AdsWid'];$i++) { 
            $cod = htmlentities(get_option('WidCode'.$i)); 
            $optionsupdate .= ',WidCode'.$i;
        ?>	
        <tr valign="top">
            <td align="left" style="width:110px">AdsWidget<?php echo $i; ?> :</td>
            <td align="left"><textarea style="margin:0 5px 3px 0" id="WidCode<?php echo $i; ?>" name="WidCode<?php echo $i; ?>" rows="3" cols="50"><?php echo $cod; ?></textarea></td>
        </tr>
        <?php } ?>	
        </table>
    </div>
-->




    
    
    
    <div role="tabpanel" class="tab-pane" id="settings">
        <table border="0" cellspacing="0" cellpadding="0">
        <tr valign="top">
            <td style="width:110px"><?php _e('Quicktag :'); ?></td>
            <td><span style="display:block;font-style:normal;padding-bottom:0px"><?php _e('Insert Ads into a post, on-the-fly :'); ?></span>
                    <ol style="margin-top:5px;">
                    <li><?php _e('Insert <span style="font-family:Courier New,Courier,Fixed;color:#050">&lt;!--Ads1--&gt;</span>, <span style="font-family:Courier New,Courier,Fixed;color:#050">&lt;!--Ads2--&gt;</span>, etc. into a post to show the <b>Particular Ads</b> at specific location.'); ?></li>
                    <li><?php _e('Insert <span style="font-family:Courier New,Courier,Fixed;color:#050">&lt;!--RndAds--&gt;</span> (or more) into a post to show the <b>Random Ads</b> at specific location.'); ?></li>
                    </ol>
                    <span style="display:block;font-style:normal;padding-bottom:0px"><?php _e('Disable Ads in a post, on-the-fly :'); ?></span>
                    <ol style="margin-top:5px;">				
                    <li><?php _e('Insert <span style="font-family:Courier New,Courier,Fixed;color:#050">&lt;!--NoAds--&gt;</span> to <b>disable all Ads</b> in a post.'); ?><span class="description" style="font-style:italic"><?php _e(' (does not affect Ads on Sidebar)'); ?></span></li>				
                    <li><?php _e('Insert <span style="font-family:Courier New,Courier,Fixed;color:#050">&lt;!--OffDef--&gt;</span> to <b>disable the default positioned Ads</b>, and use <span style="font-family:Courier New,Courier,Fixed;">&lt;!--Ads1--&gt;</span>, <span style="font-family:Courier New,Courier,Fixed;">&lt;!--Ads2--&gt;</span>, etc. to insert Ads.'); ?><span class="description" style="font-style:italic"><?php _e(' (does not affect Ads on Sidebar)'); ?></span></li>								
                    <li><?php _e('Insert <span style="font-family:Courier New,Courier,Fixed;color:#050">&lt;!--OffWidget--&gt;</span> to <b>disable all Ads on Sidebar</b>.'); ?><span style="color:#a00;"> <b>(New)</b></span></li>								
                    <li><?php _e('Insert <span style="font-family:Courier New,Courier,Fixed;color:#050">&lt;!--OffBegin--&gt;</span>, <span style="font-family:Courier New,Courier,Fixed;color:#050">&lt;!--OffMiddle--&gt;</span>, <span style="font-family:Courier New,Courier,Fixed;color:#050">&lt;!--OffEnd--&gt;</span> to <b>disable Ads at Beginning, Middle</b> or <b>End of Post</b>.'); ?><span style="color:#a00;"> <b>(New)</b></span></li>								
                    <li><?php _e('Insert <span style="font-family:Courier New,Courier,Fixed;color:#050">&lt;!--OffAfMore--&gt;</span>, <span style="font-family:Courier New,Courier,Fixed;color:#050">&lt;!--OffBfLastPara--&gt;</span> to <b>disable Ads right after the <span style="font-family:Courier New,Courier,Fixed;">&lt;!--more--&gt;</span> tag</b>, or <b>right before the last Paragraph</b>.'); ?><span style="color:#a00;"> <b>(New)</b></span></li>												
                    </ol>
                    [ <input type="checkbox" id="QckTags" name="QckTags" value="true" <?php if($aqt){echo('checked');} ?> /> <?php _e('Show Quicktag Buttons on the HTML Edit Post SubPanel'); ?> ]<br/>
                    [ <input type="checkbox" id="QckRnds" name="QckRnds" value="true" <?php if($aqr){echo('checked');} ?> /> <?php _e('Hide <span style="font-family:Courier New,Courier,Fixed;color:#050">&lt;!--RndAds--&gt;</span> from Quicktag Buttons'); ?> ]<br/>	
                    [ <input type="checkbox" id="QckOffs" name="QckOffs" value="true" <?php if($aqf){echo('checked');} ?> /> <?php _e('Hide <span style="font-family:Courier New,Courier,Fixed;color:#050">&lt;!--NoAds--&gt;</span>, <span style="font-family:Courier New,Courier,Fixed;color:#050">&lt;!--OffDef--&gt;</span>, <span style="font-family:Courier New,Courier,Fixed;color:#050">&lt;!--OffWidget--&gt;</span> from Quicktag Buttons'); ?> ]<br/>								
                    [ <input type="checkbox" id="QckOfPs" name="QckOfPs" value="true" <?php if($aqp){echo('checked');} ?> /> <?php _e('Hide <span style="font-family:Courier New,Courier,Fixed;color:#050">&lt;!--OffBegin--&gt;</span>, <span style="font-family:Courier New,Courier,Fixed;color:#050">&lt;!--OffMiddle--&gt;</span>, <span style="font-family:Courier New,Courier,Fixed;color:#050">&lt;!--OffEnd--&gt;</span>, <span style="font-family:Courier New,Courier,Fixed;color:#050">&lt;!--OffAfMore--&gt;</span>, <span style="font-family:Courier New,Courier,Fixed;color:#050">&lt;!--OffBfLastPara--&gt;</span> from Quicktag Buttons'); ?> ]<br/>								
                    <span class="description" style="display:block;font-style:italic;padding-top:10px"><?php _e('Tags can be inserted into a post via the additional Quicktag Buttons at the HTML Edit Post SubPanel.'); ?></span><br/>
            </td>
        </tr>
        <tr valign="top">
            <td style="width:110px"><?php _e('Infomation :'); ?></td>
            <td>
                <span><?php echo(__(
                    'A link from your blog to <a href="https://wordpress.org/plugins/speed-sense/" target="_blank">http://wordpress.org/extend/plugins/speed-sense/</a> would be appreciated.'
                )); ?></span>
            </td>	
        </tr>
        </table>
    </div>
    
    
    
    
    
    
    
  </div>

</div>









<script>
jQuery(document).ready(function () {
    
    jQuery('#config-form').validate({
        rules: {
            gen_id: {
                minlength: 16,
                maxlength: 16,
                required: true
            },
            gen_dataslot: {
                minlength: 10,
                maxlength: 10,
                required: true
            }
        },
        highlight: function (element) {
            jQuery(element).closest('.control-group').removeClass('success').addClass('error');
        },
        success: function (element) {
            element.text('').addClass('valid')
                .closest('.control-group').removeClass('error').addClass('success');
        }
    });
    
    //Quando cambiano tab
    jQuery('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        selectmultipleformat();
        <?php for ($i=0;$i<=speedsense::$Ads;$i++) {
        echo 'selectsingleformat('.$i.');';
        }?>
        showhidemultiplepost();
        showhidesinglepost();
    });    
    
    jQuery('#tab_general').click();
    
});

</script>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
	






	<input type="hidden" name="action" value="update" />
	<?php settings_fields('ss-options'); //settings group name ?>
	<div style="width:580px">

	<p class="submit">
		<input class="btn btn-primary" type="submit" value="<?php _e('Save Changes') ?>"  onclick="jQuery('#tab_general').click(); return true;" />
	</p>
	</div>

</form>

</div>