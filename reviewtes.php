<!DOCTYPE html>
<html>
<head>
	<title>Tes</title>
</head>
<body>

</body>
</html>

<div id="google-reviews"></div>

<link rel="stylesheet" href="https://cdn.rawgit.com/stevenmonson/googleReviews/master/google-places.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdn.rawgit.com/stevenmonson/googleReviews/6e8f0d79/google-places.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyAipJSjfkVSMGCmL10xbDjrJyTCxL3Uslc&signed_in=true&libraries=places"></script>

<script>
jQuery(document).ready(function( $ ) {
   $("#google-reviews").googlePlaces({
        placeId: 'ChIJs6ReA8queC4RE_uBzSqTvhE', //Find placeID @: https://developers.google.com/places/place-id
        render: ['reviews'],
        min_rating: 1,
        max_rows:100,
   });
});

</script>
