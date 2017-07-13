/**
 * File custom.js.
 *
 * Theme enhancements for a better user experience.
 */

// POPUPboxes for logged in users - auto fill title with timestamp for uniqueness. 
(function ($) {

  var now = jQuery.now();
  var default_now =  $('#input_1_2').val();
  $('#input_1_2').val(default_now+'_status_'+now);

  var default_now =  $('#input_2_1').val();
  $('#input_2_1').val(default_now+'_pb_'+now);

  $('.update_wod').on('click', function(event) {
	event.preventDefault();
	var gtarget = $(this).attr('href');
	$(gtarget).toggleClass('show');
  });

  $('.close').on('click', function(event) {
	event.preventDefault();
	$(this).parent().removeClass('show');
  });

})(jQuery);

// TABS

(function() {
    jQuery('.tabs .tab-links a').on('click', function(e)  {
        var currentAttrValue = jQuery(this).attr('href');
 
        // Show/Hide Tabs
        jQuery('.tabs ' + currentAttrValue).show().siblings().hide();
 
        // Change/remove current tab to active
        jQuery(this).parent('li').addClass('active').siblings().removeClass('active');
 
        e.preventDefault();
    });
})(jQuery);


// SCROLLING HEADER
(function ($) {

	jQuery(window).scroll(function() {    
		var scroll = $(window).scrollTop();
		if (scroll >= 1) {
			$("#masthead").addClass("darkHeader");
		} else {
			$("#masthead").removeClass("darkHeader");
		}
	});

})(jQuery);


// programme info

(function ($) {

	$(".programme-info header").on('click', function(event) {
		event.preventDefault();
		$(this).next('section').toggleClass('show');
	});

})(jQuery);


//	DISCUSS COMMENTS
var disqus_shortname = 'bullpen-fitness';
var disqus_identifier;
var disqus_url;

// Loads the Disqus JS file that will create the comment form and threads.
var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
dsq.src = 'https://' + disqus_shortname + '.disqus.com/embed.js'; // Found in disqus.js script
jQuery('head').append(dsq);

// Called in each location you want to show the thread.

// Disqus searches for 'disqus-thread' elements and uses the first one it finds so to
// overcome this, the function will clear any previous comment threads (by finding 'comments-load' elements)
// 
function loadDisqus(element, postTitle, postUrlTag, postID) {
  var identifier = postTitle;

  // Including the hashbang ('/#!') is important.
  var url = window.location.origin + '/#!' + postUrlTag;

  var disqus_identifier = identifier;
  var disqus_url = url;

  if (window.DISQUS) {
	// Horrible, but jQuery wasn't removing the div elements fully
	$( ".comments-load" ).each(function() {
	  var len = this.childNodes.length;
	  for(var i = 0; i < len; i++)
	  {  
		if (this.childNodes[i].tagName == "DIV") {
		  this.removeChild(this.childNodes[i]);
		} 
	  }
	});

	$(element).append('<div class="disqus-thread" id="disqus_thread"></div>');

	/** if Disqus exists, call it's reset method with new parameters **/
	DISQUS.reset({
	  reload: true,
	  config: function () { 
		//important to convert it to string
		this.page.identifier = identifier.toString();    
		this.page.url = url;
	  }
	});
  }
};



// GOOGLE MAPS
(function($) {

	/*
	*  new_map
	*
	*  This function will render a Google Map onto the selected jQuery element
	*
	*  @type  function
	*  @date  8/11/2013
	*  @since 4.3.0
	*
	*  @param $el (jQuery element)
	*  @return  n/a
	*/

	function new_map( $el ) {
	  
	  // var
	  var $markers = $el.find('.marker');
	  
	  
	  // vars
	  var args = {
		zoom    : 16,
		center    : new google.maps.LatLng(0, 0),
		mapTypeId : google.maps.MapTypeId.ROADMAP
	  };
	  
	  
	  // create map           
	  var map = new google.maps.Map( $el[0], args);
	  
	  
	  // add a markers reference
	  map.markers = [];
	  
	  
	  // add markers
	  $markers.each(function(){
		
		  add_marker( $(this), map );
		
	  });
	  
	  
	  // center map
	  center_map( map );
	  
	  
	  // return
	  return map;
	  
	}

	/*
	*  add_marker
	*
	*  This function will add a marker to the selected Google Map
	*
	*  @type  function
	*  @date  8/11/2013
	*  @since 4.3.0
	*
	*  @param $marker (jQuery element)
	*  @param map (Google Map object)
	*  @return  n/a
	*/

	function add_marker( $marker, map ) {

	  // var
	  var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );

	  // create marker
	  var marker = new google.maps.Marker({
		position  : latlng,
		map     : map
	  });

	  // add to array
	  map.markers.push( marker );

	  // if marker contains HTML, add it to an infoWindow
	  if( $marker.html() )
	  {
		// create info window
		var infowindow = new google.maps.InfoWindow({
		  content   : $marker.html()
		});

		// show info window when marker is clicked
		google.maps.event.addListener(marker, 'click', function() {

		  infowindow.open( map, marker );

		});
	  }

	}

	/*
	*  center_map
	*
	*  This function will center the map, showing all markers attached to this map
	*
	*  @type  function
	*  @date  8/11/2013
	*  @since 4.3.0
	*
	*  @param map (Google Map object)
	*  @return  n/a
	*/

	function center_map( map ) {

	  // vars
	  var bounds = new google.maps.LatLngBounds();

	  // loop through all markers and create bounds
	  $.each( map.markers, function( i, marker ){

		var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );

		bounds.extend( latlng );

	  });

	  // only 1 marker?
	  if( map.markers.length == 1 )
	  {
		// set center of map
		  map.setCenter( bounds.getCenter() );
		  map.setZoom( 16 );
	  }
	  else
	  {
		// fit to bounds
		map.fitBounds( bounds );
	  }

	}

	/*
	*  document ready
	*
	*  This function will render each map when the document is ready (page has loaded)
	*
	*  @type  function
	*  @date  8/11/2013
	*  @since 5.0.0
	*
	*  @param n/a
	*  @return  n/a
	*/
	// global var
	var map = null;

	(function(){

	  $('.map').each(function(){

		// create map
		map = new_map( $(this) );

	  });

	});

})(jQuery);