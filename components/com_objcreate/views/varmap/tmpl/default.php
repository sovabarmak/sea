<?php
// Запрет прямого доступа.
defined('_JEXEC') or die;
//print_r($this->items);
$lt = 46.709089;
$lg = 38.276208;
if ($this->idd <> 'contacts') {
$lat = $this->items[0]->lat;
$lng = $this->items[0]->lng;
} else {
	$lat = $lt;
	$lng = $lg;
}
?>

<div id="maps" style="width:auto; height:<?php if (isset($this->height)) echo $this->height; else echo "500";?>px; max-width:100%;"></div>
        <script type="text/javascript">
		 var mapSettings = {
                type:'yandex#map',
                controls: ['zoomControl'],
                center: [ <?php echo $lat  ?>, <?php echo $lng ?> ],
                zoom: 14};

		var linkText = 'Перейти на страницу объекта';

		 var placemarks = [
         <?php if ($this->idd <> 'contacts') { foreach ($this->items as $item) {
			$img = $item->nums[0]->photos[0];
			$desc_full = $item->inf_text;
			$desc_full = str_replace("\n", "", $desc_full);
			$desc_full = str_replace("\r", "", $desc_full);
			$desc_full = strip_tags($desc_full);
			$arr = explode(" ", $desc_full);
			$desc = "";
			foreach($arr as $v) {
				$desc .= $v.' ';
                if(strlen($desc) > 200) {
					break;
				}
			}
		 ?>
								{
                    'coords':[  <?php echo $item->lat  ?>, <?php echo $item->lng ?> ],
                    'iconImageHref': '	<?php switch ($item->catid) {
    case 2:
        echo "/images/markers/gostinici.png";
        break;
    case 3:
        echo "/images/markers/pansionati.png";
        break;
    case 4:
        echo "/images/markers/kvartiri.png";
        break;
	case 5:
        echo "/images/markers/domapodkluch.png";
        break;
    case 6:
        echo "/images/markers/gosteviedoma.png";
        break;
    case 7:
        echo "/images/markers/chastniysektor.png";
        break;
	case 8:
        echo "/images/markers/vodnik.png";
        break;
    case 9:
        echo "/images/markers/komnati.png";
        break;
    case 12:
        echo "/images/markers/pospeshi.png";
        break;
} ?> ',
                    'iconImageSize': [41, 47],
                    'iconImageOffset': [-16, -36],
                    'title':'<?php echo $item->name ?>',
                    'image':'<?php echo $this->baseurl.'/'.$img->folder.'/ts_'.$img->file?>',
                    'description':'<?php echo $desc ?>',
                    'link':'index.php?option=com_objcreate&view=variant&id=<?php echo $item->id ?>',
                },
		 <?php } } else { ?>
		 {
                    'coords':[  <?php echo $lt  ?>, <?php echo $lg ?> ],
                    'iconImageHref': '/images/markers/ya.png',
                    'iconImageSize': [37, 42],
                    'iconImageOffset': [-16, -36],
                    'title':'Агентство "Ейск-Море.ру"',
                    'image':'/templates/eisksea/images/futer_logo.png',
                    'description':'',
                    'link':'',
            }
			<?php } ?>
				];
		</script>
		<a title="Просмотреть на Google Maps" class="map_btn google" href="http://www.eisk-sea.ru/maps.html?id=<?php echo $this->idd; ?>&layout=google<?php if (isset($this->height)) echo "&height=".$this->height; ?>"></a>
		<script type="text/javascript" src="http://eisk-sea.ru/components/com_objcreate/views/varmap/yandex.js"></script>