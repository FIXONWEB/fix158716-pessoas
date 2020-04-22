<?php
add_shortcode("fix158716_adm_edit", "fix158716_adm_edit");
function fix158716_adm_edit($atts, $content = null){
	$cod = isset($_GET['cod']) ? $_GET['cod'] : 0;
	?>
	<script type="text/javascript">
		jQuery(function($){
			$('#fix158716_edit').on('submit',function(e){
				e.preventDefault();
				console.log('fix158716_edit: <?php echo $cod ?>');
				var dados = $( this ).serialize();
				var request = jQuery.ajax({
				    url: "<?php echo site_url() ?>/fix158716_adm_update/?cod="+<?php echo $cod ?>,
				    type: "POST",
				    data: dados+'&cod='+<?php echo $cod ?>,
					dataType: "json"
				});
				request.always(function(resposta, textStatus) {
					if (textStatus != "success") {
						console.log('fail');
						alert("Error: " + resposta.statusText); //error is always called .statusText
					 } else {
					 	// console.log(resposta.statusText);
					 	// if ($(".fix158716_list")[0]){
					 	// 	console.log('tem');
					 	// 	$(".fix158716_list_dv_load").remove();
					 	// 	$(".fix158716_list_dv").parent().append('<div class="fix158716_list_dv_load"></div>');
					 	// 	$(".fix158716_list_dv").remove();
					 	// 	$(".fix158716_list_dv_load").parent().load('<?php echo site_url() ?>/fix158716_list/');
					 	// }
					 	// $('#fix158716_mnum_btn_editar_mask').remove();
					 	// $('#fix158716_mnum_btn_editar_dv').remove();
					 	// $('#fix158716_mnum_mask').remove();
					 	// $('#fix158716_mnum_dv').remove();
					 	window.location.reload();
					 }
				});
			});		
		});
	</script>
	<?php
	echo do_shortcode('[fix_001940_edit md=fix158716 cod=__cod__ target_update="#" un_show="
		fix158716_codigo 
		fix158716_data 
		fix158716_hora 
		fix158716_foto 
		"
	]');
}
