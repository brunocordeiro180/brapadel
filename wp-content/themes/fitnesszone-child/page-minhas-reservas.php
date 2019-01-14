<?php get_header(); ?>

<style>
    .footer-widgets-wrapper {
        margin-top: 50%;
    }
</style>

<?php

  if(is_array(get_userdata(wp_get_current_user()->ID)->roles)){
    $capitalized_value = strtoupper(get_userdata(wp_get_current_user()->ID)->roles[0]);
  } else {
    $capitalized_value = strtoupper(get_userdata(wp_get_current_user()->ID)->roles);
  }
  
  if(is_user_logged_in() && strpos(strtoupper($capitalized_value), 'bloqueado') !== true ): ?>

    <?php 
    
        $user = wp_get_current_user()->ID; 
        $credito = get_field( 'credito', 'user_' . $user );
        $divida = get_field( 'divida', 'user_' . $user );
    
    ?>

<section class="reservation__block">
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <h2>Minhas Reservas</h2>
                <strong>Crédito: $<?php echo number_format($credito, 2); ?></strong>
                <strong>| Valor Devido: $<?php echo number_format($divida, 2); ?></strong>
            </div>
            <div class="col-sm">
            <!-- <h4 style="float: right;">Crédito: $0,00</h4> -->
                <form action="../agendamento">
                    <input type="submit" value="Nova Reserva" />
                </form>
            </div>
        </div>
        <div class="row">
	        <div class="bd-example bd-example-tabs">
	            <nav class="nav nav-tabs" id="nav-tab" role="tablist">
	                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="home" aria-expanded="true">Próximos Jogos</a>
	                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="profile" aria-expanded="false">Reservas Canceladas</a>
	            </nav>
	            <div class="tab-content" id="nav-tabContent">
	            <?php
	                $user = get_currentuserinfo()->ID;
	                $args = array(
	                'post_type'   => 'reservab',
	                'author'      => $user
	                );
	                
	                $reservas = new WP_Query( $args );
	                if($reservas->have_posts() ) :
	                ?>
	                <div class="tab-pane fade active show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" aria-expanded="true">
		                <table style="width: 150%; vertical-align: middle;" class="table-reservas">
		                    <?php
		                    $reserva_id = 0;
		                    $i = 0;
		                    while($reservas->have_posts() ) :
		                    $reservas->the_post();
		                    $id = get_the_id();
		                    if(get_field("status", $id)){
		                        $i++;
		                    ?>
		                    
		                    <tr>
		                        <td ><h4 style="margin-bottom: 0px;"><?php echo the_title();  ?></h4></td>
		                        <td ><h4 style="margin-bottom: 0px;"><?php echo get_field("data", $id);  ?></h4></td>
		                        <td ><a href="../editar-reserva/?reservaid=<?php echo $id; ?>">Editar Reserva</a></td>
		                        <td >
		                            <form action="" method="post" onsubmit="return confirmacao()">
		                                <input style="display: none;" name="reserva_id" type="number" value="<?php echo get_the_id(); $reserva_id = get_the_id();?>">
		                                <input type="submit" style="background-color: transparent; color: #96d2eb; width: 100%; text-transform: capitalize; padding: 0px; margin: 0px;" class="btn btn-link" value="Cancelar Reserva">
		                            </form>
                                </td>
		                    </tr>
		                    <?php
		                   }
		                    endwhile;
		                    
		                    ?>
		                </table>
	            <?php
	            
	            else :
	            ?><p style="position: absolute;  margin-top: 5%; padding-bottom: 40%;">Nenhuma reserva encontrada</p><?php
	            endif;
	            ?></div><?php
	            $reservas = new WP_Query( $args );
                if($reservas->have_posts() ) :
	                ?>
	                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" aria-expanded="false">
		                <table style="width: 150%; vertical-align: middle;" class="table-reservas">
		                    <?php
		                    $reserva_id = 0;
		                    $i = 0;
		                    while($reservas->have_posts() ) :
		                    $reservas->the_post();
		                    $id = get_the_id();
		                    if(!get_field("status", $id)){
		                        $i++;
		                    ?>
		                    
		                    <tr>
		                        <td ><h4 style="margin-bottom: 0px;"><?php echo the_title();  ?></h4></td>
		                        <td ><h4 style="margin-bottom: 0px;"><?php echo get_field("data", $id);  ?></h4></td>
		                        <td ><a href="../editar-reserva/?reservaid=<?php echo $id; ?>">Editar Reserva</a></td>
		                        <td >
		                            <form action="" method="post" onsubmit="return confirmacao()">
		                                <input style="display: none;" name="reserva_id" type="number" value="<?php echo get_the_id(); $reserva_id = get_the_id();?>">
		                                <input type="submit" style="background-color: transparent; color: #96d2eb; width: 100%; text-transform: capitalize; padding: 0px; margin: 0px;" class="btn btn-link" value="Cancelar Reserva">
		                            </form>
                                </td>
		                    </tr>
		                    <?php
		                   }
		                    endwhile;
		                    wp_reset_postdata();
		                    ?>
		                </table>
	                
	            <?php
	            
	            else :
	            ?><p style="position: absolute;  margin-top: 5%; padding-bottom: 40%;">Nenhuma reserva encontrada</p><?php
	            endif;
	            if($i == 0){
	                ?>
	                <p style="position: absolute; margin-left: 1%;  margin-top: 2%; padding-bottom: 40%;">Nenhuma reserva encontrada</p><?php
	            }
	            ?></div><?php
	        ?>
	    	</div>
	    </div>
    </div>
</section>

<script>

    var url_string = window.location.href;
    var url = new URL(url_string);
    var cancelamento = url.searchParams.get("cancelamento");

    function confirmacao(){
        var ask = window.confirm("Deseja cancelar reserva?");
        if(ask){
            return true;
        }else{
            return false;
        }
    }

    if(cancelamento == 'false'){
        alert("Prazo para cancelamento expirado");
    }else{
        if(cancelamento == 'true'){
            alert("Reserva Cancelada");
        }
    }
    
</script>

<?php 

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $field_key = "status";
        $value = 0;

        $valor_reserva = 0;
        $valor_reserva = get_field('valor', $_POST['reserva_id']); 
        $pago = get_field('pago', $_POST['reserva_id']);
        $data = get_field('data', $_POST['reserva_id']);

        $hora_inicial = get_field('hora_inicial', $_POST['reserva_id']);
        $now  = date('H:i');
        $now_date = str_replace(":", "/", date('d:m:Y'));

        if($now_date == $data){
            $hoje = 'true';
        }else{
            $hoje = 'false';
        }
        $diferenca = abs(strtotime($hora_inicial) - strtotime($now)) / 3600;
 
        if($hoje == 'true' && ($diferenca/5 < 0)){
            header("Location: " . parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH) . "?cancelamento=false");
            exit(); 
        }else{
            if($pago){
                update_field('credito', floatval($credito) + floatval($valor_reserva), 'user_' . $user);
            }
            update_field( $field_key, $value, $_POST['reserva_id']);
            header("Location: " . parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH) . "?cancelamento=true");
            exit(); 
        }
        
    }
?>

<?php elseif(is_user_logged_in() && strpos(strtoupper(get_userdata(wp_get_current_user()->ID)->roles), 'bloqueado') !== false ): ?>

<section class="reservation__block reservation__active" id="reservation__notlogged">
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2 col-sm-12">
        <h2 class="reservation__warning">Não é possível efetuar a reserva, favor entrar em contato com um administrador: (61) 98134-0400</h2>
      </div>
    </div>
  </div>
</section>

<?php else: ?>

<section class="reservation__block reservation__active" id="reservation__notlogged">
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2 col-sm-12">
        <h2 class="reservation__warning">Você precisa estar logado para realizar a reserva. Clique <a href="https://brapadel.com.br/wp-login.php?redirect_to=https%3A%2F%2Fbrapadel.com.br%2Fagendamento%2F">aqui</a> para entrar.</h2>
      </div>
    </div>
  </div>
</section>


<?php endif; ?>


<?php get_footer(); ?>
