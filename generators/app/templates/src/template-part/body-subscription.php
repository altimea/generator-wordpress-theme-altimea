

<!--
Register mail into the plugins:
- CONCTACT FORM 7
- DATABASE CONTACT FORM


URL = /contact-form-7/v1/contact-forms/38/feedback
38 = IS ID FORM CONTACT

 -->
<section>
	<form
		action="<?php echo get_rest_url(null, '/contact-form-7/v1/contact-forms/38/feedback'); ?>"
		id='frm-main-subscription'>

		<input type="text" id="email_input" placeholder="ESCRIBE TU CORREO"/><br/>
		<input type="submit" name="send">
	</form>

	<script type="text/javascript">
		/**
		 * Register new subscriptor
		 */
		function registerNewSubscriptor() {
			var $form = $( '#frm-main-subscription' );
			var email = $form.find( 'input[id="email_input"]' ).val();
			var request = new XMLHttpRequest();

			var formData = new FormData();
			var urlPost = $( '#frm-main-subscription' ).attr( 'action' );

			formData.append( 'your-name', email );
			formData.append( 'your-email', email );

			request.open( 'POST', urlPost );
			request.send( formData );
		}
	</script>
</section>
