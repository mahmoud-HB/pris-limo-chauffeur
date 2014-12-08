	 $(document).ready(function() {
		    $(".fr").click(function() {
		    	 var lang = "fr_FR";
				    $.post("fr.php", {"input": lang});

		    });

		});

	 $(document).ready(function() {
		    $(".en").click(function() {
		    	 var lang = "en_US";
				    $.post("en.php", {"input": lang});
		    });
		});
