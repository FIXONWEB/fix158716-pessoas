<?php

add_action( 'admin_menu', 'fix158716_admin_menu_page' );
function fix158716_admin_menu_page (){
    add_menu_page( 
        'Pessoas',
        'Pessoas',
        'manage_options',
        'fix158716_admin_list',
        'fix158716_admin_list',
        plugins_url( 'myplugin/images/icon.png' ),
        6
    ); 
}
function fix158716_admin_list(){
    echo 'Pessoas'; 
    echo do_shortcode('[fix158716_list_by_admin]');
}





//--request
add_action( 'parse_request', 'fix158716_parse_request_by_admin');
function fix158716_parse_request_by_admin( &$wp ) {
	if($wp->request == 'fix158716_edit_by_admin'){
		$vai = 0;
		if(current_user_can('administrator')) $vai = 1;
		if(current_user_can('fix-administrativo')) $vai = 1;
		if(!$vai) {	return '<!--não disponivel-->';}
		echo do_shortcode('[fix158716_adm_edit]');
		exit;
	}

	if($wp->request == 'fix158716_insert_by_admin'){
		$vai = 0;
		// if(current_user_can('administrator')) $vai = 1;
		// if(current_user_can('fix-administrativo')) $vai = 1;
		// if(!$vai) {	return '<!--não disponivel-->';}

		$result = fix_001940_md_insert('fix158716',$_POST,'','');
		$ret['statusText'] = 'Cadastrado com sucesso';
		echo json_encode($ret);
		exit;
	}

	if($wp->request == 'fix158716_view_by_admin'){
		echo do_shortcode('[fix158716_view_by_admin]') ;
		exit;
	}

	if($wp->request == 'fix158716_mnut_by_admin'){
		$vai = 0;
		if(current_user_can('administrator')) $vai = 1;
		if(current_user_can('fix-administrativo')) $vai = 1;
		if(!$vai) {	echo '<!--não disponivel-->';exit;}
		echo do_shortcode('[fix158716_mnut_by_admin]');
		exit;
	}
	if($wp->request == 'fix158716_mnum_by_admin'){
		$vai = 0;
		if(current_user_can('administrator')) $vai = 1;
		// if(current_user_can('fix-administrativo')) $vai = 1;
		if(!$vai) {	return '<!--não disponivel-->';}
		echo do_shortcode('[fix158716_mnum_by_admin]');
		exit;
	}
	if($wp->request == 'fix158716_nnew_by_admin'){
		$vai = 0;
		if(current_user_can('administrator')) $vai = 1;
		if(current_user_can('fix-administrativo')) $vai = 1;
		if(!$vai) {	return '<!--não disponivel-->';}
		echo do_shortcode('[fix158716_nnew_by_admin]');
		exit();
	}

}






add_shortcode("fix158716_nnew_by_admin", "fix158716_nnew_by_admin");
function fix158716_nnew_by_admin($atts, $content = null){
	// $vai = 0;
	// if(current_user_can('administrator')) $vai = 1;
	// if(current_user_can('fix-administrativo')) $vai = 1;
	// if(!$vai) {	return '<!--não disponivel-->';}
	ob_start();
	?>
	<div style="margin:0px 10%;padding:10px;overflow: auto;height: 100%">
		<script type="text/javascript">
			jQuery(function($){
				$('#fix158716_nnew').on('submit',function(e){
					e.preventDefault();
					var dados = $( this ).serialize();
					var request = jQuery.ajax({
					    url: "<?php echo site_url() ?>/fix158716_insert_by_admin/",
					    type: "POST",
					    data: dados,
						dataType: "json"
					});
					request.always(function(resposta, textStatus) {
						if (textStatus != "success") {
							// console.log('fail');
							alert("Error: " + resposta.statusText); //error is always called .statusText
						 } else {
						 	console.log(resposta.statusText);
						 	// if ($(".fix158716_list")[0]){
						 	// 	$(".fix158716_list_dv_load").remove();
						 	// 	$(".fix158716_list_dv").parent().append('<div class="fix158716_list_dv_load"></div>');
						 	// 	$(".fix158716_list_dv").remove();
						 	// 	$(".fix158716_list_dv_load").parent().load('<?php echo site_url() ?>/fix158716_list/');
						 	// }
						 	// $('#fix158716_mnum_dv').remove();
						 	// $('#fix158716_mnum_mask').remove();

						 	// $('#fix158716_mnut_btn_nnew_dv').remove();
						 	// $('#fix158716_mnut_btn_nnew_mask').remove();
						 	window.location.reload();
						 }
					});					

				});
			});
		</script>
		<?php 
		//echo do_shortcode('[fix_001940_nnew md=fix158716  target_insert="#" un_show="
		//	fix158716_codigo 
		//	fix158716_data 
		//	fix158716_hora 
		//	fix158716_id_user 
		//	"
		//]');
		//echo '<pre>';
		//print_r(fix_001940_get_md_novo('fix158716'));
		//print_r(fix_001940_get_fields('fix158716'));
		//echo '</pre>';

		echo do_shortcode('[fix_001940_nnew md=fix158716  target_insert="#" un_show="
			fix158716_codigo 
			fix158716_data 
			fix158716_hora 
			fix158716_id_user 
			fix158716__foto 
			"
		]');

		?>
	</div>
	<?php 
	return ob_get_clean();
}

add_shortcode("fix158716_list_by_admin", "fix158716_list_by_admin");
function fix158716_list_by_admin($atts, $content = null){
	$vai = 0;
	if(current_user_can('administrator')) $vai = 1;
	if(current_user_can('fix-administrativo')) $vai = 1;
	if(!$vai) {	?>	<div style=""><a href="#">LOGIN</a></div>	<?php	return '';	}

	$vai = 0;
	if(current_user_can('administrator')) $vai = 1;
	// if(current_user_can('fix-administrativo')) $vai = 1;
	if(!$vai) {	return '<!--não disponivel-->';}
	ob_start();
	?>
	<div id="fix158716_list_dv" class="fix158716_list_dv">
		<style type="text/css">
			#fix158716_mnum_mask {
				position: fixed;
				top: 0px;
				left: 0px;
				width: 100%;
				height: 100%;
				background-color: rgba(0,0,0,0.5);
				z-index: 9990;
			}
			#fix158716_mnum_dv {
				position: absolute;
				left: 0px;
				margin-left: 0px;
				top: 0px;
				background-color: white;
				width: 200px;
				min-height: 30px;
				border: 1px solid gray;
				z-index: 9991;

				-moz-border-radius: 10px;
				-webkit-border-radius: 10px;
				border-radius: 10px;
				padding: 5px 10px;

				-moz-box-shadow: 5px 5px 10px gra;
				-webkit-box-shadow: 5px 5px 10px black;
				box-shadow: 5px 5px 10px black;

			}
			.clicado_ {
				background-color: silver;
			}
			.fix158716_list_ tr td {
				border:1px solid black;
			} 
		</style>
		<script type="text/javascript">
			var mousex = 0;
			var mousey = 0;
			jQuery("html").mousemove(function(mouse){
				mousex = mouse.pageX;
				mousey = mouse.pageY;
			});

			jQuery(function($){
				$('.fix158716_mnut').on('click',function(e){
					$('body').append('<div id="fix158716_mnum_mask"></div>');
					$('body').append('<div id="fix158716_mnum_dv">abrindo...</div>');
					$('#fix158716_mnum_dv').load('<?php echo site_url() ?>/fix158716_mnut_by_admin/');
					$('#fix158716_mnum_mask').on('click',function(e){
						$('#fix158716_mnum_mask').remove();
						$('#fix158716_mnum_dv').remove();
					});
					$('#fix158716_mnum_dv').css('left',mousex+'px');
					$('#fix158716_mnum_dv').css('top',mousey+'px');
				});
				$('.fix158716_mnum').on('click',function(e){
					var cod = $(this).parent().attr('data-codigo');
					console.log('fix158716_mnum: '+cod);
					$('body').append('<div id="fix158716_mnum_mask"></div>');
					$('body').append('<div id="fix158716_mnum_dv">abrindo...</div>');
					$('#fix158716_mnum_dv').load('<?php echo site_url() ?>/fix158716_mnum_by_admin/?cod='+cod);
					$('#fix158716_mnum_mask').on('click',function(e){
						$('#fix158716_mnum_mask').remove();
						$('#fix158716_mnum_dv').remove();
					});

					$('#fix158716_mnum_dv').css('left',mousex+'px');
					$('#fix158716_mnum_dv').css('top',mousey+'px');

				});
				$('.fix158716_list tr').on('click',function(){
					$( this ).toggleClass( "clicado" );
				});
			});
		</script>


			<?php
			echo do_shortcode('[fix158716_paged]');
			echo do_shortcode('[fix_001940_list 
				md=fix158716 
				col_x0="..." 
				col_xt="..." 
				un_show="fix158716_codigo fix158716_data fix158716_hora fix158716_foto " 
				col__url="fix158716_nome_completo,<a href=../detalhes/?cod=__fix158716_codigo__>__this__</a>"
			]');
			?>

		</div>




		
	<?php
	

	return ob_get_clean();
}


add_shortcode("fix158716_mnum_by_admin", "fix158716_mnum_by_admin");
function fix158716_mnum_by_admin($atts, $content = null){
	$vai = 0;
	if(current_user_can('administrator')) $vai = 1;
	if(current_user_can('fix-administrativo')) $vai = 1;
	if(!$vai) {	?>	<div style=""><a href="#">LOGIN</a></div>	<?php	return '';	}

	global $wpdb;
	$cod = isset($_GET['cod']) ? $_GET['cod'] : 0;
	?>
	<style type="text/css">
		#fix158716_mnum_btn_view_mask {
			position: fixed;
			top: 0px;
			left: 0px;
			width: 100%;
			height: 100%;
			background-color: rgba(0,0,0,0.5);
			z-index: 9993;
		}
		#fix158716_mnum_btn_view_dv {
			position: fixed;
			left: 30vw;
			top: 10vh;
			background-color: white;
			width: 40vw;
			height: 80vh;
			border: 1px solid gray;
			z-index: 9994;
			overflow: auto;

			-moz-border-radius: 10px;
			-webkit-border-radius: 10px;
			border-radius: 10px;
			padding: 5px 10px;

			-moz-box-shadow: 5px 5px 10px gra;
			-webkit-box-shadow: 5px 5px 10px black;
			box-shadow: 5px 5px 10px black;

		}

		#fix158716_mnum_btn_editar_mask {
			position: fixed;
			top: 0px;
			left: 0px;
			width: 100%;
			height: 100%;
			background-color: rgba(0,0,0,0.5);
			z-index: 9993;
		}
		#fix158716_mnum_btn_editar_dv {
			position: fixed;
			left: 30vw;
			top: 10vh;
			background-color: white;
			width: 40vw;
			height: 80vh;
			border: 1px solid gray;
			z-index: 9994;
			overflow: auto;

			-moz-border-radius: 10px;
			-webkit-border-radius: 10px;
			border-radius: 10px;
			padding: 5px 10px;

			-moz-box-shadow: 5px 5px 10px gra;
			-webkit-box-shadow: 5px 5px 10px black;
			box-shadow: 5px 5px 10px black;

		}
		@media (max-width: 600px) {
			#fix158716_mnum_btn_editar_dv {
				left: 5vw;
				width: 90vw;
				top: 5vh;
				min-height: 200px;
			}
		}


		#fix158716_mnum_btn_deletar_mask {
			position: fixed;
			top: 0px;
			left: 0px;
			width: 100%;
			height: 100%;
			background-color: rgba(0,0,0,0.5);
			z-index: 9993;
		}
		#fix158716_mnum_btn_deletar_dv {
			position: fixed;
			left: 50%;
			margin-left: -250px;
			top: 100px;
			background-color: white;
			width: 500px;
			min-height: 300px;
			border: 1px solid gray;
			z-index: 9994;

			-moz-border-radius: 10px;
			-webkit-border-radius: 10px;
			border-radius: 10px;
			padding: 5px 10px;

			-moz-box-shadow: 5px 5px 10px gra;
			-webkit-box-shadow: 5px 5px 10px black;
			box-shadow: 5px 5px 10px black;

		}
	</style>
	<script type="text/javascript">
		jQuery(function($){
			$('#fix158716_mnum_btn_deletar').on('click',function(e){
				e.preventDefault();
				var cod = $(this).attr('data-cod');
				// console.log('fix158716_mnum_btn_deletar: '+cod);
				$('body').append('<div id="fix158716_mnum_btn_deletar_mask"></div>');
				$('body').append('<div id="fix158716_mnum_btn_deletar_dv">abrindo...</div>');
				$('#fix158716_mnum_btn_deletar_dv').load('<?php echo site_url() ?>/fix158716_deletar/?cod='+cod);
				$('#fix158716_mnum_btn_deletar_mask').on('click',function(e){
					$('#fix158716_mnum_btn_deletar_mask').remove();
					$('#fix158716_mnum_btn_deletar_dv').remove();

					$('#fix158716_mnum_mask').remove();
					$('#fix158716_mnum_dv').remove();

				});

			});

			$('#fix158716_mnum_btn_view').on('click',function(e){
				e.preventDefault();
				var cod = $(this).attr('data-cod');
				// console.log('fix158716_mnum_btn_view: '+cod);
				$('body').append('<div id="fix158716_mnum_btn_view_mask"></div>');
				$('body').append('<div id="fix158716_mnum_btn_view_dv">abrindo...</div>');
				$('#fix158716_mnum_btn_view_dv').load('<?php echo site_url() ?>/fix158716_view_by_admin/?cod='+cod);
				$('#fix158716_mnum_btn_view_mask').on('click',function(e){
					$('#fix158716_mnum_btn_view_mask').remove();
					$('#fix158716_mnum_btn_view_dv').remove();
					$('#fix158716_mnum_mask').remove();
					$('#fix158716_mnum_dv').remove();
				});
			});

			$('#fix158716_mnum_btn_editar').on('click',function(e){
				e.preventDefault();
				var cod = $(this).attr('data-cod');
				// console.log('fix158716_mnum_btn_editar: '+cod);
				$('body').append('<div id="fix158716_mnum_btn_editar_mask"></div>');
				$('body').append('<div id="fix158716_mnum_btn_editar_dv">abrindo...</div>');
				$('#fix158716_mnum_btn_editar_dv').load('<?php echo site_url() ?>/fix158716_edit_by_admin/?cod='+cod);
				$('#fix158716_mnum_btn_editar_mask').on('click',function(e){
					$('#fix158716_mnum_btn_editar_mask').remove();
					$('#fix158716_mnum_btn_editar_dv').remove();
					$('#fix158716_mnum_mask').remove();
					$('#fix158716_mnum_dv').remove();
				});
			});
			$('#fix158716_mnum_btn_nnew').on('click',function(e){
				e.preventDefault();
				var cod = $(this).attr('data-cod');
				// console.log('fix158716_mnum_btn_editar: '+cod);
				$('body').append('<div id="fix158716_mnum_btn_editar_mask"></div>');
				$('body').append('<div id="fix158716_mnum_btn_editar_dv">abrindo...</div>');
				$('#fix158716_mnum_btn_editar_dv').load('<?php echo site_url() ?>/fix158716_nnew/');
				$('#fix158716_mnum_btn_editar_mask').on('click',function(e){
					$('#fix158716_mnum_btn_editar_mask').remove();
					$('#fix158716_mnum_btn_editar_dv').remove();
					$('#fix158716_mnum_mask').remove();
					$('#fix158716_mnum_dv').remove();
				});
			});



		});
	</script>
	<!--div><a id="fix158716_mnum_btn_detalhes" data-cod="<?php echo $cod ?>" href="../detalhes/?cod=<?php echo $cod ?>">DETALHES</a></div-->
	<div><a id="fix158716_mnum_btn_view" data-cod="<?php echo $cod ?>" href="#">DETALHES</a></div>
	<div><a id="fix158716_mnum_btn_editar" data-cod="<?php echo $cod ?>" href="#">EDITAR</a></div>
	<div><a id="fix158716_mnum_btn_deletar" data-cod="<?php echo $cod ?>" href="#">DELETAR</a></div>

	<?php
}



add_shortcode("fix158716_mnut_by_admin", "fix158716_mnut_by_admin");
function fix158716_mnut_by_admin($atts, $content = null){
	$vai = 0;
	if(current_user_can('administrator')) $vai = 1;
	if(current_user_can('fix-administrativo')) $vai = 1;
	if(!$vai) {	?>	<div style=""><a href="#">LOGIN</a></div>	<?php	return '';	}

	ob_start();
	?>
	<style type="text/css">
		#fix158716_mnut_btn_nnew_mask {
			position: fixed;
			top: 0px;
			left: 0px;
			width: 100%;
			height: 100%;
			background-color: rgba(0,0,0,0.5);
			z-index: 9993;
		}
		#fix158716_mnut_btn_nnew_dv {
			position: absolute;
			left: 30vw;
			top: 20vh;
			background-color: white;
			width: 40vw;
			min-height: 300px;
			border: 1px solid gray;
			z-index: 9994;

			-moz-border-radius: 10px;
			-webkit-border-radius: 10px;
			border-radius: 10px;
			padding: 5px 10px;

			-moz-box-shadow: 5px 5px 10px gra;
			-webkit-box-shadow: 5px 5px 10px black;
			box-shadow: 5px 5px 10px black;
		}
		@media (max-width: 600px) {
			#fix158716_mnut_btn_nnew_dv {
				left: 5vw;
				width: 90vw;
				top: 5vh;
				min-height: 200px;
			}
		}

	</style>
	<script type="text/javascript">
		jQuery(function($){
			$('#fix158716_mnut_btn_nnew').on('click',function(e){
				e.preventDefault();
				$('body').append('<div id="fix158716_mnut_btn_nnew_mask"></div>');
				$('body').append('<div id="fix158716_mnut_btn_nnew_dv">abrindo...</div>');
				$('#fix158716_mnut_btn_nnew_dv').load('<?php echo site_url() ?>/fix158716_nnew_by_admin/');
				$('#fix158716_mnut_btn_nnew_mask').on('click',function(e){
					$('#fix158716_mnut_btn_nnew_mask').remove();
					$('#fix158716_mnut_btn_nnew_dv').remove();
					$('#fix158716_mnut_mask').remove();
					$('#fix158716_mnut_dv').remove();
				});
			});
			$('#fix158716_mnut_btn_buscar').on('click',function(e){
				e.preventDefault();
				$('body').append('<div id="fix158716_mnut_btn_nnew_mask"></div>');
				$('body').append('<div id="fix158716_mnut_btn_nnew_dv">abrindo...</div>');
				$('#fix158716_mnut_btn_nnew_dv').load('<?php echo site_url() ?>/fix158716_buscar_by_admin/');
				$('#fix158716_mnut_btn_nnew_mask').on('click',function(e){
					$('#fix158716_mnut_btn_nnew_mask').remove();
					$('#fix158716_mnut_btn_nnew_dv').remove();
					$('#fix158716_mnut_mask').remove();
					$('#fix158716_mnut_dv').remove();
				});
			});
			$('#fix158716_mnut_btn_limpar_tabela').on('click',function(e){
				e.preventDefault();
				$('body').append('<div id="fix158716_mnut_btn_nnew_mask"></div>');
				$('body').append('<div id="fix158716_mnut_btn_nnew_dv">abrindo...</div>');
				$('#fix158716_mnut_btn_nnew_dv').load('<?php echo site_url() ?>/fix158716_limpar_tabela/');
				$('#fix158716_mnut_btn_nnew_mask').on('click',function(e){
					$('#fix158716_mnut_btn_nnew_mask').remove();
					$('#fix158716_mnut_btn_nnew_dv').remove();
					$('#fix158716_mnut_mask').remove();
					$('#fix158716_mnut_dv').remove();
				});
			});
			$('#fix158716_mnut_btn_importar_tabela').on('click',function(e){
				e.preventDefault();
				$('body').append('<div id="fix158716_mnut_btn_nnew_mask"></div>');
				$('body').append('<div id="fix158716_mnut_btn_nnew_dv">abrindo...</div>');
				$('#fix158716_mnut_btn_nnew_dv').load('<?php echo site_url() ?>/fix158716_importar_tabela/');
				$('#fix158716_mnut_btn_nnew_mask').on('click',function(e){
					$('#fix158716_mnut_btn_nnew_mask').remove();
					$('#fix158716_mnut_btn_nnew_dv').remove();
					$('#fix158716_mnut_mask').remove();
					$('#fix158716_mnut_dv').remove();
				});
			});
			$('#fix158716_mnut_btn_exportar_tabela').on('click',function(e){
				e.preventDefault();
				$('body').append('<div id="fix158716_mnut_btn_nnew_mask"></div>');
				$('body').append('<div id="fix158716_mnut_btn_nnew_dv">abrindo...</div>');
				$('#fix158716_mnut_btn_nnew_dv').load('<?php echo site_url() ?>/fix158716_exportar_tabela/');
				$('#fix158716_mnut_btn_nnew_mask').on('click',function(e){
					$('#fix158716_mnut_btn_nnew_mask').remove();
					$('#fix158716_mnut_btn_nnew_dv').remove();
					$('#fix158716_mnut_mask').remove();
					$('#fix158716_mnut_dv').remove();
				});
			});




		});
	</script>
	<div><a id="fix158716_mnut_btn_nnew" href="#">NOVO</a></div>
	<div><a id="fix158716_mnut_btn_buscar" href="#">BUSCAR</a></div>
	<div><a id="fix158716_mnut_btn_limpar_tabela" href="#">LIMPAR TABELA</a></div>
	<div><a id="fix158716_mnut_btn_importar_tabela" href="#">IMPORTAR TABELA</a></div>
	<div><a id="fix158716_mnut_btn_exportar_tabela" href="#">EXPORTAR TABELA</a></div>
	<div><a id="fix158716_mnut_btn__exportar_tabela" href="<?php echo site_url() ?>/fix158716_exportar_tabela_y">-----EXPORTAR TABELA</a></div>
	<?php
	return ob_get_clean();
}



add_shortcode("fix158716_view_foto_by_admin", "fix158716_view_foto_by_admin");
function fix158716_view_foto_by_admin($atts, $content = null){
	$vai = 0;
	if(current_user_can('administrator')) $vai = 1;
	if(current_user_can('fix-administrativo')) $vai = 1;
	if(!$vai) {	?>	<div style=""><a href="#">LOGIN</a></div>	<?php	return '';	}

	ob_start();
	$cod = isset($_GET['cod']) ? $_GET['cod'] : '';
	$sql = "select fix158716_foto from ".$GLOBALS['wpdb']->prefix."fix158716 where fix158716_codigo = ".$cod.";";
	$tb = fix_001940_db_exe($sql,'rows');
	$foto = $tb['rows'][0]['fix158716_foto'];
	// echo "-- $foto --";
	?>
	<div style="width: 100%; height:300px; background: url(<?=$foto ?>);background-size: contain;background-repeat: no-repeat;"></div>
	<?php
	return ob_get_clean();
}

add_shortcode("fix158716_edit_by_admin", "fix158716_edit_by_admin");
function fix158716_edit_by_admin($atts, $content = null){
	$vai = 0;
	if(current_user_can('administrator')) $vai = 1;
	if(current_user_can('fix-administrativo')) $vai = 1;
	if(!$vai) {	?>	<div style=""><a href="#">LOGIN</a></div>	<?php	return '';	}

	$cod = isset($_GET['cod']) ? $_GET['cod'] : 0;
	?>
	<script type="text/javascript">
		jQuery(function($){
			$('#fix158716_edit').on('submit',function(e){
				e.preventDefault();
				console.log('fix158716_edit: <?php echo $cod ?>');
				var dados = $( this ).serialize();
				var request = jQuery.ajax({
				    url: "<?php echo site_url() ?>/fix158716_update_by_admin/?cod="+<?php echo $cod ?>,
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

add_shortcode("fix158716_view_by_admin", "fix158716_view_by_admin");
function fix158716_view_by_admin($atts, $content = null){
	$vai = 0;
	if(current_user_can('administrator')) $vai = 1;
	if(current_user_can('fix-administrativo')) $vai = 1;
	if(!$vai) {	?>	<div style=""><a href="#">LOGIN</a></div>	<?php	return '';	}

	
	echo do_shortcode('[fix158716_view_foto_by_admin]');
	echo do_shortcode('[fix158716_form_upload_foto]');
	echo do_shortcode('[fix_001940_view md="fix158716" cod=__cod__ un_show="fix158716_codigo fix158716_data fix158716_hora fix158716_status "]');
	
}


// add_shortcode("fix158716_view_by_admin", "fix158716_view_by_admin");
// function fix158716_view_by_admin($atts, $content = null){
// 	echo do_shortcode('[fix_001940_view md="fix158716" cod=__cod__ un_show="fix158716_codigo fix158716_data fix158716_hora fix158716_status "]');
	
// }
