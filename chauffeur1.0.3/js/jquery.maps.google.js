   function initialize1() {
		var input = document.getElementById('depart');
		var options = {
				types: ['geocode'],
		  componentRestrictions: {country: 'fr'}
		};

		var autocomplete = new google.maps.places.Autocomplete(input, options);
		google.maps.event.addListener(autocomplete, 'place_changed', function() {
			var place = autocomplete.getPlace();

			//$('#selected').text("Place selected:" + place.address_components[6].long_name)
			});





      }


      function initialize2() {
		var input = document.getElementById('arrivee');
		var options = {
				types: ['geocode'],
		  componentRestrictions: {country: 'fr'}
		};

		autocomplete = new google.maps.places.Autocomplete(input, options);

      }

      function initialize3() {
  		var input = document.getElementById('departMise');
  		var options = {
  				types: ['geocode'],
  		  componentRestrictions: {country: 'fr'}
  		};

  		autocomplete = new google.maps.places.Autocomplete(input, options);

        }

