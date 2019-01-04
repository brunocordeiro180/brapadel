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



<section class="reservation__block">
    <div class="container">
        <div class="row">
            <h2 style="float: left;">Minhas Reservas</h2>
            <form action="../agendamento">
                <input type="submit" value="Nova Reserva" />
            </form>
        </div>
        <?php
            $user = get_currentuserinfo()->ID;
            $args = array(
            'post_type'   => 'reservab',
            'author'      => $user
            );
            
           $reservas = new WP_Query( $args );
            if($reservas->have_posts() ) :
            ?>
            <table style="width: 60%; margin: auto;" class="table-reservas">
                <?php
                while($reservas->have_posts() ) :
                   $reservas->the_post();
                   $id = get_the_id();
                    ?>
                    <tr>
                        <td style="padding-bottom: 20px; padding-top: 0px;"><h4><?php echo the_title();  ?></h4></td>
                        <td style="padding-bottom: 20px; padding-top: 0px;"><h4><?php echo get_field("data", $id);  ?></h4></td>
                        <td style="padding-bottom: 20px; padding-top: 0px;"><a href="../editar-reserva/?reservaid=<?php echo $id; ?>">Editar Reserva</a></td>
                        <td ><button id="<?php echo $id; ?>" onclick="cancelarReserva(<?php echo get_the_id();?>);" href="">Cancelar Reserva</button></td>
                    </tr>
                    <?php
                endwhile;
                wp_reset_postdata();
                ?>
            </table>
            <?php
            else :
            ?><p style="position: absolute;  margin-top: 5%; padding-bottom: 40%;">Nenhuma reserva encontrada</p><?php
            endif;
        ?>
    </div>
</section>

<script>

    function cancelarReserva(reserva_id) {

        jQuery.ajax({
            type: "POST",
            url: "https://brapadel.com.br/minhas-reservas",
            data: { reserva_id: reserva_id }
        }).done(function( msg ) {
            location.reload();
            alert("Reserva Cancelada");
        });    
    };

</script>

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

<?php 

    $field_key = "status";
    $value = 0;
    update_field( $field_key, $value, $_POST['reserva_id']);

?>

<?php get_footer(); ?>
