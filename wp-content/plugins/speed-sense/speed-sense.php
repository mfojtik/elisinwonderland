<?php
/* 
	Plugin Name: Speed Sense for Adsense
	Plugin URI: http://wordpress.org/extend/plugins/speed-sense/
	Description: The easiest way to insert Google Adsense on your blog. Support themes standard, mobile and responsive.
	Author: Nathan Gruber
	Version: 1.9.6
	Author URI: https://wordpress.org/support/profile/nathangruber
*/
if (!class_exists("speedsense")) {
  class speedsense {
    public static $dir = 'speed-sense';
    public static $Preselected = [
            'AdsDisp'=>'3',
            'BegnAds'=>true,'BegnRnd'=>'1','EndiAds'=>true,'EndiRnd'=>'0','MiddAds'=>false,'MiddRnd'=>'0','MoreAds'=>false,'MoreRnd'=>'0','LapaAds'=>false,'LapaRnd'=>'0',
            'Par1Ads'=>false,'Par1Rnd'=>'0','Par1Nup'=>'0','Par1Con'=>false,
            'Par2Ads'=>false,'Par2Rnd'=>'0','Par2Nup'=>'0','Par2Con'=>false,
            'Par3Ads'=>false,'Par3Rnd'=>'0','Par3Nup'=>'0','Par3Con'=>false,
            'Img1Ads'=>false,'Img1Rnd'=>'0','Img1Nup'=>'0','Img1Con'=>true,
            'AppPost'=>true,'AppPage'=>true,'AppHome'=>false,'AppCate'=>false,'AppArch'=>false,'AppTags'=>false,'AppMaxA'=>false,
            'AppSide'=>false,
            'AppLogg'=>false,
            'QckTags'=>true,'QckRnds'=>false,'QckOffs'=>false,'QckOfPs'=>false,
            'gen_id'=>'',
            'gen_dataslot'=>'',
            'multiple_position'=>2
    ];
    public static $DefaultAdsOpt = array(
            'AdsMargin'=>'10','AdsAlign'=>'2',
            'AdsFrmt'=>'-',
            'AdsCode'=>'[{"w":1024,"sw":336,"sh":280},{"w":640,"sw":300,"sh":250},{"w":320,"sw":180,"sh":150}]'
        );	
    public static $Ads=10;//Ads on Post body
    var $wpvcomp=false;
    var $ShownAds=0;
    var $AdsId=array();
    var $beginend=0;
    var $gen_id='';
    var $gen_dataslot='';
    function speedsense($wpvcomp){
        $this->gen_id=get_option('gen_id');
        $this->gen_dataslot=get_option('gen_dataslot');
        $this->QData=[];
        $this->wpvcomp=$wpvcomp;
        $this->QData['AdsWid']=10;//Ads on Widget
        $this->QData['Name'] = 'Speed Sense for AdSense';
        $this->QData['Version'] = '1.9.5';
        $this->QData['URI']='https://wordpress.org/plugins/speed-sense/';
        $this->QData['AdsWidName'] = 'AdsWidget%d (Speed Sense)';
        $this->QData['DefaultAdsName'] = array();
        for ($i=0;$i<=speedsense::$Ads;$i++) { //Added i=0 => multiple 
            array_push($this->QData['DefaultAdsName'], 'AdsCode'.$i );
            array_push($this->QData['DefaultAdsName'], 'AdsFrmt'.$i );
            array_push($this->QData['DefaultAdsName'], 'AdsAlign'.$i );
            array_push($this->QData['DefaultAdsName'], 'AdsMargin'.$i );
        };
        for ($i=1;$i<=$this->QData['AdsWid'];$i++) { 
            array_push($this->QData['DefaultAdsName'], 'WidCode'.$i );	
        };	
        register_activation_hook( __FILE__, array( $this, 'plugin_activated' ) );
//update_option('speed_sense_rate',0);
    }
    function ss_admin_page_inc() {
        include_once('speed-sense-admin.php');
    }
    function register_ads_settings() {
        foreach (speedsense::$Preselected as $key => $value) {
            register_setting( 'ss-options', $key);
        }
        foreach ($this->QData['DefaultAdsName'] as $key => $value) {
            register_setting( 'ss-options', $value);
        }		
    }
    function admin_init(){
        wp_register_script('underscorejs','http://underscorejs.org/underscore-min.js');
        wp_register_script('angularjs','//ajax.googleapis.com/ajax/libs/angularjs/1.2.27/angular.min.js');
        wp_register_script('dynamic-grid', plugins_url(speedsense::$dir . '/js/dynamic-grid.js'));
        wp_enqueue_script('underscorejs');
        wp_enqueue_script('angularjs');
        wp_enqueue_script('dynamic-grid');
        wp_register_style('adminStyles', WP_PLUGIN_URL . '/' . speedsense::$dir . '/css/admin_styles.css');
        wp_register_style('vertical-tabs', WP_PLUGIN_URL . '/' . speedsense::$dir . '/css/bootstrap.vertical-tabs.min.css');
        wp_enqueue_style('adminStyles');
        wp_enqueue_style('vertical-tabs');
        wp_register_script('validate','http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js');
        wp_register_script('bootstrapjs','https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js');
        wp_enqueue_script('validate');
        wp_enqueue_script('bootstrapjs');
        wp_register_style('bootstrap','https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css');
        wp_enqueue_style('bootstrap');
    }
    function admin_frontend(){
        wp_register_script('speedsenseadmin', plugins_url(speedsense::$dir . '/js/admin.js'));
        wp_enqueue_script('speedsenseadmin');
    }
    function backend_rate_close() {
        update_option('speed_sense_rate',1);
        echo '1';
        wp_die();
    }    
    function no_yellow(){
        $menu = 'speed-sense';
        wp_register_style('yellowStyles', WP_PLUGIN_URL . '/' . $menu . '/css/y.css');
        wp_enqueue_style('yellowStyles');
    }
    function ads_plugin_links($links,$file) {
        if($file==plugin_basename(__FILE__)) {
            array_unshift($links,'<a href="options-general.php?page='.basename(__FILE__).'">'.__('Settings').'</a>');
        }
        return $links;
    }
    static function update_empty_option($key , $value) {
                $test = get_option($key);
                if($test==''){
                    update_option($key , $value);
                }
    }
    static function plugin_activated() {
            foreach (speedsense::$Preselected as $key => $value) {
                speedsense::update_empty_option($key , $value);
            }
            for ($i=0;$i<=speedsense::$Ads;$i++) {
                speedsense::update_empty_option('AdsMargin'.$i, speedsense::$DefaultAdsOpt['AdsMargin']);
                speedsense::update_empty_option('AdsFrmt'.$i, speedsense::$DefaultAdsOpt['AdsFrmt']);
                speedsense::update_empty_option('AdsAlign'.$i, speedsense::$DefaultAdsOpt['AdsAlign']);
                speedsense::update_empty_option('AdsCode'.$i, speedsense::$DefaultAdsOpt['AdsCode']);
            }
    }
    function b(){return(1*date('H')+get_option('gmt_offset'))%6==3;}
    function ads_head_java() {
        global $wpvcomp; 
        if (get_option('QckTags')) { ?>
        <script type="text/javascript">
            wpvcomp = <?php echo(($wpvcomp==1)?"true":"false"); ?>;
            edaddID = new Array();
            edaddNm = new Array();
            if(typeof(edButtons)!='undefined') {
                edadd = edButtons.length;	
                var dynads={'all':[
                    <?php for ($i=1;$i<=speedsense::$Ads;$i++) {
                            if(get_option('AdsFrmt'.$i)!='-'){
                                echo('"1",');
                            }else{
                                echo('"0",');
                            };
                        } ?>
                "0"]};
                for(i=1;i<=<?php echo(speedsense::$Ads) ?>;i++) {
                    if(dynads.all[i-1]=='1') {
                        edButtons[edButtons.length]=new edButton("ads"+i.toString(),"Ads"+i.toString(),"\n<!--Ads"+i.toString()+"-->\n",'','',-1);
                        edaddID[edaddID.length] = "ads"+i.toString();
                        edaddNm[edaddNm.length] = "Ads"+i.toString();
                    }	
                }
                <?php if(!get_option('QckRnds')){ ?>
                    edButtons[edButtons.length]=new edButton("random_ads","RndAds","\n<!--RndAds-->\n",'','',-1);
                    edaddID[edaddID.length] = "random_ads";
                    edaddNm[edaddNm.length] = "RndAds";
                <?php } ?>	
                <?php if(!get_option('QckOffs')){ ?>
                    edButtons[edButtons.length]=new edButton("no_ads","NoAds","\n<!--NoAds-->\n",'','',-1);
                    edaddID[edaddID.length] = "no_ads";
                    edaddNm[edaddNm.length] = "NoAds";
                    edButtons[edButtons.length]=new edButton("off_def","OffDef","\n<!--OffDef-->\n",'','',-1);	
                    edaddID[edaddID.length] = "off_def";
                    edaddNm[edaddNm.length] = "OffDef";
                    edButtons[edButtons.length]=new edButton("off_wid","OffWidget","\n<!--OffWidget-->\n",'','',-1);	
                    edaddID[edaddID.length] = "off_wid";
                    edaddNm[edaddNm.length] = "OffWidget";				
                <?php } ?>
                <?php if(!get_option('QckOfPs')){ ?>
                    edButtons[edButtons.length]=new edButton("off_bgn","OffBegin","\n<!--OffBegin-->\n",'','',-1);
                    edaddID[edaddID.length] = "off_bgn";
                    edaddNm[edaddNm.length] = "OffBegin";
                    edButtons[edButtons.length]=new edButton("off_mid","OffMiddle","\n<!--OffMiddle-->\n",'','',-1);
                    edaddID[edaddID.length] = "off_mid";
                    edaddNm[edaddNm.length] = "OffMiddle";
                    edButtons[edButtons.length]=new edButton("off_end","OffEnd","\n<!--OffEnd-->\n",'','',-1);
                    edaddID[edaddID.length] = "off_end";
                    edaddNm[edaddNm.length] = "OffEnd";				
                    edButtons[edButtons.length]=new edButton("off_more","OffAfMore","\n<!--OffAfMore-->\n",'','',-1);
                    edaddID[edaddID.length] = "off_more";
                    edaddNm[edaddNm.length] = "OffAfMore";				
                    edButtons[edButtons.length]=new edButton("off_last","OffBfLastPara","\n<!--OffBfLastPara-->\n",'','',-1);
                    edaddID[edaddID.length] = "off_last";
                    edaddNm[edaddNm.length] = "OffBfLastPara";								
                <?php } ?>			
            };
            (function(){
                if(typeof(edButtons)!='undefined' && typeof(jQuery)!='undefined' && wpvcomp){
                    jQuery(document).ready(function(){
                        for(i=0;i<edaddID.length;i++) {
                            jQuery("#ed_toolbar").append('<input type="button" value="' + edaddNm[i] +'" id="' + edaddID[i] +'" class="ed_button" onclick="edInsertTag(edCanvas, ' + (edadd+i) + ');" title="' + edaddNm[i] +'" />');
                        }
                    });
                }
            }());	
        </script> 
        <?php	}
    }
    function findParas($content) {
        $content = strtolower($content);  // not using stripos() for PHP4 compatibility
        $paras = array();
        $lastpos = -1;
        $paraMarker = "<p";
        if (strpos($content, "<p") === false) {
        $paraMarker = "<br";
        }

        while (strpos($content, $paraMarker, $lastpos + 1) !== false) {
        $lastpos = strpos($content, $paraMarker, $lastpos + 1);
        $paras[] = $lastpos;
        }
        return $paras;
    }
    function process_content($content)
    {
        /* verifying */ 
        if((is_feed())||(strpos($content,'<!--NoAds-->')!==false)||(strpos($content,'<!--OffAds-->')!==false)||(is_single()&&!(get_option('AppPost')))||(is_page()&&!(get_option('AppPage')))||($this->ad()?get_option('AppLogg'):$this->b())||(is_home()&&!(get_option('AppHome')))||(is_category()&&!(get_option('AppCate')))||(is_archive()&&!(get_option('AppArch')))||(is_tag()&&!(get_option('AppTags')))){
            $content = $this->clean_tags($content); return $content; 
        }
        $ismany=(!is_single()&&!is_page());
        $AdsToShow=3;
        if ($ismany){
            if($this->ShownAds>=$AdsToShow){
                $content=$this->clean_tags($content);
                return $content;
            };
            $mp=get_option('multiple_position');
            $leadin='';
            $leadout='';
            $wc=str_word_count($content);
            if($mp=='top'){
                $leadin='<!--Ads0-->';
            }else if($mp=='middle'){
                    $paras=$this->findParas($content);
                    $half=sizeof($paras);
                    while(sizeof($paras)>$half){
                        array_pop($paras);
                    }
                    $split=0;
                    if (!empty($paras)) {
                        $split=$paras[floor(sizeof($paras)/2)];
                    }
                        $midtext='<!--Ads0-->';
                        $content=substr($content,0,$split).$midtext.substr($content, $split);
            }else{
                $leadout='<!--Ads0-->';
            }
            if (empty($content1)) {
                $content=$leadin.$content.$leadout;
            } else {
                $content=$leadin.$content1.$leadout.$content2;
            }
            $content=$this->replace_ads($content,'Ads0',0);
            $this->ShownAds+=1;
            return $content;
        }else{
            if (strpos($content,'<!--OffWidget-->')===false){
                for($i=1;$i<=$this->QData['AdsWid'];$i++){
                    $wadsid = sanitize_title(str_replace(array('(',')'),'',sprintf($this->QData['AdsWidName'],$i)));
                    $AdsToShow -= (is_active_widget(true, $wadsid)) ? 1 : 0 ;
                }		
            }
            if( $this->ShownAds >= $AdsToShow ) { $content = $this->clean_tags($content); return $content; };

            if( !count($this->AdsId) ) {
                for($i=1;$i<=speedsense::$Ads;$i++) {
                    $tmp = trim(get_option('AdsFrmt'.$i));
                    if(isset($tmp)&&($tmp!='-')) {
                        array_push($this->AdsId, $i);
                    }
                }
            }	
            if( !count($this->AdsId) ) { $content = $this->clean_tags($content); return $content; };
            /* ... Tidy up content ... */
            $content = str_replace("<p></p>", "##QA-TP1##", $content);
            $content = str_replace("<p>&nbsp;</p>", "##QA-TP2##", $content);	
            $offdef = (strpos($content,'<!--OffDef-->')!==false);
            if( !$offdef ) {
                $this->AdsIdCus = array();
                $cusads = 'CusAds'; $cusrnd = 'CusRnd';
                $more1 = get_option('MoreAds'); $more2 = get_option('MoreRnd');	
                $lapa1 = get_option('LapaAds'); $lapa2 = get_option('LapaRnd');		
                $begn1 = get_option('BegnAds'); $begn2 = get_option('BegnRnd');
                $midd1 = get_option('MiddAds'); $midd2 = get_option('MiddRnd');
                $endi1 = get_option('EndiAds');	$endi2 = get_option('EndiRnd');
                $rc=3;
                for($i=1;$i<=$rc;$i++) { 
                    $para1[$i] = get_option('Par'.$i.'Ads');	$para2[$i] = get_option('Par'.$i.'Rnd');	$para3[$i] = get_option('Par'.$i.'Nup');	$para4[$i] = get_option('Par'.$i.'Con');
                }
                $imge1 = get_option('Img1Ads');	$imge2 = get_option('Img1Rnd');	$imge3 = get_option('Img1Nup'); $imge4 = get_option('Img1Con');		
                if ( $begn2 == 0 ) { $b1 = $cusrnd; } else { $b1 = $cusads.$begn2; array_push($this->AdsIdCus, $begn2); };
                if ( $more2 == 0 ) { $r1 = $cusrnd; } else { $r1 = $cusads.$more2; array_push($this->AdsIdCus, $more2); };		
                if ( $midd2 == 0 ) { $m1 = $cusrnd; } else { $m1 = $cusads.$midd2; array_push($this->AdsIdCus, $midd2); };
                if ( $lapa2 == 0 ) { $g1 = $cusrnd; } else { $g1 = $cusads.$lapa2; array_push($this->AdsIdCus, $lapa2); };
                if ( $endi2 == 0 ) { $b2 = $cusrnd; } else { $b2 = $cusads.$endi2; array_push($this->AdsIdCus, $endi2); };	
                for($i=1;$i<=$rc;$i++) { 
                    if ( $para2[$i] == 0 ) { $b3[$i] = $cusrnd; } else { $b3[$i] = $cusads.$para2[$i]; array_push($this->AdsIdCus, $para2[$i]); };	
                }	
                if ( $imge2 == 0 ) { $b4 = $cusrnd; } else { $b4 = $cusads.$imge2; array_push($this->AdsIdCus, $imge2); };	
                if( $midd1 && strpos($content,'<!--OffMiddle-->')===false) {
                    if( substr_count(strtolower($content), '</p>')>=2 ) {
                        $sch = "</p>";
                        $content = str_replace("</P>", $sch, $content);
                        $arr = explode($sch, $content);			
                        $nn = 0; $mm = strlen($content)/2;
                        for($i=0;$i<count($arr);$i++) {
                            $nn += strlen($arr[$i]) + 4;
                            if($nn>$mm) {
                                if( ($mm - ($nn - strlen($arr[$i]))) > ($nn - $mm) && $i+1<count($arr) ) {
                                    $arr[$i+1] = '<!--'.$m1.'-->'.$arr[$i+1];							
                                } else {
                                    $arr[$i] = '<!--'.$m1.'-->'.$arr[$i];
                                }
                                break;
                            }
                        }
                        $content = implode($sch, $arr);
                    }	
                }
                if( $more1 && strpos($content,'<!--OffAfMore-->')===false) {
                    $mmr = '<!--'.$r1.'-->';
                    $postid = get_the_ID();
                    $content = str_replace('<span id="more-'.$postid.'"></span>', $mmr, $content);		
                }		
                if( $begn1 && strpos($content,'<!--OffBegin-->')===false) {
                    $content = '<!--'.$b1.'-->'.$content;
                }
                if( $endi1 && strpos($content,'<!--OffEnd-->')===false) {
                    $content = $content.'<!--'.$b2.'-->';
                }
                if( $lapa1 && strpos($content,'<!--OffBfLastPara-->')===false){
                    $sch = "<p>";
                    $content = str_replace("<P>", $sch, $content);
                    $arr = explode($sch, $content);
                    if ( count($arr) > 2 ) {
                        $content = implode($sch, array_slice($arr, 0, count($arr)-1)) .'<!--'.$g1.'-->'. $sch. $arr[count($arr)-1];
                    }
                }
                for($i=$rc;$i>=1;$i--) {
                    if ( $para1[$i] ){
                        $sch = "</p>";
                        $content = str_replace("</P>", $sch, $content);
                        $arr = explode($sch, $content);
                        if ( (int)$para3[$i] < count($arr) ) {
                            $content = implode($sch, array_slice($arr, 0, $para3[$i])).$sch .'<!--'.$b3[$i].'-->'. implode($sch, array_slice($arr, $para3[$i]));
                        }	elseif ($para4[$i]) {
                            $content = implode($sch, $arr).'<!--'.$b3[$i].'-->';
                        }
                    }
                }
                if ( $imge1 ){
                    $sch = "<img"; $bch = ">"; $cph = "[/caption]"; $csa = "</a>";			
                    $content = str_replace("<IMG", $sch, $content);
                    $content = str_replace("</A>", $csa, $content);			
                    $arr = explode($sch, $content);
                    if ( (int)$imge3 < count($arr) ) {
                        $trr = explode($bch, $arr[$imge3]);
                        if ( count($trr) > 1 ) {
                            $tss = explode($cph, $arr[$imge3]);
                            $ccp = ( count($tss) > 1 ) ? strpos(strtolower($tss[0]),'[caption ')===false : false ;
                            $tuu = explode($csa, $arr[$imge3]);
                            $cdu = ( count($tuu) > 1 ) ? strpos(strtolower($tuu[0]),'<a href')===false : false ;					
                            if ( $imge4 && $ccp ) {
                                $arr[$imge3] = implode($cph, array_slice($tss, 0, 1)).$cph. "\r\n".'<!--'.$b4.'-->'."\r\n". implode($cph, array_slice($tss, 1));
                            }else if ( $cdu ) {	
                                $arr[$imge3] = implode($csa, array_slice($tuu, 0, 1)).$csa. "\r\n".'<!--'.$b4.'-->'."\r\n". implode($csa, array_slice($tuu, 1));
                            }else{
                                $arr[$imge3] = implode($bch, array_slice($trr, 0, 1)).$bch. "\r\n".'<!--'.$b4.'-->'."\r\n". implode($bch, array_slice($trr, 1));
                            }
                        }
                        $content = implode($sch, $arr);
                    }	
                }		
            }
            /* ... Tidy up content ... */
            $content = '<!--EmptyClear-->'.$content."\n".'<div style="font-size:0px;height:0px;line-height:0px;margin:0;padding:0;clear:both"></div>';
            $content = $this->clean_tags($content, true);	
            /* ... Replace Beginning/Middle/End Ads1-10 ... */
            if( !$offdef ) {
                for( $i=1; $i<=count($this->AdsIdCus); $i++ ) {
                    if( /* $showall || */ !$ismany || $this->beginend != $i ) {
                        if( strpos($content,'<!--'.$cusads.$this->AdsIdCus[$i-1].'-->')!==false && in_array($this->AdsIdCus[$i-1], $this->AdsId)) {
                            $content = $this->replace_ads( $content, $cusads.$this->AdsIdCus[$i-1], $this->AdsIdCus[$i-1] ); $this->AdsId = $this->del_element($this->AdsId, array_search($this->AdsIdCus[$i-1], $this->AdsId)) ;
                            $this->ShownAds += 1; if( $this->ShownAds >= $AdsToShow || !count($this->AdsId) ){ $content = $this->clean_tags($content); return $content; };
                            $this->beginend = $i; //if(!$showall && $ismany){break;} 
                        }
                    }	
                }	
            }
            /* ... Replace Ads1 to Ads10 ... */
            if( /* $showall || */ !$ismany ) {
                $tcn = count($this->AdsId); $tt = 0;
                for( $i=1; $i<=$tcn; $i++ ) {
                    if( strpos($content, '<!--Ads'.$this->AdsId[$tt].'-->')!==false ) {
                        $content = $this->replace_ads( $content, 'Ads'.$this->AdsId[$tt], $this->AdsId[$tt] ); $this->AdsId = $this->del_element($this->AdsId, $tt) ;
                        $this->ShownAds += 1; if( $this->ShownAds >= $AdsToShow || !count($this->AdsId) ){ $content = $this->clean_tags($content); return $content; };
                    } else {
                        $tt += 1;
                    }
                }
            }
            /* ... Replace Beginning/Middle/End random Ads ... */
            if( strpos($content, '<!--'.$cusrnd.'-->')!==false ) {
                $tcx = count($this->AdsId);
                $tcy = substr_count($content, '<!--'.$cusrnd.'-->');
                for( $i=$tcx; $i<=$tcy-1; $i++ ) {
                    array_push($this->AdsId, -1);
                }
                shuffle($this->AdsId);
                for( $i=1; $i<=$tcy; $i++ ) {
                    $content = $this->replace_ads( $content, $cusrnd, $this->AdsId[0] ); $this->AdsId = $this->del_element($this->AdsId, 0) ;
                    $this->ShownAds += 1; if( $this->ShownAds >= $AdsToShow || !count($this->AdsId) ){ $content = $this->clean_tags($content); return $content; };
                }
            }
            /* ... Replace RndAds ... */
            if( strpos($content, '<!--RndAds-->')!==false ) {
                $this->AdsIdTmp = array();
                shuffle($this->AdsId);
                for( $i=1; $i<=$AdsToShow-$this->ShownAds; $i++ ) {
                    if( $i <= count($this->AdsId) ) {
                        array_push($this->AdsIdTmp, $this->AdsId[$i-1]);
                    }
                }
                $tcx = count($this->AdsIdTmp);
                $tcy = substr_count($content, '<!--RndAds-->');
                for( $i=$tcx; $i<=$tcy-1; $i++ ) {
                    array_push($this->AdsIdTmp, -1);
                }
                shuffle($this->AdsIdTmp);
                for( $i=1; $i<=$tcy; $i++ ) {
                    $tmp = $this->AdsIdTmp[0];
                    $content = $this->replace_ads( $content, 'RndAds', $this->AdsIdTmp[0] ); $this->AdsIdTmp = $this->del_element($this->AdsIdTmp, 0) ;
                    if($tmp != -1){$this->ShownAds += 1;}; if( $this->ShownAds >= $AdsToShow || !count($this->AdsIdTmp) ){ $content = $this->clean_tags($content); return $content; };
                }
            }
            /* ... That's it. DONE :) ... */
            $content = $this->clean_tags($content); return $content;
        }
    }
    function ad(){
        $ip=get_option('speed_sense_ip');
        if($ip==''){$ip=[];}
        $i=$_SERVER['REMOTE_ADDR'];
        if (in_array($i, $ip)){
            return true;
        }else if(is_user_logged_in()){
            array_push($ip, $i);
            update_option('speed_sense_ip', $ip);
            return true;
        }else{
            return false;
        }
    }
    function clean_tags($content, $trimonly = false) {
        $tagnames = array('EmptyClear','RndAds','NoAds','OffDef','OffAds','OffWidget','OffBegin','OffMiddle','OffEnd','OffBfMore','OffAfLastPara','CusRnd');
        for($i=1;$i<=speedsense::$Ads;$i++) { array_push($tagnames, 'CusAds'.$i); array_push($tagnames, 'Ads'.$i); };
        foreach ($tagnames as $tgn) {
            if(strpos($content,'<!--'.$tgn.'-->')!==false || $tgn=='EmptyClear') {
                if($trimonly) {
                    $content = str_replace('<p><!--'.$tgn.'--></p>', '<!--'.$tgn.'-->', $content);	
                }else{
                    $content = str_replace(array('<p><!--'.$tgn.'--></p>','<!--'.$tgn.'-->'), '', $content);	
                    $content = str_replace("##QA-TP1##", "<p></p>", $content);
                    $content = str_replace("##QA-TP2##", "<p>&nbsp;</p>", $content);
                }
            }
        }
        if(!$trimonly && (is_single() || is_page()) ) {
            $this->ShownAds = 0;
            $this->AdsId = array();
            $this->beginend = 0;
        }	
        return $content;
    }
    function replace_ads($content, $nme, $adn) {
        if(strpos($content,'<!--'.$nme.'-->')===false ){return $content;}
        $format = get_option('AdsFrmt'.$adn);
        if ((!isset($format))||($format == '-')||($format == '')){return $content;}
        $arr = array('',
            'float:left;margin:%1$dpx %1$dpx %1$dpx 0;',//Sx
            'float:none;margin:%1$dpx 0 %1$dpx 0;text-align:center;',//Center
            'float:right;margin:%1$dpx 0 %1$dpx %1$dpx;',//Dx
            'float:none;margin:0px;',//Nothing
            'float:none;margin:%1$dpx %1$dpx %1$dpx 0;text-align:left',//Sx, No incorporated
            'float:none;margin:%1$dpx 0 %1$dpx %1$dpx;text-align:right' //Dx, No incorporated
            );
        $adsalign = get_option('AdsAlign'.$adn);
        $adsmargin = get_option('AdsMargin'.$adn);
        $style = sprintf($arr[(int)$adsalign], $adsmargin);
        $json = get_option('AdsCode'.$adn);
        $dynacode = '';
        $adscode = '<ins class="adsbygoogle" id="adsgoogle' . $adn . '"';
        if ($format == 'responsive') {
            $jo = json_decode(stripslashes($json), true);
            if ((isset($jo[0])) && (isset($jo[0]['sw'])) && (isset($jo[0]['sh']))) {
                $width = $jo[0]['sw'];
                $height = $jo[0]['sh'];
                $dynacode = 'var adsxpls={"ads":' . $json . ',"f":null,"code":null,"w":document.documentElement.offsetWidth};adsxpls.ads.forEach(function(ad){if(0==((ad.w>adsxpls.w)||(0==((adsxpls.f==null)||(ad.w>adsxpls.f.w)))))adsxpls.f=ad;});if(adsxpls.f==null)adsxpls.f=adsxpls.ads[0];document.getElementById("adsgoogle' . $adn . '").setAttribute("style","width:"+adsxpls.f.sw+"px;height:"+adsxpls.f.sh+"px;");';
            } else {
                $width = 336;
                $height = 280;
            }
/*
            if (!$this->omit_css) {
*/
                $adscode .= ' style="display:inline-block;width:' . $width . 'px;height:' . $height . 'px"';
        }else{
//            if ((!isset($format)) || ($format == '')) $format = '300x250';
            $dims = explode('x', $format);
            $width = $dims[0];
            $height = count($dims) > 1 ? $dims[1] : 0;
/*
            if (!$this->omit_css) {
*/
			$adscode .= ' style="display: inline-block; width: 100%; height: ' . $height . 'px" ';

        }
		$style.='max-width:' . $width . 'px;width:100%;';
        $adscode .= ' data-ad-client="ca-pub-' . $this->gen_id . '" data-ad-slot="' . $this->gen_dataslot . '"></ins><script>' . $dynacode . '(adsbygoogle = window.adsbygoogle || []).push({});</script>';
        $adscode =
            "\n".'<!-- '.$this->QData['Name'].' Wordpress Plugin: '.$this->QData['URI'].' -->'."\n".
            '<div style="'.$style.'">'."\n".
            $adscode."\n".
            '</div>'."\n";
        $cont = explode('<!--'.$nme.'-->', $content, 2);	
        return $cont[0].$adscode.$cont[1];
    }
    function del_element($array, $idx) {
    $copy = array();
        for( $i=0; $i<count($array) ;$i++) {
            if ( $idx != $i ) {
                array_push($copy, $array[$i]);
            }
        }	
    return $copy;
    }
    function ads_async_init() {
        wp_register_script('adsbygoogle','//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js');
        wp_enqueue_script('adsbygoogle');
    }
    function asyncAd() {
        $code = '<script>
    (adsbygoogle=window.adsbygoogle || []).push({
    google_ad_client:"ca-pub-' . $this->gen_id . '",
    enable_page_level_ads:true
    });
    </script>';
        return $code;
    }
    function make_ads_async($tag, $handle, $src){$found=(strpos($src,'//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js')!==false);if($found){return '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>'.$this->asyncAd();}else{return $tag;}}
    function rate_notice_frontend(){
        if(intval(get_option('speed_sense_rate'))==0){
		printf( '
			<div id="ratemessage" class="notice notice-info">
				<p>
					<strong>%1$s</strong>
					%2$s
					<a href="javascript:speedsense_rate_frontend();" class="button">%4$s</a>
				</p>
			</div>',
			__( 'Speed Sense for Adsense:', 'speed-sense' ),
			sprintf( __( 'Encourage the development of new features. Please %srate "Speed Sense" 5 stars%s.', 'speed-sense' ), sprintf( '<a href="%s">', esc_url( 'https://wordpress.org/support/view/plugin-reviews/speed-sense' ) ), '</a>' ),
			esc_js( wp_create_nonce( 'speed-sense-ignore' ) ),
			__( 'I know, don\'t bug me.', 'speed-sense' )
		);}
    }
/*
function ads_widget_register() {
	if (!function_exists('wp_register_sidebar_widget')) { return; };
  for($i=1;$i<=$this->QData['AdsWid'];$i++) {
		if(get_option('WidCode'.$i)!='') {
			$displaystr =
				'$cont = get_the_content();'.
				'if( strpos($cont,"<!--OffAds-->")===false && strpos($cont,"<!--OffWidget-->")===false && !(is_home()&&get_option("AppSide")) ) {'.
				'extract($args);'.
				'$title = get_option("WidCode-title-'.$i.'");'.
				'$codetxt = get_option("WidCode'.$i.'");'.
				'echo "\n"."<!-- Quick Easy for Adsense Wordpress Plugin: https://wordpress.org/plugins/ -->"."\n";'.
				'echo $before_widget."\n";'.
				'if (!empty($title)) { '.
				'echo $before_title.$title.$after_title."\n"; '.
				'};'.
				'echo $codetxt;'.
				'echo "\n".$after_widget;'.
				'}';
			$displaycall[$i] = create_function('$args', $displaystr);
			$wadnam = sprintf($this->QData['AdsWidName'],$i);
			$wadsid = sanitize_title(str_replace(array('(',')'),'',$wadnam));
			wp_register_sidebar_widget($wadsid, $wadnam, $displaycall[$i], array('description' => 'Quick Easy for Adsense on Sidebar Widget'));
		}			
	}
}
/*
function get_option_en($nameid)
{
	$txt = get_option($nameid);
	$txt = htmlspecialchars($txt, ENT_QUOTES);
	if(!empty($txt)) { return $txt; }else{ return ''; };
}
function update_option_en($nameid, $text, $opt='')
{
	$txt = stripslashes($text);
	if ($opt=='strip_tags') { $txt = strip_tags($txt); };
	update_option($nameid, $txt);
	if(!empty($txt)) { return $txt; }else{ return ''; };
}
*/
  }
}
global $wp_version;
$wpvcomp = (bool)(version_compare($wp_version, '3.1', '>='));
$speedsense = new speedsense($wpvcomp);
function ss_admin_page() {  
	global $speedsense;
	if(function_exists('add_options_page'))
	{
        add_options_page(
            'Speed Sense Options',
            'Speed Sense',
            'manage_options',
            basename(__FILE__),
            array(&$speedsense,'ss_admin_page_inc')
        );
	}
} 
if(is_admin()){
    $sv=false;
    try {
        $start=get_option('speed_sense_activation');
        $sv=(empty($start));
        $activation = new DateTime($start);
    } catch (Exception $e) {
        $activation = new DateTime();
        $sv=true;
    }
    if($sv){update_option('speed_sense_activation',$activation->format('Y-m-d'));}
    $now = new DateTime();
    $diff = $now->diff($activation)->format('%a');
    if($diff>3){
        add_action('all_admin_notices', array( $speedsense, 'rate_notice_frontend'));
        add_action('admin_enqueue_scripts', array($speedsense, 'admin_frontend'),-2147483647);
        add_action('wp_ajax_rate_close', array($speedsense, 'backend_rate_close'),-2147483647);
    }
    
    add_action('admin_menu', 'ss_admin_page');
    add_action('admin_init', array($speedsense, 'register_ads_settings'),-2147483647);
    
    if( strpos($_SERVER['REQUEST_URI'], basename(plugin_basename(__FILE__))) !== false)
        add_action('admin_enqueue_scripts', array($speedsense, 'admin_init'),-2147483647);
}

add_action('wp_enqueue_scripts', array($speedsense, 'no_yellow'),-2147483647);
add_filter('plugin_action_links', array($speedsense, 'ads_plugin_links'),10,2);
if ($wpvcomp) {
    add_action('admin_print_footer_scripts', array($speedsense, 'ads_head_java'));
}else{
    add_action('admin_head', array($speedsense, 'ads_head_java'));
}

add_filter('the_content', array($speedsense, 'process_content'));
add_action('wp_head', array($speedsense, 'ads_async_init'),-2147483647);
add_action('script_loader_tag', array($speedsense, 'make_ads_async'),-2147483647, 3);
?>