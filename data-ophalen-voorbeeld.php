<script type="text/javascript" src="/voorbeelden/jquery.js"></script>
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
			console.log( 'data', data );
			console.log( 'data.photoset', data.photoset );
			console.log( 'data.photoset.photo', data.photoset.photo );
		}
	});
});
</script>
Kijk in je console (F12 -> console) om te zien wat voor data er wordt opgehaald.