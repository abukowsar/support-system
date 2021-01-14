<script>

	(function($) { 

	    "use strict"; 
	    
	    @if(Session::has('success'))
	        Snackbar.show({text: '{{ _t(Session::get('success')) }}', pos: 'bottom-center'});
	    @endif

	    @if(Session::has('errors'))
	        Snackbar.show({text: '{{ _t($errors->first()) }}', pos: 'bottom-center'});
	    @endif

	    @if(isset($errors) && is_array($errors) && $errors->any())
	        Snackbar.show({text: '{{ _t($errors->first()) }}', pos: 'bottom-center'});
	    @endif

	})(jQuery); 

</script>
