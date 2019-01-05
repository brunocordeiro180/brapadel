<?php acf_form_head(); ?>
<?php get_header(); ?>

<style>
    .ui_tpicker_second{
        display: none !important;
    }

    .ui_tpicker_second::before {
      display: none !important;
    }
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



<?php get_footer(); ?>