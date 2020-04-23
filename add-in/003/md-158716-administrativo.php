<?php

add_shortcode("fix158716_adm_mnut", "fix158716_adm_mnut");
function fix158716_adm_mnut($atts, $content = null){
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
				$('#fix158716_mnut_btn_nnew_dv').load('<?php echo site_url() ?>/fix158716_nnew/');
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
				$('#fix158716_mnut_btn_nnew_dv').load('<?php echo site_url() ?>/fix158716_buscar/');
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
	<?php
	return ob_get_clean();
}
add_shortcode("fix158716_adm_mnum", "fix158716_adm_mnum");
function fix158716_adm_mnum($atts, $content = null){

	global $wpdb;
	$cod = isset($_GET['cod']) ? $_GET['cod'] : 0;
	?>
	<style type="text/css">
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
				$('#fix158716_mnum_btn_deletar_dv').load('<?php echo site_url() ?>/fix158716_adm_deletar/?cod='+cod);
				$('#fix158716_mnum_btn_deletar_mask').on('click',function(e){
					$('#fix158716_mnum_btn_deletar_mask').remove();
					$('#fix158716_mnum_btn_deletar_dv').remove();

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
				$('#fix158716_mnum_btn_editar_dv').load('<?php echo site_url() ?>/fix158716_adm_edit/?cod='+cod);
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
				$('#fix158716_mnum_btn_editar_dv').load('<?php echo site_url() ?>/fix158716_adm_nnew/');
				$('#fix158716_mnum_btn_editar_mask').on('click',function(e){
					$('#fix158716_mnum_btn_editar_mask').remove();
					$('#fix158716_mnum_btn_editar_dv').remove();
					$('#fix158716_mnum_mask').remove();
					$('#fix158716_mnum_dv').remove();
				});
			});



		});
	</script>
	<div><a id="fix158716_mnum_btn_detalhes" data-cod="<?php echo $cod ?>" href="../detalhes/?cod=<?php echo $cod ?>">DETALHES</a></div>
	<div><a id="fix158716_mnum_btn_editar" data-cod="<?php echo $cod ?>" href="#">EDITAR</a></div>
	<div><a id="fix158716_mnum_btn_deletar" data-cod="<?php echo $cod ?>" href="#">DELETAR</a></div>

	<?php
}
add_shortcode("fix158716_adm_list", "fix158716_adm_list");
function fix158716_adm_list($atts, $content = null){
	$vai = 0;
	if(current_user_can('administrator')) $vai = 1;
	if(current_user_can('fix-administrativo')) $vai = 1;
	if(!$vai) {	?>	<div style=""><a href="#">LOGIN</a></div>	<?php	return '';	}
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
					$('#fix158716_mnum_dv').load('<?php echo site_url() ?>/fix158716_adm_mnut/');
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
					$('#fix158716_mnum_dv').load('<?php echo site_url() ?>/fix158716_adm_mnum/?cod='+cod);
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
				un_show="fix158716_codigo fix158716_data fix158716_hora  fix158716_foto " 
				col_url="fix158716_nome,<a href=../detalhes/?cod=__fix158716_codigo__>__this__</a>"
			]');
			?>

		</div>




		
	<?php
	
	return ob_get_clean();
}

add_shortcode("fix158716_adm_detalhes", "fix158716_adm_detalhes");
function fix158716_adm_detalhes($atts, $content = null){
	$vai = 0;
	if(current_user_can('administrator')) $vai = 1;
	if(current_user_can('fix-administrativo')) $vai = 1;
	if(!$vai) {	?>	<div style=""><a href="#">LOGIN</a></div>	<?php	return '';	}

	// echo do_shortcode('[fix_001940_view md="fix158716" cod=__cod__ un_show="fix158716_codigo fix158716_data fix158716_hora fix158716_status "]');
	$cod = isset($_GET['cod'])? $_GET['cod'] :'';
	$sql = "select * from ".$GLOBALS['wpdb']->prefix."fix158716 where fix158716_codigo = $cod";
	$tb = fix_001940_db_exe($sql,'rows');
	$row =  $tb['rows'][0];
	$row['fix158716_nascimento'] = fix_001940_date_mysql_br($row['fix158716_nascimento']);
	$path_foto = plugin_dir_url( fix158716__file__() )."img/foto.png";

	if($row['fix158716_foto']) $path_foto = $row['fix158716_foto'];

	ob_start();
	?>	
	<style type="text/css">
	.fix_001940_view_label {
		text-align:right;
		font-style: italic;
		font-size: 12px;
		padding-right: 15px;
		margin: 0px;
		text-transform: uppercase;
	}
	.fix_001940_view_data {
		min-height:30px;
		font-weight: bolder;
		margin: 0px;
	}
	.fix_001940_view_campo {
		display: grid;
		grid-template-columns: 3fr 7fr;
		border-top:1px solid gray;
	}
	.fix_001940_view_body {
		display: grid;
		grid-template-columns: 3fr 7fr;
		/*border:1px solid red;	*/
	}

	.fix_001940_view_dv_img {
		background-repeat: no-repeat;
		background: url(<?=$path_foto ?>);
		/*background-size: contain;*/
		background-size: cover;
		back
	}
	</style>

	<div class="fix_001940_view_body">
		<div class="fix_001940_view_dv_img"  style="">

			<!-- foto - ini -->

			<!-- foto - end -->
		</div>
		<div>
			<!-- dados - ini -->
			<div style="border-bottom:1px solid gray;">
				<div class="fix_001940_view_campo" >
					<div class="fix_001940_view_label">nome:</div>
					<div class="fix_001940_view_data"><?=$row['fix158716_nome'] ?></div>
				</div>
				<div class="fix_001940_view_campo" >
					<div class="fix_001940_view_label">nascimento:</div>
					<div class="fix_001940_view_data"><?=$row['fix158716_nascimento'] ?></div>
				</div>
				<div class="fix_001940_view_campo" >
					<div class="fix_001940_view_label">e-mail:</div>
					<div class="fix_001940_view_data"><?=$row['fix158716_email'] ?></div>
				</div>
				<div class="fix_001940_view_campo" >
					<div class="fix_001940_view_label">telefone:</div>
					<div class="fix_001940_view_data"><?=$row['fix158716_telefone'] ?></div>
				</div>
				<div class="fix_001940_view_campo" >
					<div class="fix_001940_view_label">ramal:</div>
					<div class="fix_001940_view_data"><?=$row['fix158716_ramal'] ?></div>
				</div>
				<div class="fix_001940_view_campo" >
					<div class="fix_001940_view_label">setor:</div>
					<div class="fix_001940_view_data"><?=$row['fix158716_setor'] ?></div>
				</div>
				<div class="fix_001940_view_campo" >
					<div class="fix_001940_view_label">departamento:</div>
					<div class="fix_001940_view_data"><?=$row['fix158716_departamento'] ?></div>
				</div>
				<div class="fix_001940_view_campo" >
					<div class="fix_001940_view_label">função:</div>
					<div class="fix_001940_view_data"><?=$row['fix158716_funcao'] ?></div>
				</div>
				<div class="fix_001940_view_campo" >
					<div class="fix_001940_view_label">rede social:</div>
					<div class="fix_001940_view_data"><?=$row['fix158716_rede_social'] ?></div>
				</div>
			</div>
			<!-- dados - end -->


		</div>
	</div>
	<a href="../editar/?cod=<?=$cod ?>">edit</a>
	<div style="height: 50px;"></div>


	<?php
	return ob_get_clean();
}

add_shortcode("fix158716_adm_edit", "fix158716_adm_edit");
function fix158716_adm_edit($atts, $content = null){
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
					 	window.location.href = '../detalhes/?cod=<?=$cod ?>';
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


//--request
add_action( 'parse_request', 'fix158716_adm_parse_request');
function fix158716_adm_parse_request( &$wp ) {
	if($wp->request == 'fix158716_adm_edit'){
		$vai = 0;
		if(current_user_can('administrator')) $vai = 1;
		if(current_user_can('fix-administrativo')) $vai = 1;
		if(!$vai) {	return '<!--não disponivel-->';}
		echo do_shortcode('[fix158716_adm_edit]');
		exit;
	}

	if($wp->request == 'fix158716_adm_list'){
		$vai = 0;
		if(current_user_can('administrator')) $vai = 1;
		if(current_user_can('fix-administrativo')) $vai = 1;
		if(!$vai) {	return '<!--não disponivel-->';}
		echo do_shortcode('[fix158716_list]');
		exit;
	}

	if($wp->request == 'fix158716_adm_update'){
		$vai = 0;
		if(current_user_can('administrator')) $vai = 1;
		if(current_user_can('fix-administrativo')) $vai = 1;
		if(!$vai) {	return '<!--não disponivel-->';}

		$cod = isset($_GET['cod']) ? $_GET['cod'] : 0;

		// echo do_shortcode('[fix_001940_update md=fix158716 cod='.$cod.' target_pos_update="#" ]');
		$result = fix_001940_md_update('fix158716',$cod,'');
		$ret['statusText'] = 'Atualizado com sucesso';
		echo json_encode($ret);
		exit;
	}
	if($wp->request == 'fix158716_adm_delete'){
		$vai = 0;
		if(current_user_can('administrator')) $vai = 1;
		if(current_user_can('fix-administrativo')) $vai = 1;
		if(!$vai) {	return '<!--não disponivel-->';}

		$cod = isset($_POST['cod']) ? $_POST['cod'] : 0;
		$result = fix_001940_md_delete('fix158716',$cod,'');
		$ret['statusText'] = 'Deletado com sucesso';
		echo json_encode($ret);
		exit;
	}
	if($wp->request == 'fix158716_adm_deletar'){
		$vai = 0;
		if(current_user_can('administrator')) $vai = 1;
		if(current_user_can('fix-administrativo')) $vai = 1;
		if(!$vai) {	return '<!--não disponivel-->';}
		echo do_shortcode('[fix158716_deletar]');
		exit;
	}


	if($wp->request == 'fix158716_adm_mnut'){
		$vai = 0;
		if(current_user_can('administrator')) $vai = 1;
		if(current_user_can('fix-administrativo')) $vai = 1;
		if(!$vai) {	echo '<!--não disponivel-->';exit;}
		echo do_shortcode('[fix158716_adm_mnut]');
		exit;
	}

	if($wp->request == 'fix158716_adm_mnum'){
		$vai = 0;
		if(current_user_can('administrator')) $vai = 1;
		if(current_user_can('fix-administrativo')) $vai = 1;
		if(!$vai) {	return '<!--não disponivel-->';}
		echo do_shortcode('[fix158716_adm_mnum]');
		exit;
	}

}