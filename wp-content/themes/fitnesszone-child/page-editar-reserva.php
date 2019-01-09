<?php acf_form_head(); ?>
<?php get_header(); ?>

<style>
    .ui_tpicker_second{
        display: none !important;
    }

    .ui_tpicker_second::before {
      display: none !important;
    }

    /* .ui_tpicker_minute_slider,.ui_tpicker_hour_slider select{
        height: 25px;
    } */
</style>

<section class="reservation__block">
    <div class="container">
        <h1>Editar Reserva</h1>
        <div>
        <?php  $args = array(
            'post_type'   => 'reservab',
            'author'      => $user
            );

            $current_post = get_post($_GET['reservaid']);
            $author_id = $current_post->post_author;
            $id_post = 0;
           $reservas = new WP_Query( $args );
            if($reservas->have_posts() ) {
                while($reservas->have_posts() ){
                   $reservas->the_post();
                   $id = get_the_id(); 
                   if($id == $_GET['reservaid']){
                        $id_post = $id;
                        $options = array(
                            'fields' => array(
                                'clube',
                                'quadra',
                                'socios',
                                'data',
                                'hora_inicial',
                                'hora_final',
                                'raquetes',
                                'bolinhas'
                            )
                        );

                        if($author_id == get_currentuserinfo()->ID){
                            acf_form($options);
                        }else{
                            ?><h2>Sem permissão para editar Reserva</h2><?php
                        }
                   }
                }
            } ?>
            </div>
    </div>
</section>
<script>


    function validaHora(){

        var data = jQuery(".hasDatepicker").eq(0).val();
        var hora_inicial = jQuery(".hasDatepicker").eq(1).val();
        var hora_final = jQuery(".hasDatepicker").eq(2).val();

        data = data.split("/");
        var data_obj = new Date(parseInt(data[2]), parseInt(data[1]) - 1, parseInt(data[0]));

        if(data_obj.getDay() == 6 || data_obj.getDay() == 0){ 
            weekend = true;;
        }else{
            weekend = false;
        }

        console.log(hora_inicial);
        console.log(data);

        hora_inicial = hora_inicial.split(":");
        hora_final = hora_final.split(":");

        hora_inicial[0] = Number(hora_inicial[0]);
        hora_inicial[1] = Number(hora_inicial[1]);

        hora_final[0] = Number(hora_final[0]);
        hora_final[1] = Number(hora_final[1]);

        if((hora_inicial[1] != 0 && hora_inicial[1] != 30) || hora_final[1] != 0 && hora_final[1] != 30){
            return false;
        }

        if((weekend == true && hora_inicial[0] < 18) || (weekend == false)){
            if(hora_inicial[0] > hora_final[0]){
                return false;
            }else{
                if((hora_inicial[0] == hora_final[0])){
                    if((hora_inicial[1] > hora_final[1])){
                        return false;
                    }
                    if(hora_inicial[1] == hora_final[1]){
                        return false;
                    }
                }else{
                    var diferenca = (hora_final[0] - hora_inicial[0]) + ((hora_final[1]/100) - (hora_inicial[1]/100));

                    if(diferenca > 2){
                        return false;
                    }else{
                        return true;
                    }
                }     
            }
        }
    }

    jQuery(".acf-form-submit .acf-button").click(function(e){
        if(validaHora()){
            <?php update_field('editada', true, $id_post); ?>
        }else{
            alert("Horário Inválido");
            e.preventDefault();
        }
    })



</script>

<?php 

    $args = [
        'post_type'      => 'page',
        'post_name__in'  => ['agendamento'],
        'fields'         => 'ids' 
    ];
    $q = get_posts( $args );
    $page = $q[0];

    $preco_atleta_comum_baixa = floatval(str_replace(",", ".", get_field('preco_atleta_comum_baixa', $page)));
    $preco_atleta_comum_alta = floatval(str_replace(",", ".", get_field('preco_atleta_comum_alta', $page)));
    $preco_atleta_socio_baixa = floatval(str_replace(",", ".", get_field('preco_atleta_socio_baixa', $page)));
    $preco_atleta_socio_alta = floatval(str_replace(",", ".", get_field('preco_atleta_socio_alta', $page)));

    $preco_atleta_comum_baixa_pagamento_clube = floatval(str_replace(",", ".", get_field('preco_atleta_comum_baixa_pagamento_clube', $page)));
    $preco_atleta_comum_alta_pagamento_clube = floatval(str_replace(",", ".", get_field('preco_atleta_comum_alta_pagamento_clube', $page)));
    $preco_atleta_socio_baixa_pagamento_clube = floatval(str_replace(",", ".", get_field('preco_atleta_socio_baixa_pagamento_clube', $page)));
    $preco_atleta_socio_alta_pagamento_clube = floatval(str_replace(",", ".", get_field('preco_atleta_socio_alta_pagamento_clube', $page)));

    $preco_raquete = floatval(str_replace(",", ".",get_field('aluguel_raquete', $page)));
    $preco_bolinhas = floatval(str_replace(",", ".", get_field('bolinhas', $page)));
    $luz = floatval(str_replace(",", ".", get_field('luz', $page)));

    if( isset($_GET['updated']) && $_GET['updated'] == 'true' ) {
        $reserva_id = $_GET['reservaid'];
        $socios = floatval(get_field("socios", $reserva_id));
        // $data = get_field("data", $reserva_id);
        $hora_inicial = get_field("hora_inicial", $reserva_id);
        $hora_final = get_field("hora_final", $reserva_id);
        $raquetes = get_field("raquetes", $reserva_id);
        $bolinhas = get_field("bolinhas", $reserva_id);
        $forma_pagamento = get_field("forma_de_pagamento", $reserva_id);

        $hora_inicial = explode(":", $hora_inicial);
        $hora_inicial = intval($hora_inicial[0]);
        $total = 0;
        $totalClube = 0;

        if(isWeekend($date)){
            if($hora_inicial >= 9){
                $horario_alta = true;
            }
        }else{
            if($hora_inicial >= 18){
                $horario_alta = true;
            }else{
                $horario_alta = false;
            }
        }
        
        if($horario_alta == false){
            if($forma_pagamento == 0){
                $preco_a = $preco_atleta_comum_baixa_pagamento_clube;
                $preco_s = $preco_atleta_socio_baixa_pagamento_clube;
            }else{
                $preco_a = $preco_atleta_comum_baixa;
                $preco_s = $preco_atleta_socio_baixa;
            }
        }else{
            if($forma_pagamento == 0){
                $preco_a = $preco_atleta_comum_alta_pagamento_clube;
                $preco_s = $preco_atleta_socio_alta_pagamento_clube;
            }else{
                $preco_a = $preco_atleta_comum_alta;
                $preco_s = $preco_atleta_socio_alta;
            }
        }

        $jogadores = floatval(4 - $socios); 

        if($socios != 0){
            if($socios == 4){
                $total = 4 * $preco_s;
            }else{
                $total = $preco_a * $jogadores + $preco_s * $socios;
            }
        }else{
            $total = 4 * $preco_a;
        }

        $hora_inicial = $hora_inicial = get_field("hora_inicial", $reserva_id);

        $hora_inicial = explode(":", $hora_inicial);
        
        if(($hora_inicial[0] >= 18) && ($hora_inicial[1] == 30 || $hora_inicial[1] == 0)){
            $total = $total + $luz;
            $totalClube = $totalClube + $luz;
            $cobrandoLuz = true;
        }else{
            $cobrandoLuz = false;
        }

        $hora_inicial = explode(":", $hora_inicial);
        $hora_inicial[0] = intval($hora_inicial[0]);
        $hora_inicial[1] = intval($hora_inicial[1]);

        if(($hora_inicial[0] >= 18) && ($hora_inicial[1] == 30 || $hora_inicial[1] == 0)){
            $totalClube = $totalClube + $luz;
            $cobrandoLuz = true;
        }else{
            $cobrandoLuz = false;
        }
    
        $total = $total + ($preco_raquete * $raquetes) + ($preco_bolinhas * intval($bolinhas));
        
        $user = wp_get_current_user()->ID; 
        $valor = floatval(str_replace(",", ".", get_field("valor", $reserva_id)));
        $divida_old = get_field( 'divida', 'user_' . $user );

        if($total > $valor){
            $divida = $divida_old + ($total - $valor);
            update_field('divida', $divida, 'user_' . $user);
        }
        
        update_field( "valor", $total, $reserva_id);
    
    }

?>



<?php get_footer(); ?>