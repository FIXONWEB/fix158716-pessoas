<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
fix001941_create_tables
fix001941_delete_tables


fix158716_create_module
fix158716_remove_module
fix158716_create_table
fix158716_create_trigger
fix158716_create_fields
fix158716_delete_fields
fix158716_delete_trigger
fix158716_delete_table

*/
$fix158716_new_version = "1.0.0";
$fix158716_version = get_option('fix158716_version');
if(!$fix158716_version) {
	fix158716_create_module();
	$fix158716_version = $fix158716_new_version;
	update_option('fix158716_version', $fix158716_version);
}
if($fix158716_version=="1.0.0") {
	// die('-------');
	global $wpdb;
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	$sql = "ALTER TABLE ".$wpdb->prefix."fix158716 CHANGE fix158716_foto fix158716_foto VARCHAR(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;";
	// $wpdb->query($sql);
	dbDelta( $sql );
	$fix158716_new_version = "1.0.1";
	update_option('fix158716_version', $fix158716_new_version);	
	error_log("fix158716_new_version = 1.0.1", 0);
}


function fix158716__plugin_file(){
	return __FILE__;	
}
//register_activation_hook( __FILE__, 'fix158716_activation_hook' );
function fix158716_activation_hook() {
	//add_role( 'fix-administrativo', 'fix-administrativo', array( 'read' => true, 'level_0' => true ) );
	//fix158716_create_module();
}

register_deactivation_hook( __FILE__, 'fix158716_deactivation_hook' );
function fix158716_deactivation_hook(){
	// fix158716_remove_module();
}


function fix158716_create_module() {
	//fix001941_create_tables();
	fix158716_create_table();
	fix158716_create_trigger();
	fix158716_create_fields();
}

function fix158716_remove_module(){
	global $wpdb;
	$wpdb->query( "drop table if exists ".$GLOBALS['wpdb']->prefix."fix158716" );
	//$wpdb->query( "delete from `".$wpdb->prefix."fix001941` where fix001941_tabela = 'fix158716';" );
	//$wpdb->query( "delete from ".$wpdb->prefix."fix001940 where fix001940_tabela = 'fix158716';" );
	fix158716_delete_fields();
	//$wpdb->query( "drop table if exists ".$GLOBALS['wpdb']->prefix."fix001941");
	//$wpdb->query( "drop table if exists ".$GLOBALS['wpdb']->prefix."fix001940");
}


function fix158716_create_table() {
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	global $wpdb;
	global $charset_collate;
	// $wpdb->query( "drop table if exists ".$GLOBALS['wpdb']->prefix."fix158716");
	$sql = "
	CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."fix158716` (

		fix158716_codigo bigint(20) NOT NULL AUTO_INCREMENT,
		fix158716_data date,
		fix158716_hora varchar(20),
		
		fix158716_nome varchar(60),
		fix158716_nascimento date,
		fix158716_email varchar(60),
		fix158716_telefone varchar(60),
		fix158716_ramal varchar(60),
		fix158716_setor varchar(60),
		fix158716_departamento varchar(60),
		fix158716_funcao varchar(60),
		fix158716_rede_social varchar(60),
		fix158716_foto varchar(200),

		PRIMARY KEY (`fix158716_codigo`)
		) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;
	";
	$wpdb->query($sql);
}

function fix158716_create_trigger() {
	global $wpdb;
	global $charset_collate;
	$sql = "
	DROP TRIGGER IF EXISTS `".$wpdb->prefix."fix158716_bi`;
  CREATE TRIGGER `".$wpdb->prefix."fix158716_bi` BEFORE INSERT ON `".$wpdb->prefix."fix158716`
    FOR EACH ROW begin
      if new.fix158716_data is null then set new.fix158716_data  = (SELECT DATE(CURRENT_TIMESTAMP())); end if;
      if new.fix158716_hora is null then set new.fix158716_hora  = (SELECT TIME(CURRENT_TIMESTAMP())); end if;
    end
  ;

  ";
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	$mysqli->multi_query($sql);
}

function fix158716_create_fields(){
	global $wpdb;
	global $charset_collate;
	//$sql = "delete from `".$wpdb->prefix."fix001940` where fix001940_tabela = 'fix158716';";
	//$wpdb->query($sql);
	//$sql = " INSERT INTO `".$wpdb->prefix."fix001940` ( fix001940_codigo, fix001940_tabela, fix001940_sql_sort, fix001940_sql_limit, fix001940_sql_dir, fix001940_ativo ) VALUES ( 815001, 'fix158716', 'fix158716_codigo', 20, 'asc','s' );";
	//$wpdb->query($sql);
	$sql = "delete from `".$wpdb->prefix."fix001941` where fix001941_tabela = 'fix158716';";
	$wpdb->query($sql);
	$sql = "
	INSERT INTO `".$GLOBALS['wpdb']->prefix."fix001940` (
	`fix001940_tabela`, 
	`fix001940_sql_sort`, 
	`fix001940_sql_limit`, 
	`fix001940_sql_dir`, 
	`fix001940_ativo` 
	) VALUES (
	'fix158716', 
	'fix158716_codigo', 
	500, 
	'ASC', 
	''
	);
	";
	$wpdb->query($sql);
	$wpdb->query( "delete from ".$wpdb->prefix."fix001941 where fix001941_tabela = 'fix158716';");
	
	$sql = "
	INSERT INTO `".$wpdb->prefix."fix001941` (`fix001941_codigo`, `fix001941_tabela`, `fix001941_campo`, `fix001941_label`, `fix001941_ordem`, `fix001941_ctr_new`, `fix001941_ctr_edit`, `fix001941_ctr_view`, `fix001941_ctr_list`, `fix001941_ativo`, `fix001941_tipo`) VALUES
	(NULL, 'fix158716', 'fix158716_rg', 'RG', 10, 'textfield', 'textfield', 'label', 'label', 's', 'string'),
	(NULL, 'fix158716', 'fix158716_cep', 'CEP', 11, 'textfield', 'textfield', 'label', 'label', 's', 'string'),
	(NULL, 'fix158716', 'fix158716_sexo', 'Sexo', 8, 'textfield', 'textfield', 'label', 'label', 's', 'string'),
	(NULL, 'fix158716', 'fix158716_cpf', 'CPF', 9, 'textfield', 'textfield', 'label', 'label', 's', 'string'),
	(NULL, 'fix158716', 'fix158716_email', 'E-mail', 6, 'textfield', 'textfield', 'label', 'label', 's', 'string'),
	(NULL, 'fix158716', 'fix158716_nascimento', 'Nascimento', 7, 'textfield', 'textfield', 'label', 'label', 's', 'date'),
	(NULL, 'fix158716', 'fix158716_telefone_num', 'Fone', 5, 'textfield', 'textfield', 'label', 'label', 's', 'string'),
	(NULL, 'fix158716', 'fix158716_hora', 'Hora', 2, 'textfield', 'textfield', 'label', 'label', 's', 'string'),
	(NULL, 'fix158716', 'fix158716_nome', 'Nome', 3, 'textfield', 'textfield', 'label', 'label', 's', 'string'),
	(NULL, 'fix158716', 'fix158716_telefone_ddd', 'DDD', 4, 'textfield', 'textfield', 'label', 'label', 's', 'string'),
	(NULL, 'fix158716', 'fix158716_codigo', 'Código', 0, 'textfield', 'textfield', 'label', 'label', 's', 'string'),
	(NULL, 'fix158716', 'fix158716_data', 'Data', 1, 'textfield', 'textfield', 'label', 'label', 's', 'date'),
	(NULL, 'fix158716', 'fix158716_logradouro_tipo', 'Logradouro Tipo', 12, 'textfield', 'textfield', 'label', 'label', 's', 'string'),
	(NULL, 'fix158716', 'fix158716_logradouro_nome', 'Logradouro Nome', 13, 'textfield', 'textfield', 'label', 'label', 's', 'string'),
	(NULL, 'fix158716', 'fix158716_logradouro_numero', 'Logradouro Número', 14, 'textfield', 'textfield', 'label', 'label', 's', 'string'),
	(NULL, 'fix158716', 'fix158716_logradouro_complemento', 'Logradouro Complemento', 15, 'textfield', 'textfield', 'label', 'label', 's', 'string'),
	(NULL, 'fix158716', 'fix158716_logradouro_referencia', 'logradouro ReferêncLa', 16, 'textfield', 'textfield', 'label', 'label', 's', 'string'),
	(NULL, 'fix158716', 'fix158716_bairro', 'Bairro', 17, 'textfield', 'textfield', 'label', 'label', 's', 'string'),
	(NULL, 'fix158716', 'fix158716_cidade', 'Cidade', 18, 'textfield', 'textfield', 'label', 'label', 's', 'string'),
	(NULL, 'fix158716', 'fix158716_uf', 'UF', 19, 'textfield', 'textfield', 'label', 'label', 's', 'string');
	";
	// $wpdb->query( $sql);
	fix_001940_create_fields("fix158716");  
}

function fix158716_delete_fields(){
	global $wpdb;
	//$wpdb->query( "delete from ".$wpdb->prefix."fix001940 where fix001940_codigo = 815001;");
	//$wpdb->query( "delete from ".$wpdb->prefix."fix001941 where fix001941_tabela = 'fix158716';");
	$wpdb->query( "delete from `".$wpdb->prefix."fix001941` where fix001941_tabela = 'fix158716';" );
	$wpdb->query( "delete from ".$wpdb->prefix."fix001940 where fix001940_tabela = 'fix158716';" );

}

function fix158716_delete_trigger(){
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	global $wpdb;
	global $charset_collate;
	$sql = "DROP TRIGGER IF EXISTS `".$wpdb->prefix."fix158716_bi`;";
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	$mysqli->multi_query($sql);
}

function fix158716_delete_table() {
    global $wpdb;
    $wpdb->query( "drop table if exists ".$GLOBALS['wpdb']->prefix."fix158716");
}

//--request
add_action( 'parse_request', 'fix158716_parse_request');
function fix158716_parse_request( &$wp ) {
	

	if($wp->request == 'fix158716_busca_ajax'){
		$query = isset($_POST['query']) ? $_POST['query'] : '';
		$sql = "SELECT * FROM wp_fix158716 WHERE fix158716_nome LIKE '%".$query."%'";
		$tb = fix_001940_db_exe($sql,'rows');
		$rows = $tb['rows'];
		foreach ($rows as $row) {
			?>
  				<li class="list-group-item contsearch">
   					<a href="<?php echo site_url() ?>/pessoas/detalhes/?cod=<?php echo $row['fix158716_codigo'] ?>" class="gsearch" style="color:#333;text-decoration:none;"><?php echo $row['fix158716_nome'] ?></a>
  				</li>
			<?php
		}
		exit;
	}
	
	if($wp->request == 'register-time-and-ip'){
		// 		fix158716_origem varchar(60),
		// fix158716_time int,
		// fix158716_dif_anterior int,

		$sql = "select fix158716_time from ".$GLOBALS['wpdb']->prefix."fix158716 limit 0,1 order by fix158716_codigo desc";
		$sql = "select fix158716_time from ".$GLOBALS['wpdb']->prefix."fix158716 order by fix158716_codigo desc limit 0,1;";
		$tb = fix_001940_db_exe($sql,'rows');
		$time_anterior = $tb['rows'][0]['fix158716_time'];


		$ip_remoto = $_SERVER['REMOTE_ADDR'];
		$agora = time();

		$diferenca = $agora - $time_anterior;

		$sql = "
		insert into ".$GLOBALS['wpdb']->prefix."fix158716 (
			fix158716_origem,
			fix158716_time,
			fix158716_dif_anterior			
		) values (
			'".$ip_remoto."',
			'".$agora."',
			'".$diferenca."'
		);
		";
		global $wpdb;
		$wpdb->query( $sql );
		echo 'ok';
		exit;

	}
	if($wp->request == 'fix158716_json_view'){
		global $wpdb;
		$cod = $_POST['cod'];
		$sql = "select * from ".$wpdb->prefix."fix158716 where fix158716_codigo = ".$cod;
		$tb = fix_001940_db_exe($sql,'rows');
		$row = $tb['rows'][0];
		$ret = json_encode($row);
		echo $ret; 
		exit;
	}
	if($wp->request == 'fix158716/listagem'){
		$sql = "select * from ".$GLOBALS['wpdb']->prefix."fix001940 where fix001940_tabela= 'fix158716';";
		$tb = fix_001940_db_exe($sql,'rows');
		$row = $tb['rows'][0];
		$descri = $row['fix001940_descri'];
		if(!$descri) $descri = $row['fix001940_tabela'];
		get_header();
		?>
		<div style="display: grid;grid-template-columns: 1fr 1fr;">
			<div><h3><?php echo $descri ?></h3></div>
			<div></div>
		</div>
		
		<?php
		echo do_shortcode('[fix158716_paged]') ;
		echo do_shortcode('[fix158716_list]') ;
		
		
		get_footer();
		exit;
	}
	if($wp->request == 'fix158716/detalhes'){
		get_header();
		$sql = "select * from ".$GLOBALS['wpdb']->prefix."fix001940 where fix001940_tabela= 'fix158716';";
		$tb = fix_001940_db_exe($sql,'rows');
		$row = $tb['rows'][0];
		$descri = $row['fix001940_descri'];
		if(!$descri) $descri = $row['fix001940_tabela'];

		?>
		<div style="display: grid;grid-template-columns: 1fr 1fr;">
			<div>
				<h3><?php echo $descri ?> - Detalhes</h3>	
			</div>
			<div><a href="../listagem/">modo listagem</a></div>
		</div>
		<div style="border: 1px solid gray;padding: 5px;border-radius: 10px;margin: 5px;">
			<?php echo do_shortcode('[fix158716_detalhes]') ; ?>
			<?php echo do_shortcode('[fix158381_list_filter1]') ; ?>
		</div>

		<?php
		get_footer();
		exit;
	}





	if($wp->request == 'fix158716_list'){
		$vai = 0;
		if(current_user_can('administrator')) $vai = 1;
		if(current_user_can('fix-administrativo')) $vai = 1;
		if(!$vai) {	return '<!--não disponivel-->';}
		echo do_shortcode('[fix158716_list]');
		exit;
	}

	if($wp->request == 'fix158716_update'){
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
	if($wp->request == 'fix158716_delete'){
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
	if($wp->request == 'fix158716_deletar'){
		$vai = 0;
		if(current_user_can('administrator')) $vai = 1;
		if(current_user_can('fix-administrativo')) $vai = 1;
		if(!$vai) {	return '<!--não disponivel-->';}
		echo do_shortcode('[fix158716_deletar]');
		exit;
	}
	if($wp->request == 'fix158716_edit'){
		$vai = 0;
		if(current_user_can('administrator')) $vai = 1;
		if(current_user_can('fix-administrativo')) $vai = 1;
		if(!$vai) {	return '<!--não disponivel-->';}
		echo do_shortcode('[fix158716_edit]');
		exit;
	}
	if($wp->request == 'fix158716_mnut'){
		$vai = 0;
		if(current_user_can('administrator')) $vai = 1;
		if(current_user_can('fix-administrativo')) $vai = 1;
		if(!$vai) {	echo '<!--não disponivel-->';exit;}
		echo do_shortcode('[fix158716_mnut]');
		exit;
	}

	if($wp->request == 'fix158716_mnum'){
		$vai = 0;
		if(current_user_can('administrator')) $vai = 1;
		if(current_user_can('fix-administrativo')) $vai = 1;
		if(!$vai) {	return '<!--não disponivel-->';}
		echo do_shortcode('[fix158716_mnum]');
		exit;
	}
	

	if($wp->request == 'fix158716_buscar'){
		$vai = 0;
		if(current_user_can('administrator')) $vai = 1;
		if(current_user_can('fix-administrativo')) $vai = 1;
		if(!$vai) {	return '<!--não disponivel-->';}
		echo do_shortcode('[fix158716_buscar]');
		exit();
	}
	
	if($wp->request == 'fix158716_nnew'){
		$vai = 0;
		if(current_user_can('administrator')) $vai = 1;
		if(current_user_can('fix-administrativo')) $vai = 1;
		if(!$vai) {	return '<!--não disponivel-->';}
		echo do_shortcode('[fix158716_nnew]');
		exit();
	}
	if($wp->request == 'fix158716_insert'){
		$vai = 0;
		// if(current_user_can('administrator')) $vai = 1;
		// if(current_user_can('fix-administrativo')) $vai = 1;
		// if(!$vai) {	return '<!--não disponivel-->';}

		$result = fix_001940_md_insert('fix158716',$_POST,'','');
		$ret['statusText'] = 'Cadastrado com sucesso';
		echo json_encode($ret);
		exit;
	}
	if($wp->request == 'fix158716_create_module'){
		if(!current_user_can('administrator')) return '<!--não disponivel-->';
		fix158716_create_module();
		exit;
	}
	if($wp->request == 'fix158716_remove_module'){
		if(!current_user_can('administrator')) return '<!--não disponivel-->';
		fix158716_remove_module();
		exit;
	}
	if($wp->request == 'fix158716_create_table'){
		if(!current_user_can('administrator')) return '<!--não disponivel-->';
		fix158716_create_table();
		exit;
	}
	if($wp->request == 'fix158716_create_trigger'){
		if(!current_user_can('administrator')) return '<!--não disponivel-->';
		fix158716_create_trigger();
		exit;
	}
	if($wp->request == 'fix158716_create_fields'){
		if(!current_user_can('administrator')) return '<!--não disponivel-->';
		fix158716_create_fields();
		exit;
	}
	if($wp->request == 'fix158716_delete_fields'){
		if(!current_user_can('administrator')) return '<!--não disponivel-->';
		fix158716_delete_fields();
		exit;
	}
	if($wp->request == 'fix158716_delete_trigger'){
		if(!current_user_can('administrator')) return '<!--não disponivel-->';
		fix158716_delete_trigger();
		exit;
	}
	if($wp->request == 'fix158716_delete_table'){
		if(!current_user_can('administrator')) return '<!--não disponivel-->';
		fix158716_delete_table();
		exit;
	}

	if(substr($wp->request, 0, 9) == 'fix158716'){
		if($wp->request == 'fix158716/json/list'){
			echo 'fix158716/json/list';

			$md 		= 'fix158716';
			$fields 	= fix_001940_get_fields($md);
			$col     	= fix_001940_get_md_col($md);

			$rows = fix_001940_get_md_rows($md, $fields, $col);
			echo '<pre>';
			print_r($rows);
			echo '</pre>';

			exit;
		}
	}


}


// --shortcodes


add_shortcode("fix158716_deletar", "fix158716_deletar");
function fix158716_deletar($atts, $content = null){
	?>
	<script type="text/javascript">
		jQuery(function($){
			$('#fix158716_btn_confirme_deletar').on('click',function(e){
				var cod = $(this).attr('data-cod');
				e.preventDefault();
				// console.log('fix158716_btn_confirme_deletar: '+cod);
				var request = jQuery.ajax({
				    url: "<?php echo site_url() ?>/fix158716_delete/",
				    type: "POST",
				    data: 'cod='+cod,
					dataType: "json"
				});
				request.always(function(resposta, textStatus) {
					if (textStatus != "success") {
						// console.log('fail');
						alert("Error: " + resposta.statusText); //error is always called .statusText
					 } else {
					 	window.location.reload();
					 }
				});					
			});
		});
	</script>
	<?php
	echo do_shortcode('[fix_001940_deletar md=fix158716 cod=__cod__ target_update="#" un_show=""]');

}


add_shortcode("fix158716_mnut", "fix158716_mnut");
function fix158716_mnut($atts, $content = null){
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
add_shortcode("fix158716_mnum", "fix158716_mnum");
function fix158716_mnum($atts, $content = null){

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
				$('#fix158716_mnum_btn_deletar_dv').load('<?php echo site_url() ?>/fix158716_deletar/?cod='+cod);
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
				$('#fix158716_mnum_btn_editar_dv').load('<?php echo site_url() ?>/fix158716_edit/?cod='+cod);
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
	<div><a id="fix158716_mnum_btn_detalhes" data-cod="<?php echo $cod ?>" href="../detalhes/?cod=<?php echo $cod ?>">DETALHES</a></div>
	<div><a id="fix158716_mnum_btn_editar" data-cod="<?php echo $cod ?>" href="#">EDITAR</a></div>
	<div><a id="fix158716_mnum_btn_deletar" data-cod="<?php echo $cod ?>" href="#">DELETAR</a></div>

	<?php
}
add_shortcode("fix158716_edit", "fix158716_edit");
function fix158716_edit($atts, $content = null){
	$cod = isset($_GET['cod']) ? $_GET['cod'] : 0;
	?>
	<script type="text/javascript">
		jQuery(function($){
			$('#fix158716_edit').on('submit',function(e){
				e.preventDefault();
				console.log('fix158716_edit: <?php echo $cod ?>');
				var dados = $( this ).serialize();
				var request = jQuery.ajax({
				    url: "<?php echo site_url() ?>/fix158716_update/?cod="+<?php echo $cod ?>,
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
		fix158716_key_associado 
		fix158716_key_user 
		fix158716_url_api 
		fix158716_token
		fix158716_code
		fix158716_reference
		fix158716_dueDate
		fix158716_checkoutUrl
		fix158716_link
		fix158716_installmentLink
		fix158716_payNumber
		fix158716_billetDetails
		fix158716_bankAccount
		fix158716_ourNumber
		fix158716_barcodeNumber
		fix158716_portfolio
		"
	]');
}



add_shortcode("fix158716_list", "fix158716_list");
function fix158716_list($atts, $content = null){
	$vai = 0;
	if(current_user_can('administrator')) $vai = 1;
	if(current_user_can('fix-administrativo')) $vai = 1;
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
					$('#fix158716_mnum_dv').load('<?php echo site_url() ?>/fix158716_mnut/');
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
					$('#fix158716_mnum_dv').load('<?php echo site_url() ?>/fix158716_mnum/?cod='+cod);
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
			echo do_shortcode('[fix_001940_list 
				md=fix158716 
				col_x0="..." 
				col_xt="..." 
				un_show="fix158716_codigo fix158716_data fix158716_hora " 
				col__url="fix158716_nome_completo,<a href=../detalhes/?cod=__fix158716_codigo__>__this__</a>"
			]');
			?>

		</div>




		
	<?php
	
	return ob_get_clean();
}


add_shortcode("fix158716_list_no_restrict", "fix158716_list_no_restrict");
function fix158716_list_no_restrict($atts, $content = null){
	$vai = 0;
	// if(current_user_can('administrator')) $vai = 1;
	// if(current_user_can('fix-administrativo')) $vai = 1;
	// if(!$vai) {	return '<!--não disponivel-->';}
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
					$('#fix158716_mnum_dv').load('<?php echo site_url() ?>/fix158716_mnut/');
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
					$('#fix158716_mnum_dv').load('<?php echo site_url() ?>/fix158716_mnum/?cod='+cod);
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
			echo do_shortcode('[fix_001940_list 
				md=fix158716 
				col__x0="..." 
				col__xt="..." 
				un_show="fix158716_codigo fix158716_data fix158716_hora fix158716_rede_social fix158716_foto " 
				col_url="fix158716_nome,<a href=detalhes/?cod=__fix158716_codigo__>__this__</a>"
			]');
			?>

		</div>




		
	<?php
	
	return ob_get_clean();
}


add_shortcode("fix158716_paged", "fix158716_paged");
function fix158716_paged($atts, $content = null){
	ob_start();
	?>
	<script type="text/javascript">
		jQuery(function($){
			$('#fix158716_show_total_rows').html($('.fix158716_list').attr('data-total'));
		})
	</script>
	<div id="fix158716_nav_pages_x"></div>
	<div id="fix158716_nav_pages"></div>
	<div style="display: grid;grid-template-columns: 100px 80px 80px 1fr 1fr;">
		<div style="border: gray solid 1px;margin: 2px;padding: 2px;background-color: #d8d8d8;">
			<div>Registros:</div>
			<div id="fix158716_show_total_rows" style="text-align: center;"></div>	
		</div>
		<div style="border: gray solid 1px;margin: 2px;padding: 2px;background-color: #d8d8d8;">
			<div>Limit:</div>
			<div style="text-align: center;">
				<form action="" method="GET">
					<?php 
					foreach ($_GET as $key => $value) {
						if($key!='q'){
							if($key=='limit'){
								?>
								<input type="text" name="<?php echo $key ?>" value="<?php echo $value ?>" style="width: 100%;border:0px solid silver;margin: 0px;padding: 2px;text-align: center;" >
								<?php
							} else {
								?>
								<input type="hidden" name="<?php echo $key ?>" value="<?php echo $value ?>"	>
								<?php
							}
						}
					}
					if(!isset($_GET['limit'])){
						$limit = 10;
						?>
						<input type="text" name="limit" value="<?php echo $limit ?>" style="width: 100%;border:0px solid silver;margin: 0px;padding: 2px;text-align: center;" >
						<?php
					}
					?>
				</form>

			</div>
		</div>
		<div style="border: gray solid 1px;margin: 2px;padding: 2px;background-color: #d8d8d8;">
			<div>Start:</div>
			<div style="text-align: center;">
				<form action="" method="GET">
					<?php 
					foreach ($_GET as $key => $value) {
						if($key!='q'){
							if($key=='start'){
								?>
								<input type="text" name="<?php echo $key ?>" value="<?php echo $value ?>" style="width: 100%;border:1px solid silver;margin: 0px;padding: 2px;text-align: center;" >
								<?php
							} else {
								?>
								<input type="hidden" name="<?php echo $key ?>" value="<?php echo $value ?>"	>
								<?php
							}
						}
					}
					if(!isset($_GET['start'])){
						$start = 0;
						?>
						<input type="text" name="start" value="<?php echo $start ?>" style="width: 100%;border:1px solid silver;margin: 0px;padding: 2px;text-align: center;" >
						<?php
					}

					?>
				</form>
			</div>
		</div>
		<div style="border: gray solid 1px;margin: 2px;padding: 2px;background-color: #d8d8d8;">
			<div>Busca:</div>
			<div style="text-align: center;">
				<form action="" method="GET">
					<?php 
					foreach ($_GET as $key => $value) {
						if($key!='q'){
							if($key=='busca'){
								?>
								<input type="text" name="<?php echo $key ?>" value="<?php echo $value ?>" style="width: 100%;border:1px solid silver;margin: 2px;padding: 2px;text-align: center;" >
								<?php
							} else {
								?>
								<input type="hidden" name="<?php echo $key ?>" value="<?php echo $value ?>"	>
								<?php
							}
						}
					}
					if(!isset($_GET['busca'])){
						$start = 0;
						?>
						<input type="text" name="busca" value="<?php echo $busca ?>" style="width: 100%;border:1px solid silver;margin: 2px;padding: 2px;text-align: center;" >
						<?php
					}

					?>
				</form>
			</div>
		</div>

		<div style="border: gray solid 1px;margin: 2px;padding: 2px;background-color: #d8d8d8;">
			<div>Navegação ( <span id="span_pages"></span> - <span id="span_pages_start_ultimo"></span>) </div>
			<div style="text-align: center;">
				<?php 
				$q = $_GET;
				$start = isset($_GET['start']) ? $_GET['start'] : 0;
				$limit = isset($_GET['limit']) ? $_GET['limit'] : 20;
				unset($q['q']);
				$h = http_build_query($q);
				
				$q_a = $q;
				$q_a['start'] = '0';
				$q_aa = http_build_query($q_a);

				$q_b = $q;
				$q_b['start'] = ($start - $limit); 
				if($q_b['start'] < 0 ) $q_b['start'] = 0;
				$q_bb = http_build_query($q_b);

				$q_c = $q;
				$q_c['start'] = ($start + $limit); 
				// if($q_c['start'] < 0 ) $q_c['start'] = 0;
				$q_cc = http_build_query($q_c);

				$q_d = $q;
				unset($q_d['start']);
				// $q_d['start'] = ($start + $limit); 
				// if($q_c['start'] < 0 ) $q_c['start'] = 0;
				$q_dd = http_build_query($q_d);

				$nav_a = $h;
				$nav_b = $h;
				$nav_c = $h;
				$nav_d = $h;
				?>
				<script type="text/javascript">
					jQuery(function($){
						var limit = <?php echo $limit ?>;
						var total = $('.fix158716_list').attr('data-total');
						var start = total - limit;
						var pages = parseInt(total / limit, 10);
						$('#span_pages').html(pages);
						$('#span_pages_start_ultimo').html(pages * limit);
						// q_d = $q;
						// q_d['start']= pages * limit;
						// q_dd = http_build_query($q_d);
						var q_dd = '?<?php echo $q_dd ?>&start='+$('#span_pages_start_ultimo').html();
						$('.q_dd').attr('href',q_dd);

						$('.q_dd').on('click',function(e){
							e.preventDefault();
							// alert(q_dd);
							window.location.href = q_dd;
						});
					});
				</script>
				<a href="?<?php echo $q_aa ?>">inicio</a> - <a href="?<?php echo $q_bb ?>">anterior</a> - <a href="?<?php echo $q_cc ?>">proximo</a> - <a class="q_dd" href="">ultimo</a>
			</div>
		</div>
		<div></div>
	</div>
	
	<?php
	return ob_get_clean();
}


add_shortcode("fix158716_buscar", "fix158716_buscar");
function fix158716_buscar($atts, $content = null){
	// echo do_shortcode( '[fix_001940_busca]');
	$busca = isset($_GET['busca']) ? $_GET['busca'] : '';
	ob_start();
	?>
	<style type="text/css">
		.fix158716_buscar_submit {
		    border-style: solid;
		    border-top-width: 0;
		    border-right-width: 0;
		    border-left-width: 0;
		    border-bottom-width: 0;
		    color: #ffffff;
		    border-color: #0274be;
		    background-color: #0274be;
		    border-radius: 2px;
		    padding-top: 10px;
		    padding-right: 10px!important;
		    padding-bottom: 10px;
		    padding-left: 10px!important;
		    font-family: inherit;
		    font-weight: inherit;
		    line-height: 1;
		    width: 20%;
		}
	</style>
	<script type="text/javascript">
		jQuery(function($){
			$('#fix158716_busca').keyup(function(){
				var query = $('#fix158716_busca').val();
				$('#fix158716_detail').html('');
				if(query.length >= 2){

					$('#fix158716_detail').html(query);
					$.ajax({
						url:"<?php echo site_url() ?>/fix158716_busca_ajax",
						method:"POST",
						data:{query:query},
						success:function(data){
							$('.list-group').html(data);
							$('.list-group').css('display', 'block');
						}
					});
				}
				if(query.length == 0){
					$('#fix158716_detail').html();
					$('.list-group').css('display', 'none');
				}
			});
		});
	</script>
	<form action="<?php echo site_url() ?>/funcionarios/" method="GET" class="fix158716_buscar" style="">
		<input type="search" value="<?=$busca ?>" name="busca" id="fix158716_busca" style="width:70%;border:1px solid black;" placeholder="BUSCA" autocomplete="off">
		<input class="fix158716_buscar_submit" type="submit" value="OK" style="">
		<div id="fix158716_detail"></div>
		<ul class="list-group"></ul>
	</form>
	
	<?php
	return ob_get_clean();
}

add_shortcode("fix158716_nnew", "fix158716_nnew");
function fix158716_nnew($atts, $content = null){
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
					    url: "<?php echo site_url() ?>/fix158716_insert/",
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
			"
		]');

		?>
	</div>
	<?php 
	return ob_get_clean();
}

add_shortcode("fix158716_detalhes", "fix158716_detalhes");
function fix158716_detalhes($atts, $content = null){
	echo do_shortcode('[fix_001940_view md="fix158716" cod=__cod__ un_show="fix158716_codigo fix158716_data fix158716_hora fix158716_status "]');
	
}

add_shortcode("fix158716_detalhes_no_restrict", "fix158716_detalhes_no_restrict");
function fix158716_detalhes_no_restrict($atts, $content = null){
	// echo do_shortcode('[fix_001940_view md="fix158716" cod=__cod__ un_show="fix158716_codigo fix158716_data fix158716_hora fix158716_status "]');
	
}

add_shortcode("fix158716_detalhes2", "fix158716_detalhes2");
function fix158716_detalhes2($atts, $content = null){
	// echo do_shortcode('[fix_001940_view md="fix158716" cod=__cod__ un_show="fix158716_codigo fix158716_data fix158716_hora fix158716_status "]');
	$cod = isset($_GET['cod'])? $_GET['cod'] :'';
	$sql = "select * from ".$GLOBALS['wpdb']->prefix."fix158716 where fix158716_codigo = $cod";
	$tb = fix_001940_db_exe($sql,'rows');
	$row =  $tb['rows'][0];
	$row['fix158716_nascimento'] = fix_001940_date_mysql_br($row['fix158716_nascimento']);
	$path_foto = plugin_dir_url( fix158716__file__() )."img/foto.png";

	if($row['fix158716_foto']) $path_foto = $row['fix158716_foto'];

	// echo $path_foto;
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

	<div style="height: 50px;"></div>


	<?php
}

//add_action('wp_head', 'fix158716_wp_head');
function fix158716_wp_head(){
	?>
	<style type="text/css">
		#fix158716_nnew_mask {
			position: fixed;
			top: 0px;
			left: 0px;
			width: 100%;
			height: 100%;
			background-color: rgba(0,0,0,0.5);
			z-index: 9990;
		}
		#fix158716_nnew_dv {
			position: absolute;
			left: 50%;
			margin-left: -250px;
			top: 100px;
			background-color: white;
			width: 500px;
			min-height: 300px;
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
		.fix158716_list table {
			width: 99%;
		}

		.fix158716_list tbody {
			border-left: 1px solid #003e53 !important;
		}
		.fix158716_list th {
			background-color: #003e53;
			color: white;
			font-size: 12px;
		}
		.fix158716_list td {
			border-right: 1px solid #003e53 !important;
		}
		.fix158716_list table th, table td {
    		padding: 4px 2px;
    		text-align: left;
    		vertical-align: top;
    		border-bottom: 1px solid #003e53;
		}

		<?php 
		$vai = 0;
		if(current_user_can('administrator')) $vai = 1;
		if(current_user_can('fix-administrativo')) $vai = 1;
		if(!$vai) {
			echo '.fix158716p_btn_nnew {display:none;}';
		}
 		?>

	</style>
	<script type="text/javascript">
		var fix158716_site_url = '<?php echo site_url(); ?>';

		jQuery(function($){
			$('.fix158716p_btn_nnew').on("click",function(e){
				e.preventDefault();
				$('body').append('<div id="fix158716_nnew_mask"></div>');
				$('body').append('<div id="fix158716_nnew_dv">abrindo...</div>');
				$('#fix158716_nnew_dv').load('<?php echo site_url() ?>/fix158716_nnew/');
				$('#fix158716_nnew_mask').on('click',function(e){
					$('#fix158716_nnew_mask').remove();
					$('#fix158716_nnew_dv').remove();
				});
			});
		});
	</script>
	<?php
}

function fix158716_db($start=0,$limit=4){

	global $wpdb;
	$mes = date("m");
	// $mes = '5';

	$sql ="
	select 
		* 
	from ".$GLOBALS['wpdb']->prefix."fix158716 
	where 
		MONTH(fix158716_nascimento) = '".$mes."'
	limit ".$start.",".$limit."

	";
	$tb = fix_001940_db_exe($sql,'rows');
	$rows =  $tb['rows'];
	return $rows;



	print_r($tb);

	return '';


	$sql = "
	select 
		u.user_email, 
		m1.meta_value first_name, 
		m2.meta_value last_name,
		m3.meta_value fone,
		m4.meta_value ramal,
		m5.meta_value setor,
		m6.meta_value departamento,
		m7.meta_value endereco,
		m8.meta_value nascimento,
		m9.meta_value foto
		
	from $wpdb->users u
	INNER JOIN $wpdb->usermeta m1 ON u.ID = m1.user_id and m1.meta_key = 'first_name' 
	INNER JOIN $wpdb->usermeta m2 ON u.ID = m2.user_id and m2.meta_key = 'last_name' 
	LEFT JOIN $wpdb->usermeta m3 ON u.ID = m3.user_id and m3.meta_key = 'fix_telefone' 
	LEFT JOIN $wpdb->usermeta m4 ON u.ID = m4.user_id and m4.meta_key = 'fix_ramal' 
	LEFT JOIN $wpdb->usermeta m5 ON u.ID = m5.user_id and m5.meta_key = 'fix_setor' 
	LEFT JOIN $wpdb->usermeta m6 ON u.ID = m6.user_id and m6.meta_key = 'fix_departamento' 
	LEFT JOIN $wpdb->usermeta m7 ON u.ID = m7.user_id and m7.meta_key = 'fix_endereco' 
	LEFT JOIN $wpdb->usermeta m8 ON u.ID = m8.user_id and m8.meta_key = 'fix_nascimento' 
	LEFT JOIN $wpdb->usermeta m9 ON u.ID = m9.user_id and m9.meta_key = 'fix_foto' 
	where 
		MONTH(m8.meta_value) = '3'
	limit ".$start.",".$limit."
	";
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	$result = mysqli_query($mysqli, $sql);
	return 	$result;
}


add_shortcode("fix158716_niver", "fix158716_niver");
function fix158716_niver($atts, $content = null){
	extract(shortcode_atts(array(
		"start" => '0',
		"limit" => '4'
	), $atts));
	ob_start();
	?>
	<style type="text/css">
		.fix158716_niver_cols {
			/*display: grid;*/
			/*grid-template-columns: 1fr 1fr;	*/
		}
		.fix158716_niver_box {
			display: grid;
			grid-template-columns: 1fr 4fr;	
			line-height: 1;
		}
		.fix158716_niver_box img {
			border-radius: 30px;
		}
		.fix158716_niver_box .c2r1 {color: #ff4500;}
		.fix158716_niver_box .c2r2 {color: black;}
		.fix158716_niver_box .c2r2 a {color: black;}
		.fix158716_niver_box .c2r1, .fix158716_niver_box .c2r2 {padding-left: 4px;}
	</style>
	<div class="fix158716_niver_cols">
		<div>
			<?php $rows = fix158716_db($start, $limit) ?>
			<?php $path_foto = plugin_dir_url( fix158716__file__() )."img/foto.png"; ?>
			<?php foreach ($rows as $row) { ?>
				<?php 
				$niver = substr($row['fix158716_nascimento'], 8,2)."/".substr($row['fix158716_nascimento'], 5,2);
				$nome = $row['fix158716_nome'];
				$foto = $row['fix158716_foto'];
				$path_foto = plugin_dir_url( fix158716__file__() )."img/foto.png";
				if(!$foto) $foto = $path_foto;
				 ?>
				<div class="fix158716_niver_box">
					<div><a href="/pessoas/detalhes/?cod=<?=$row['fix158716_codigo'] ?>"><img src="<?=$foto ?>"></a></div>
					<div>
						<div class="c2r1"><?=$niver ?></div>
						<div class="c2r2"><a href="/pessoas/detalhes/?cod=<?=$row['fix158716_codigo'] ?>"><?=$nome ?></a></div>
					</div>
				</div>
			<?php } ?>

		</div>
	</div>
	<?php
	return ob_get_clean();
}


//--request
add_action( 'parse_request', 'fix158716_parse_request_2');
function fix158716_parse_request_2( &$wp ) {
	
	if($wp->request == 'fix158716_upload_foto'){
		global $wpdb;
		// ini_set("mysqli.allow_local_infile", "On");
		ini_set("display_errors", 1);
		error_reporting(E_ALL|E_STRICT);
		$cod = isset($_POST['cod']) ? $_POST['cod'] : '';
		$wordpress_upload_dir = wp_upload_dir();
		$i = 1; // number of tries when the file with the same name is already exists
		$profilepicture = $_FILES['profilepicture'];
		$profilepicture['name'] = preg_replace('/ /', '-', $profilepicture['name']);
		$new_file_path = $wordpress_upload_dir['path'] . '/' . $profilepicture['name'];
		$new_file_mime = mime_content_type( $profilepicture['tmp_name'] );
		if( empty( $profilepicture ) ) die( 'File is not selected.' );
		if( $profilepicture['error'] ) die( $profilepicture['error'] );
		if( $profilepicture['size'] > wp_max_upload_size() ) die( 'It is too large than expected.' );
		if( !in_array( $new_file_mime, get_allowed_mime_types() ) ) die( 'WordPress doesn\'t allow this type of uploads.' );
		while( file_exists( $new_file_path ) ) {
			$i++;
			$new_file_path = $wordpress_upload_dir['path'] . '/' . $i . '_' . $profilepicture['name'];
		}
		echo '<pre>'.$new_file_path.'</pre>';
		if( move_uploaded_file( $profilepicture['tmp_name'], $new_file_path ) ) {
			$upload_id = wp_insert_attachment( array(
				'guid'           => $new_file_path, 
				'post_mime_type' => $new_file_mime,
				'post_title'     => preg_replace( '/\.[^.]+$/', '', $profilepicture['name'] ),
				'post_content'   => '',
				'post_status'    => 'inherit'
			), $new_file_path );
			require_once( ABSPATH . 'wp-admin/includes/image.php' );
			wp_update_attachment_metadata( $upload_id, wp_generate_attachment_metadata( $upload_id, $new_file_path ) );
			echo wp_get_attachment_image( 
				$upload_id, 
				array('700', '600'), 
				"", 
				array( "class" => "img-responsive" )
			);
			$image_attributes = wp_get_attachment_image_src( $upload_id,'medium' );
			$sql = "
			update ".$GLOBALS['wpdb']->prefix."fix158716 set 
				fix158716_foto = '".$image_attributes[0]."' 
			where fix158716_codigo=".$cod.";
			";
    		$wpdb->query( $sql );
		}
		exit;
	}
	if($wp->request == 'fix158716_exportar_tabela_y'){


		fix158716_export_csv();
		// echo '---';
		exit;
	}
	if($wp->request == 'fix158716_exportar_tabela'){
		// echo "fix158716_exportar_tabela";
		// fix158716_import_csv();
		fix158716_export_csv();
		echo "fix158716_exportar_tabela";
		exit;
	}

	if($wp->request == 'fix158716_importar_tabela'){
		echo "fix158716_importar_tabela";
		fix158716_import_csv();
		exit;
	}
	if($wp->request == 'fix158716_limpar_tabela'){
		fix158716_limpar_tabela();
		exit;
	}
	if($wp->request == 'fix158716_file_import_csv'){
		fix158716_file_import_csv();
		exit;
	}
	if($wp->request == 'fix158716_export_csv'){
		fix158716_export_csv();
		exit;
	}
	if($wp->request == 'fix158716_import_csv'){
		get_header();
		fix158716_import_csv();
		get_footer();
		exit;
	}

	if($wp->request == 'pessoas/detalhes'){
		// if(current_user_can('subscriber')) {
			// wp_redirect( home_url().'/vendedor/vendas/listagem' );
			// exit;
		// }
		// wp_redirect( home_url() );
		get_header();
		?>
		<div style="text-align: center;">
			<h2>Pessoas</h2>
			<div>Detalhes</div>
		</div>
		<?php
		echo do_shortcode('[fix158716_detalhes2]');

		get_footer();
		exit;
	}


	if($wp->request == 'administrativo/pessoas/listagem__'){
		$go = 0;
		if(current_user_can('fix-administrativo')) $go=1;
		if(current_user_can('administrator')) $go=1;
		if(!$go){
			wp_redirect( home_url() );
			exit;
		}
		// wp_redirect( home_url() );

		get_header();
		?>
		<div style="text-align: center;">
			<h2>Administrativo</h2>
			<h2>Pessoas</h2>
			<div>Listagem</div>
		</div>
		<?php
		get_footer();
	}

}

function fix158716_get_cols(){
	$sql = "SHOW COLUMNS FROM ".$GLOBALS['wpdb']->prefix.'fix158716';
	$tb = fix_001940_db_exe($sql,'rows');
	$cols = '';
	$i = 0;
	foreach ($tb['rows'] as $row) {
		if($i) $cols .= ', ';
		$cols .= $row['Field'];
		$i++;
	}
	return $cols;
}

function fix158716_export_csv(){
	$connect = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);  
	header('Content-Type: text/csv; charset=utf-8');  
	header('Content-Disposition: attachment; filename=fix158716.csv');  
	$output = fopen("php://output", "w");  
	fputcsv($output, array('fix158716_codigo', 'fix158716_nome', 'fix158716_nascimento' ));  
	// $query = "SELECT fix158716_codigo, fix158716_nome, fix158716_nascimento from ".$GLOBALS['wpdb']->prefix."fix158716 ORDER BY fix158716_codigo ASC";  
	$cols = fix158716_get_cols();
	$query = "SELECT ".$cols." from ".$GLOBALS['wpdb']->prefix."fix158716 ORDER BY fix158716_codigo ASC";  
	$result = mysqli_query($connect, $query);  
	while($row = mysqli_fetch_assoc($result)) {  
		fputcsv($output, $row);  
	}  
	fclose($output);  

}

add_shortcode("fix158716_form_upload_foto", "fix158716_form_upload_foto");
function fix158716_form_upload_foto($atts, $content = null){
	ob_start();
	?>
	<script>
		jQuery(document).ready(function($){
			$('#fix158716_form_upload_foto').on('submit', function(event){
				$('#fix158716_form_upload_foto_msg').html('');
				event.preventDefault();
				$.ajax({
					url:"<?php echo site_url() ?>/fix158716_upload_foto",
					method:"POST",
					data: new FormData(this),
					dataType:"json",
					contentType:false,
					cache:false,
					processData:false,
					success:function(data){
						$('#fix158716_form_upload_foto').html('<div class="alert alert-success">'+data.success+'</div>');
						$('#fix158716_form_upload_foto')[0].reset();
					}
				})
			});
		});
	</script>

	<form id="fix158716_form_upload_foto" action="<?php echo get_stylesheet_directory_uri() ?>/process_upload.php" method="post" enctype="multipart/form-data">
	FOTO: <input type="file" name="profilepicture" size="25" />
	<input type="hidden" name="cod" value="<?php echo isset($_GET['cod']) ? $_GET['cod'] : '' ?>" />
	<input type="submit" name="submit" value="Submit" />
	</form>




	<?php
	return ob_get_clean();

	/*
	<form id="fix158716_form_upload_foto_" method="POST" enctype="multipart/form-data" class="">
		<div class="">
			<label class="">FOTO:</label>
			<input type="file" name="file" id="file" accept=".png" />
			<input type="hidden" name="hidden_field" value="1" />
			<input type="hidden" name="cod" value="<?php echo isset($_GET['cod']) ? $_GET['cod'] : '' ?>" />
			<input type="submit" name="import" id="import" class="" value="Ok" />
		</div>
		<div class="fix158716_form_upload_foto_msg"></div>
	</form>

	*/
}
function fix158716_import_csv(){
	?>
	<form id="sample_form" method="POST" enctype="multipart/form-data" class="form-horizontal">
		<div class="form-group">
			<label class="col-md-4 control-label">Select CSV File</label>
			<input type="file" name="file" id="file" accept=".csv" />
		</div>
		<div class="form-group" align="center">
			<input type="hidden" name="hidden_field" value="1" />
			<input type="submit" name="import" id="import" class="btn btn-info" value="Import" />
		</div>
	</form>

	<script>
		jQuery(document).ready(function($){
			$('#sample_form').on('submit', function(event){
				$('#message').html('');
				event.preventDefault();
				$.ajax({
					url:"<?php echo site_url() ?>/fix158716_file_import_csv",
					method:"POST",
					data: new FormData(this),
					dataType:"json",
					contentType:false,
					cache:false,
					processData:false,
					success:function(data){
						$('#message').html('<div class="alert alert-success">'+data.success+'</div>');
						$('#sample_form')[0].reset();
					}
				})
			});
		});
	</script>
	<?php
}







function fix158716_file_import_csv(){
	ini_set("mysqli.allow_local_infile", "On");
	ini_set("display_errors", 1);
	error_reporting(E_ALL|E_STRICT);

	if(!empty($_FILES['file']['name'])){
		$file_location = $_FILES['file']['tmp_name'];
	    $cols = fix158716_get_cols();
		$sql = "
			LOAD DATA local INFILE '".$file_location."' 
			INTO TABLE ".$GLOBALS['wpdb']->prefix."fix158716 
			CHARACTER SET 'utf8' 
			FIELDS TERMINATED BY ',' 
			ENCLOSED BY '\"' 
			IGNORE 1 LINES 
			(".$cols.")
		;
		";
		echo $sql;
		global $wpdb;
		$wpdb->query( $sql );
	}
}

function fix158716_limpar_tabela(){
	echo "fix158716_limpar_tabela";
	$sql = "TRUNCATE TABLE `".$GLOBALS['wpdb']->prefix."fix158716`";
	$connect = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);  
	$result = mysqli_query($connect, $sql);  
	mysqli_close ( $connect );
}