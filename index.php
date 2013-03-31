<!doctype>
<style>
div#slider {
	width: 642px;
	overflow: hidden;
	position: relative;
	border: 1px dotted #000;
}
div#slider ul {
	padding: 0;
	margin: 0;
	list-style: none;
	width: 6400px;
	height: 200px;
	position: relative;
}
div#slider ul li {
	height: 425px;
	width: 640px;
	border: 1px solid #000;
	float: left;
	overflow: hidden;
}
</style>
<script type="text/javascript" src="http://www.noobtutorials.nl/voorbeelden/jquery.js"></script>
<script type="text/javascript">
$( function () {
	$data = {}; // Object aanmaken
	$data.method = 'flickr.photosets.getPhotos';
	$data.api_key = 'b6ac8e66d32732dd535a167be20eedb6';
	$data.photoset_id = '72157610011797194';
	$data.format = 'json';
	
	$.ajax({
		url: 'http://api.flickr.com/services/rest/?jsoncallback=?',
		data: $data,
		type: 'GET',
		dataType: 'jsonp',
		success: function (data) {
			$html = '';
			$.each( data.photoset.photo, function(index, photo) {
				photo.url = create_flickr_url(photo);
				
				$html += '<li><img src="' + photo.url + '"></li>';
			});
			
			$("#slider ul").html( $html );
			
			$slider.start(); // Deze mag pas aangeroepen worden zodra er een reactie is geweest van Flickr en deze ook verwerkt is. Op deze plek is dat het geval.
		}
	});
	
	$slider = {
		currentFrame: 1,
		slideSpeed: 3000,
		animateSpeed: 1000,
		slide: function () {
			$slider.currentFrame = ($slider.currentFrame >= $("div#slider ul li").length ? 1 : $slider.currentFrame+1);
			
			$("div#slider ul").animate({
				left: ( '-' + $("div#slider ul li:eq(" + ($slider.currentFrame-1) + ")").position().left )
			}, $slider.animateSpeed);
		},
		start: function() {
			$interval = setInterval( function () {
				$slider.slide();
			}, $slider.slideSpeed);
		}
	};
});

function create_flickr_url(photoData, size) {
	switch(size) {
		case 'small-square':
			photoData.size = 's'; // small square 75x75
		break;
		case 'square':
		case 'large-square':
			photoData.size = 'q'; // large square 150x150
		break;
		case 'thumbnail':
			photoData.size = 't'; // thumbnail, 100 on longest side
		break;
		case 'small-240':
			photoData.size = 'm'; // small, 240 on longest side
		break;
		case 'small':
		case 'small-320':
			photoData.size = 'n'; // small, 320 on longest side
		break;
		case 'medium-500':
			photoData.size = '-'; // medium, 500 on longest side
		break;
		default:
		case 'medium':
		case 'medium-640':
			photoData.size = 'z'; // medium 640, 640 on longest side
		break;
		case 'medium-800':
			photoData.size = 'c'; // medium 800, 800 on longest side†
		break;
		case 'large':
			photoData.size = 'b'; // large, 1024 on longest side*
		break;
		case 'original':
			photoData.size = 'o'; // original image, either a jpg, gif or png, depending on source format
		break;
	}
	
	return 'http://farm' + photoData.farm + '.staticflickr.com/' + photoData.server + '/' + photoData.id + '_' + photoData.secret + '_' + photoData.size + '.jpg';
}
</script>

<div id="slider"><ul></ul></div>