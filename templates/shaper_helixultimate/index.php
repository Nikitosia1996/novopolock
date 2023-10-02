<?php
/**
 * @package Helix_Ultimate_Framework
 * @author JoomShaper <support@joomshaper.com>
 * Copyright (c) 2010 - 2021 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */

defined('_JEXEC') or die('Restricted Direct Access!');

use HelixUltimate\Framework\Core\HelixUltimate;
use HelixUltimate\Framework\Platform\Helper;
use HelixUltimate\Framework\System\JoomlaBridge;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;

$app = Factory::getApplication();
$this->setHtml5(true);

/**
 * Load the framework bootstrap file for enabling the HelixUltimate\Framework namespacing.
 *
 * @since	2.0.0
 */
$bootstrap_path = JPATH_PLUGINS . '/system/helixultimate/bootstrap.php';

if (file_exists($bootstrap_path))
{
	require_once $bootstrap_path;
}
else
{
	die('Install and activate <a target="_blank" rel="noopener noreferrer" href="https://www.joomshaper.com/helix">Helix Ultimate Framework</a>.');
}

/**
 * Get the theme instance from Helix framework.
 *
 * @var		$theme		The theme object from the class HelixUltimate.
 * @since	1.0.0
 */
$theme = new HelixUltimate;
$template = Helper::loadTemplateData();
$this->params = $template->params;


/** Load needed data for javascript */
Helper::flushSettingsDataToJs();

$requestFromIframe = $app->input->get('helixMode', '') === 'edit';

// Coming Soon
if (!$requestFromIframe) 
{
	if (!\is_null($this->params->get('comingsoon', null)))
	{
		header("Location: " . Route::_(Uri::root(true) . "/index.php?templateStyle={$template->id}&tmpl=comingsoon", false));
		exit();
	}
}

$scssVars = $theme->getSCSSVariables();

$boxedLayout = $this->params->get('boxed_layout');

// Body Background Image
if ($boxedLayout && $this->params->get('body_bg_image'))
{
	$bg_image = $this->params->get('body_bg_image');
	$body_style = 'background-image: url(' . Uri::base(true) . '/' . $bg_image . ');';
	$body_style .= 'background-repeat: ' . $this->params->get('body_bg_repeat') . ';';
	$body_style .= 'background-size: ' . $this->params->get('body_bg_size') . ';';
	$body_style .= 'background-attachment: ' . $this->params->get('body_bg_attachment') . ';';
	$body_style .= 'background-position: ' . $this->params->get('body_bg_position') . ';';
	$body_style = 'body.site {' . $body_style . '}';
	$this->addStyledeclaration($body_style);
}

// Custom CSS
if ($custom_css = $this->params->get('custom_css'))
{
	$this->addStyledeclaration($custom_css);
}

$progress_bar_position = $this->params->get('reading_timeline_position');

if($app->input->get('view') === 'article' && $this->params->get('reading_time_progress', 0))
{
	$progress_style = 'position:fixed;';
	$progress_style .= 'z-index:9999;';
	$progress_style .= 'height:'.$this->params->get('reading_timeline_height').';';
	$progress_style .= 'background-color:'.$this->params->get('reading_timeline_bg').';';
	$progress_style .= $progress_bar_position == 'top' ? 'top:0;' : 'bottom:0;';
	$progress_style = '.sp-reading-progress-bar { '.$progress_style.' }';
	$this->addStyledeclaration($progress_style);
}

// Custom JS
if ($custom_js = $this->params->get('custom_js', null))
{
	$this->addScriptDeclaration($custom_js);
}
?>

<!doctype html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
	<head>


        <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit2"></script>

        <script type="text/javascript">
            eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('6 7(a,b){n{4(2.9){3 c=2.9("o");c.p(b,f,f);a.q(c)}g{3 c=2.r();a.s(\'t\'+b,c)}}u(e){}}6 h(a){4(a.8)a=a.8;4(a==\'\')v;3 b=a.w(\'|\')[1];3 c;3 d=2.x(\'y\');z(3 i=0;i<d.5;i++)4(d[i].A==\'B-C-D\')c=d[i];4(2.j(\'k\')==E||2.j(\'k\').l.5==0||c.5==0||c.l.5==0){F(6(){h(a)},G)}g{c.8=b;7(c,\'m\');7(c,\'m\')}}',43,43,'||document|var|if|length|function|GTranslateFireEvent|value|createEvent||||||true|else|doGTranslate||getElementById|google_translate_element|innerHTML|change|try|HTMLEvents|initEvent|dispatchEvent|createEventObject|fireEvent|on|catch|return|split|getElementsByTagName|select|for|className|goog|te|combo|null|setTimeout|500'.split('|'),0,{}))

        </script>



        <script type="text/javascript">

            function googleTranslateElementInit2() {new google.translate.TranslateElement({pageLanguage: 'ru', autoDisplay: false}, 'google_translate_element'); }</script>







        <style>
            body {top: 0 !important;}
            #google_translate_element,
            .skiptranslate,
            .goog-te-banner-frame {display: none !important;}
            
            .column {
                float: left;
                width: 33.333%;

            }

            /* Clear floats after the columns */
            .row1 {
                content: "";
                display: table;
                clear: both;
                display: flex!important;
                align-items: center!important;
            }

            .sp-module {
                width:100%;
            }

            #section-id-1629272628186 {
                display: none;
            }


            .column1 {
                display: grid;
                grid-template-columns: repeat(1,1fr);
                grid-template-rows: repeat(1,35px);
                grid-auto-rows: 50px;
            }

            .post-1 {
                grid-column: 1/3;
                width:33px;
                grid-row: span 2;
                padding-top: 15px;
            }
            .post-2 {
                width:170px;
                grid-column: 3;
                grid-row: 1;
            }
            .post-3 {
                width:170px;
                grid-column: 3;
                grid-row: 2;
            }

            .column2Text {

                font-style: normal;
                font-weight: 400;
                font-size: 14px;
                line-height: 14px;
                align-items: center;
                margin-bottom: 3px;
            }


            .column2Number {
                color:#457156;
                font-family: 'Arial';
                font-style: normal;
                font-weight: 700;
                font-size: 16px;
                line-height: 18px;
                align-items: center;
                margin-top: 3px;
            }

            .sp-megamenu-parent>li>a {
                font-size: 17px;
            }

            #paidservices {
                box-sizing: border-box;
                width: 121.84px;
                height: 40px;
                background:#001334;
                border: 1px solid #001334;
                border-radius: 0px;
                color:white;
            }


            #sppb-addon-1684928197361 {
                box-shadow: 6px 6px 50px rgba(0, 0, 0, 0.2);
                height: 253px;
            }

            #sppb-addon-1629274810488 {

                height: 253px;

            }

            #sppb-addon-1629272629807 {

                height: 253px;

            }
            #sppb-addon-1629272630711 {

                height: 253px;

            }


            @media (max-width: 600px) {
                #sp-header .logo a {
                    font-size: 15px;
                }
            }

            .imgFullWidth{
                width: 315px;
                margin-left: -15px;
            }

            .centerBlock{
                text-align: center;
                display: flex;
                align-items: center;
                justify-content: center;
            }





        </style>
		<?php echo $theme->googleAnalytics(); ?>

		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<?php

		$theme->head();
		$theme->loadFontAwesome();
		$theme->add_js('main.js');

		/**
		 * Add custom.js for user
		 */
		if (file_exists(JPATH_THEMES . '/' . $template->template . '/js/custom.js'))
		{
			$theme->add_js('custom.js');
		}

		$theme->add_scss('master', $scssVars, 'template');

		if($this->direction === 'rtl')
		{
			$theme->add_scss('rtl', $scssVars, 'rtl');
		}

		$theme->add_scss('presets', $scssVars, 'presets/' . $scssVars['preset']);

		$theme->add_scss('custom', $scssVars, 'custom-compiled');
		$theme->add_css('custom.css');

		//Before Head
		if ($before_head = $this->params->get('before_head'))
		{
			echo $before_head . "\n";
		}
		?>
	</head>
	<body class="<?php echo $theme->bodyClass(); ?>">

		<?php if ($this->params->get('after_body', '')): ?>
			<?php echo $this->params->get('after_body') . "\n"; ?>
		<?php endif ?>

		<?php if($this->params->get('preloader')) : ?>
			<div class="sp-pre-loader">
				<?php echo $theme->getPreloader($this->params->get('loader_type', '')); ?>
			</div>
		<?php endif; ?>

		<div class="body-wrapper">
			<div class="body-innerwrapper">
				<?php echo $theme->getHeaderStyle(); ?>
				<?php $theme->render_layout(); ?>
			</div>
		</div>

		<!-- Off Canvas Menu -->
		<div class="offcanvas-overlay"></div>
		<!-- Rendering the offcanvas style -->
		<!-- If canvas style selected then render the style -->
		<!-- otherwise (for old templates) attach the offcanvas module position -->
		<?php if (!empty($this->params->get('offcanvas_style', '1-LeftAlign'))): ?>
			<?php echo $theme->getOffcanvasStyle(); ?>
		<?php else : ?>
			<div class="offcanvas-menu">
				<a href="#" class="close-offcanvas" aria-label="<?php echo Text::_('HELIX_ULTIMATE_CLOSE_OFFCANVAS_ARIA_LABEL'); ?>"><span class="fas fa-times" aria-hidden="true"></span></a>
				<div class="offcanvas-inner">
					<?php if ($this->countModules('offcanvas')) : ?>
						<jdoc:include type="modules" name="offcanvas" style="sp_xhtml" />
					<?php else: ?>
						<p class="alert alert-warning">
							<?php echo Text::_('HELIX_ULTIMATE_NO_MODULE_OFFCANVAS'); ?>
						</p>
					<?php endif; ?>
				</div>
			</div>
		<?php endif; ?>
		

		<?php $theme->after_body(); ?>

		<jdoc:include type="modules" name="debug" style="none" />

		<!-- Go to top -->
		<?php if ($this->params->get('goto_top', 0)) : ?>
			<a href="#" class="sp-scroll-up" aria-label="<?php echo Text::_('HELIX_ULTIMATE_SCROLL_UP_ARIA_LABEL'); ?>"><span class="fas fa-angle-up" aria-hidden="true"></span></a>
		<?php endif; ?>
		<?php if( $app->input->get('view') === 'article' && $this->params->get('reading_time_progress', 0) ): ?>
			<div data-position="<?php echo $progress_bar_position; ?>" class="sp-reading-progress-bar"></div>
		<?php endif; ?>
	</body>

<script>
    if(document.documentElement.clientWidth < 500){
        let logo = document.getElementsByClassName("logo")[0];
        logo.innerHTML = "<a href='/'><span style='color:#000000; font-size:14px;'>Новополоцкий городской центр гигиены и эпидемиологии </span></a>";
    }
    if(document.documentElement.clientWidth < 600) {
        let col1 = document.getElementsByClassName("column")[0];
        let col2 = document.getElementsByClassName("column")[2];
        let col5 = document.getElementsByClassName("column")[5];
        let col3 = document.getElementsByClassName("column")[3];
        let col4 = document.getElementsByClassName("column")[4];

        col4.style = "margin-left: 40px";

        let ct4 = col4.getElementsByClassName("column2Text");
        for (item of ct4) {
            item.style = "margin-left: 35px";
        }

        let cn4 = col4.getElementsByClassName("column2Number");
        for (item of cn4) {
            item.style = "margin-left: 35px";
        }

        let ct2 = col3.getElementsByClassName("column2Text");
        for (item of ct2) {
            item.style = "margin-left: 35px";
        }

        let cn2 = col3.getElementsByClassName("column2Number");
        for (item of cn2) {
            item.style = "margin-left: 35px";
        }

        col1.style = "display: none";
        col2.style = "padding-left: 40px";
        col5.style = "display: none";
    }



    let mas = document.getElementsByClassName("mod-articlesnews newsflash")[0];
    mas.id = "mas";

    let masId = document.getElementById("mas");
    masId.className = "sppb-row";

    mas.style = "justify-content: center";
    let item1 = mas.getElementsByClassName("mod-articlesnews__item")[0];
    let item2 = mas.getElementsByClassName("mod-articlesnews__item")[1];
    let item3 = mas.getElementsByClassName("mod-articlesnews__item")[2];

    // masId.appendChild(item2);
    // masId.appendChild(item3);

    item1.style = "box-shadow: 6px 6px 50px 0px rgba(0, 0, 0, 0.2); margin-right: 50px;";
    item2.style = "box-shadow: 6px 6px 50px 0px rgba(0, 0, 0, 0.2); margin-right: 50px;";
    item3.style = "box-shadow: 6px 6px 50px 0px rgba(0, 0, 0, 0.2); margin-right: 50px;";

    item1.className = "sppb-col-md-3 sppb-col-sm-3";
    item2.className = "sppb-col-md-3 sppb-col-sm-3";
    item3.className = "sppb-col-md-3 sppb-col-sm-3";

    let flashNews = document.getElementsByClassName("newsflash-image");

    flashNews[0].classList.add("imgFullWidth");
    flashNews[1].classList.add("imgFullWidth");
    flashNews[2].classList.add("imgFullWidth");

    let flashTitle = document.getElementsByClassName("newsflash-title");



    flashNews[0].insertAdjacentElement("afterend", flashTitle[0]);
    flashNews[1].insertAdjacentElement("afterend", flashTitle[1]);
    flashNews[2].insertAdjacentElement("afterend", flashTitle[2]);

    let contBottom = document.querySelector("div[class='sp-module-content-bottom clearfix']");
    contBottom.classList.add("centerBlock");

    let spmodule = document.getElementsByClassName("sp-module")[6];
    spmodule.classList.add("col-md-7");


/////////////////////////


</script>

<script type="text/javascript">

// Функция для конвертации таблицы в формат CSV
function exportTableToCSV(filename) {
    var csv = [];
    var rows = document.querySelectorAll('table tr');
    
    for (var i = 0; i < rows.length; i++) {
        var row = [], cols = rows[i].querySelectorAll('td');
        
        for (var j = 0; j < cols.length; j++) {
            let col = cols[j].innerText;
          //  
            row.push(col + ';');
            
        }
         csv.push(row.toString().replace(',',''));
    }
   
    // Создание файла CSV
    var csvFile = csv.join('\n');
  
    // Создание ссылки для скачивания
    var link = document.createElement('a');
    link.setAttribute('href', "data:text/csv;charset=utf-8,%EF%BB%BF" + encodeURI(csvFile));
    link.setAttribute('download', filename);
    document.body.appendChild(link);
    link.click();

}

    // Нажатие на ссылку для скачивания файла
    let bt = document.getElementById('printcsv');
    bt.onclick = () =>{
        exportTableToCSV('111.csv');
         
    }


</script>
    <script>

        //var code = '<select class="selectpicker" style="color: fff; background: none; border: none; width: 200px; float: right;" data-size="5" onchange="doGTranslate(this.value)"> <option value="">Выбор языка</option><option style="color: black;" value="ru|ru"> </option><option style="color: black;" value="ru|be">Belarusian</option><option style="color: black;" value="ru|en">English</option></select></div><div class="lng_select notranslate"> </div><div id="google_translate_element"></div>';
        let bel = "ru|be";
        let rus = "ru|ru";
        let eng = "ru|en";
         //var code ='<div onclick="doGTranslate(rus)" style="cursor: pointer; margin-right: 8px;"><img style = "width: 28px; height:28px" src="images/rusicon.png"/></div> <div onclick="doGTranslate(bel)" style="cursor: pointer; margin-right: 8px;"><img  style = "width: 28px; height:28px" src="images/belicon.png"/></div><div onclick="doGTranslate(eng)" style="cursor: pointer; margin-right: 8px;"><img  style = "width: 28px; height:28px" src="images/engicon.png"/></div><div  class="lng_select notranslate"> </div><div id="google_translate_element"></div>';
        var code ='<div class = "langrubeeng"><div onclick="changelang(rus,this)" style="cursor: pointer; margin-right: 8px;"><div class = "actdiv">РУ</div></div> <div onclick="changelang(bel,this)" style="cursor: pointer; margin-right: 8px;"><div>БЕЛ</div></div><div onclick="changelang(eng,this)" style="cursor: pointer; margin-right: 8px;"><div>ENG</div></div><div  class="lng_select notranslate"> </div><div id="google_translate_element"></div></div>';
        let col3 = document.createElement("div");
        col3.className = "column";
        col3.innerHTML = code;
        col3.style = "display: inline-flex;";
        let top2 = document.getElementById("sp-top2");
        let row1 = top2.getElementsByClassName("row1")[0];
        row1.appendChild(col3);
      //  document.getElementById("sp-social").innerHTML = code;

        //функция подчеркивания
        let mainn = document.getElementById("mod-custom122").children[0];
        let main = mainn.children[2];

        function changelang(lang,element)
        {
            doGTranslate(lang);




            for (let i = 0 ; i<3 ; i++)
            {
                let ch = main.children[i];
                if (ch.children[0].classList.contains("actdiv"))
                {
                    ch.children[0].classList.remove("actdiv");

                }

            }

            let langdiv = element.children[0];
            langdiv.classList.add("actdiv");

        }

        let custom = document.getElementById("mod-custom123");
        let customch = custom.children[1];
        let customimg = customch.children[0];
        customimg.style = "margin-top: 7px;max-height: 24px;";


    </script>

    <script>

         let spmainb = document.getElementById("sp-main-body");
         let containerdiv = document.createElement("div");
         containerdiv.className = "container";
         const div = document.querySelector('div');

        var row = spmainb.getElementsByClassName("row")[0];


        console.log(row);

         console.log(div.classList.contains('container'));
         if ( div.classList.contains('container') == false )
         {


             spmainb.appendChild(containerdiv);
             containerdiv.appendChild(row);


             console.log("1");
         }// false


    </script>

    <style>
        .actdiv{
            text-decoration: underline;
        }

        ._access-icon  {

            background-image: url('/images/82x70/f/icon-eye.png');
            font-size: 0px !important;
            background-color: unset !important;
            top: 45px !important;
            left: 82% !important;
            width: 30px;
            height: 30px !important;
            position: absolute !important;
            box-shadow: none !important;
        }


        }
        .material-icons {
            font-family: '' !important;
        }
        </style>



</html>
