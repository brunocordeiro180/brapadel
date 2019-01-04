<?php get_header();

if(is_array(get_userdata(wp_get_current_user()->ID)->roles)){
  $capitalized_value = strtoupper(get_userdata(wp_get_current_user()->ID)->roles[0]);
} else {
  $capitalized_value = strtoupper(get_userdata(wp_get_current_user()->ID)->roles);
}

// $_GET['socios'] = 0;
// $_GET['horario_inicial'] = 0;
// $_GET['horario_final'] = 0;
// $_GET['raquetes'] = 0;
// $_GET['bolinhas'] = 0;
// $_GET['date'] = 0;

if(is_user_logged_in() && strpos(strtoupper($capitalized_value), 'bloqueado') !== true ): ?>

  <script type="text/javascript">
  var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
  };
  
  </script>
  <style>
    .jsCalendar table{
      box-shadow: none !important;
    }

    @media only screen and (max-width: 767px) {
			.steps li {
				color: white;
			}

      .parte1{
        float: none !important;
        width: 100% !important;
        margin-left: 0px;
      }

      .parte1 h2{
        float: left !important;
      }

      .parte2{
        padding-top: 40%;
        text-align: center;
        float: none !important;
        padding-left: 0px !important;
        border-left: 0px !important;
      }

      .parte1.pagamento{
        position: absolute;
        left: 37%;
      }

      .voltar_pagina_pagamento{
        margin-left: 37%;
        position: absolute;
        top: 200%;
        left: -37%;
        margin-top: 8%;
      }

      .resumo_pagamento{
        padding-top: 52%;
      }

      #pagar_online, #pagar_clube{
        padding-top: 10%;
      }

      #div_pagamentos{
        position: absolute;
        padding-top: 10%;
        right: 75%;
      }

      .row_pagamento{
        padding-top: 28% !important;
      }

      #h5-selecione-socios, #label-selecione-socios{
        float: left;
      }

      #h5-selecione-socios{
        padding-right: 50%; 
      }

      #h2-desconto-socios{
        padding-left: 24%;
        margin-bottom: 50px;
      }

      #h2-selecione-extras{
        padding-right: 30%;
      }
		}

    @media only screen and (max-width: 960px) {

      .parte2{
        border-left: 0px !important;
      }

      .parte1.pagamento{
        position: absolute;
        /* left: 37%; */
      }

      /* .voltar_pagina_pagamento{
        margin-left: 37%;
        position: absolute;
        top: 200%;
        left: -37%;
        margin-top: 5%;
      } */

      /* .resumo_pagamento{
        padding-top: 52%;
      } */

      #pagar_online, #pagar_clube{
        padding-top: 10%;
      }

      /* #div_pagamentos{
        position: absolute;
        padding-top: 10%;
        right: 75%;
      } */

      
		}

    @media only screen and (max-width: 480px) {
      .resumo_pagamento{
        padding-top: 82%;
        margin-top: 40%;
      }

      #selecione-clube{
        position: absolute;
        padding-top: 25%;
        padding-left: 22%;
      }

      #confirmar-reserva{
        position: absolute;
        margin-top: 80%;
        top: 15%;
        width: 178%;
        margin-bottom: 53%;
        /* margin-right: 55%; */
        /* right: 64%; */
      }

      .voltar_pagina_pagamento{
        top: 263%;
        left: -42%;
      }

      #h2-desconto-socios{
        padding-left: 24%;
      }

    }

  </style>
  <?php 
  
    $clube_quadras = array();

    if( have_rows('clube_quadras') ):
      // loop through the rows of data
      while ( have_rows('clube_quadras') ) : the_row();
          // $a = the_sub_field('clube_brapadel');
          // $b = the_sub_field('quadras_brapadel');
          $aux = array(
            'Clube' => get_sub_field('clube_brapadel'),
            'Quadra' => get_sub_field('quadras_brapadel')
          );
          array_push($clube_quadras, $aux);
      endwhile;
    endif;
  
  ?> 

  <?php if (!isset($_GET['reservation__types']) && !isset($_GET['reservation__dates']) && !isset($_GET['reservation__hours']) && !isset($_GET['reservation_extras']) && !isset($_GET['reservation__payment'])): ?>

  <section class="reservation__block reservation__active" id="reservation__clubes">
    <div class="container">
      <ul class="steps">
        <li class="active">Selecione os clubes</li>
        <li>Selecione a quantidade de sócios</li>
        <li>Selecione a data</li>
        <li>Selecione os horários</li>
        <li>Selecione os extras</li>
        <li>Realize o pagamento</li>
      </ul>

      <div class="row" style="padding-top: 10%;">
        <div class="col-md-8 col-md-offset-2 col-sm-12">
          <br>
          <div class="row" style="padding-bottom: 25%;">
            <div class="parte1" style="float: left; width: 70%;">
              <h2 id="selecione-clube">Selecione o clube</h2>
              <select class="clubes__select" name="clubes__select">
                <option value="0">Clubes</option>
                <?php 
                  foreach ($clube_quadras as $key => $value) {
                    ?><option value="<?php echo ($key + 1); ?>"><?php echo $value['Clube']; ?></option><?php 
                  }
                  ?>
              </select>
               </select> 
                <a class="clubes__button next__button">Próximo</a>
                <script type="text/javascript">
                  var clubes_quadras = [];
                  var tamanho;

                  clubes_quadras = <?php echo json_encode($clube_quadras); ?>;

                  jQuery('.clubes__select').change(function(){
                
                    // alert("earrerar");
                    clubes_quadras.forEach(element => {
                      var nome_clube = element['Clube'].split(" ");
                      nome_clube = nome_clube[1];
                      if(nome_clube == jQuery(this).val()){
                        tamanho = parseInt(element['Quadra']);
                      }
                    });
                  })
                  jQuery('.clubes__button').click(function(){
                    window.location.href =  window.location.href.split('?')[0] + '?clubes=' + jQuery('.clubes__select').val() + '&qtd_quadras=' + tamanho  + '&reservation__types=true';
                  });
                </script>
              </div>
              <div class="parte2" style="float: right; border-left: 1px solid black; padding-left: 2%;padding-bottom: 5%;">  
                <h3><strong style="margin-bottom: 1px;">Resumo da Reserva</strong></h3>
                <h5>Total a Pagar: $0,00</h5>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php endif; ?>


  <?php 

    $preco_atleta_comum_baixa = get_field('preco_atleta_comum_baixa');
    $preco_atleta_comum_alta = get_field('preco_atleta_comum_alta');
    $preco_atleta_socio_baixa = get_field('preco_atleta_socio_baixa');
    $preco_atleta_socio_alta = get_field('preco_atleta_socio_alta');

    $preco_atleta_comum_baixa_pagamento_clube = get_field('preco_atleta_comum_baixa_pagamento_clube');
    $preco_atleta_comum_alta_pagamento_clube = get_field('preco_atleta_comum_alta_pagamento_clube');
    $preco_atleta_socio_baixa_pagamento_clube = get_field('preco_atleta_socio_baixa_pagamento_clube');
    $preco_atleta_socio_alta_pagamento_clube = get_field('preco_atleta_socio_alta_pagamento_clube');
    
    $preco_raquete = get_field('aluguel_raquete');
    $preco_bolinhas = get_field('bolinhas');
    $luz = get_field('luz');

 
    
  ?>


  <?php if (isset($_GET['reservation__types'])): ?>
    <section class="reservation__block reservation__active" id="reservation__types">
      <div class="container">
        <ul class="steps">
          <li>Selecione os clubes</li>
          <li class="active">Selecione os tipos de jogadores</li>
          <li>Selecione a data</li>
          <li>Selecione os horários</li>
          <li>Selecione os extras</li>
          <li>Realize o pagamento</li>
        </ul>

        <br><br><br><br><br>
        <div class="row" style="padding-bottom: 25%;">
          <div class="col-md-8 col-md-offset-2 col-sm-12">
            <div class="row">
              <div class="parte1" style="float: left; width: 70%;">
                <h2 id="h2-desconto-socios">Desconto para sócios</h2>
                <h5 id="h5-selecione-socios">Selecione a quantidade de sócios</h5>
                <label id="label-selecione-socios" for="">Sócios</label>
                <select id="types__select_first" name="types__select">
                  <!-- <option value="selected" disabled="disabled" selected="selected">Sócios</option> -->
                  <option value="0">Nenhum</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                </select>
                <div class="types_nao_socios"></div>
                <a class="reservation__types--button clubes__button--before before__button">Voltar</a>
                <script type="text/javascript">
                  jQuery('.reservation__types--button.clubes__button--before').click(function(){
                    window.location.href =  window.location.href.split('?')[0];
                  });
                </script>
                <a class="reservation__types--button clubes__button--next next__button">Próximo</a>
                <script type="text/javascript">
                  jQuery('.reservation__types--button.clubes__button--next').click(function(){
                    window.location.href =  window.location.href.split('?')[0]+ '?clubes=' + getUrlParameter('clubes') + '&qtd_quadras=' + getUrlParameter('qtd_quadras') + '&socios=' + jQuery('#types__select_first').val() + '&reservation__dates=true';
                  });
                </script>
              </div>
              <div class="parte2" style="float: right; border-left: 1px solid black; padding-left: 2%;padding-bottom: 10%;">  
                <h3><strong style="margin-bottom: 1px;">Resumo da Reserva</strong></h3>
                <h5>Total a Pagar: $0,00</h5>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <?php 

    $socios = $_GET['socios'];

    $jogadores = 4 - $socios; 

    if($socios != 0){
      if($socios == 4){
        $total = 4 * $preco_atleta_socio_baixa;
      }else{
        $total = $preco_atleta_comum_baixa * $jogadores + $preco_atleta_socio_baixa * $socios;
      }
    }else{
      $total = 4 * $preco_atleta_comum_baixa;
    }

    $totalString = number_format($total, 2);

    $sociosString = number_format(($socios * $preco_atleta_socio_baixa), 2);

    $jogadoresString = number_format( ($jogadores * $preco_atleta_comum_baixa), 2);
  
  ?>

  <?php if (isset($_GET['reservation__dates'])): ?>
  <section class="reservation__block" id="reservation__dates">
    <div class="container">
      <ul class="steps">
        <li>Selecione os clubes</li>
        <li>Selecione os tipos de jogadores</li>
        <li class="active">Selecione a data</li>
        <li>Selecione os horários</li>
        <li>Selecione os extras</li>
        <li>Realize o pagamento</li>
      </ul>
      <div class="row" style="padding-bottom: 20% !important;">
        <div class="col-md-8 col-md-offset-2 col-sm-12">
          <div class="row" style="padding-top: 10%;">
            <div class="parte1" style="float: left; width: 70%;">
              <h2>Selecione a data da reserva</h2>
              <!-- <input data-date-inline-picker="true" onclick="pureJSCalendar.open('dd.MM.yyyy', 20, 30, 1, '2018-5-5', '2019-8-20', 'example', 20);" type="text" id="example"> -->
              <div id="my-calendar" data-language="pt" ></div>
              <script>
                var element = document.getElementById("my-calendar");
                var date = 0;
                var newDate;
                // Create the calendar
                var myCalendar = jsCalendar.new(element, "01/01/2018",{

                  // language
                  language : "pt",
                  // Enable/Disable date's number zero fill
                  zeroFill : false,
                  monthFormat : "month",
                  dayFormat : "D",
                  firstDayOfTheWeek: 1,
                  navigatorPosition : "both",
                  min : false,
                  max : false

                });

                function dataAtualFormatada(date){
                  var data = date,
                      dia  = data.getDate().toString(),
                      diaF = (dia.length == 1) ? '0'+dia : dia,
                      mes  = (data.getMonth()+1).toString(), //+1 pois no getMonth Janeiro começa com zero.
                      mesF = (mes.length == 1) ? '0'+mes : mes,
                      anoF = data.getFullYear();
                  return diaF+"/"+mesF+"/"+anoF;
                }
                
                jQuery("#my-calendar table").css('box-shadow', '0px');
                jQuery("#my-calendar table td").removeClass('jsCalendar-current');

                jQuery("#my-calendar table td").click(function(){
                  jQuery("#my-calendar table td").removeClass('jsCalendar-current');
                  jQuery(this).addClass('jsCalendar-current');
                });

                myCalendar.onDateClick(function(event, date){
                    // date = date;
                    date = dataAtualFormatada(date);
                    date = date.replace(/\//g, '.');
                    newDate = date;
                    console.log(date);
                });

             

              </script>

              <a class="date__button before__button data-before">Voltar</a>
              <script type="text/javascript">
                jQuery('.data-before').click(function(){
                  window.location.href =  window.location.href.split('?')[0]+ '?clubes=' + getUrlParameter('clubes') + '&qtd_quadras=' + getUrlParameter('qtd_quadras') + '&quadra=' + getUrlParameter('quadra') + '&reservation__types=true';
                });
              </script>
              <a class="date__button next__button proximo-button">Próximo</a>
              <script type="text/javascript">
                jQuery('.proximo-button').click(function(){
                  window.location.href =  window.location.href.split('?')[0]+ '?clubes=' + getUrlParameter('clubes') + '&qtd_quadras=' + getUrlParameter('qtd_quadras') + '&socios=' + getUrlParameter('socios') + '&date=' + newDate + '&reservation__hours=true';
                });
              </script>
            </div>
            <div class="parte2" style="float: right; border-left: 1px solid black; padding-left: 2%;">  
              <h3><strong style="margin-bottom: 1px;">Resumo da Reserva</strong></h3>
              <p style="margin-bottom: 1px;">Valor por Sócio: $<?php echo $sociosString; ?></p>
              <p style="margin-bottom: 1px;">Valor por Não Sócio: $<?php echo $jogadoresString; ?></p>
              <h5>Total a Pagar: $<?php echo $totalString; ?></h5>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php endif; ?>


  <?php if (isset($_GET['reservation__hours'])): ?>
  <section class="reservation__block" id="reservation__hours">
    <table>
        <tr>
            
        </tr>
    </table>
    <div class="container">
      <ul class="steps">
        <li>Selecione os clubes</li>
        <li>Selecione os tipos de jogadores</li>
        <li>Selecione a data</li>
        <li class="active">Selecione os horários</li>
        <li>Selecione os extras</li>
        <li>Realize o pagamento</li>
      </ul>
      <div class="row" style="padding-bottom: 55%;">
        <div class="col-md-8 col-md-offset-2 col-sm-12">

          <?php 
 
            $args = array(
            'post_type'   => 'reservab'
            );

            $horarios = array("06:00", "06:30", "07:00", "07:30", "08:00", "08:30", "09:00", "09:30", "10:00", "10:30", "11:00", "11:30", "12:00", "12:30", "13:00", "13:30", "14:00", "14:30", "15:00", "15:30", "16:00", "16:30", "17:00", "17:30", "18:00", "18:30", "19:00", "19:30", "20:00", "20:30", "21:00", "21:30", "22:00", "22:30", "23:00");


            $todosHorarios = array();     
            $reservas = new WP_Query( $args );
            if($reservas->have_posts() ){
              while($reservas->have_posts() ){
                $reservas->the_post();
                $id = get_the_id();

                $data_reserva = get_field("data", $id);
                $clube_reserva = get_field("clube", $id);
                $quadra_reserva = get_field("quadra", $id);
                $quadra_reserva_obj = get_field_object("quadra", $id);
          
                if($data_reserva == $_GET['date'] && $clube_reserva == intval($_GET['clubes'])){

                  $reserva_hora_inicial = get_field("hora_inicial", $id);
                  $reserva_hora_final = get_field("hora_final", $id);

                  $horarioCompleto = array(
                    'horario_entrada' => $reserva_hora_inicial,
                    'horario_saida'   => $reserva_hora_final,
                    'quadra'          => $quadra_reserva
                  );
                }

                array_push($todosHorarios, $horarioCompleto);
                
              }
            }

            $intervaloHorario = array();
            $quadra_horario = array();
            foreach ($horarios as $key => $hora) {
              foreach ($todosHorarios as $horaCompleta) {
                if($hora == $horaCompleta['horario_entrada']){
                  for ($i=$key; $horarios[$i] != $horaCompleta['horario_saida']; $i++) { 
                   
                    array_push($intervaloHorario, $horarios[$i]);
                   
                    if($quadra_horario[$horaCompleta['quadra']]){
                      if(in_array($horarios[$i], $quadra_horario[$horaCompleta['quadra']]) == false){
                        array_push($quadra_horario[$horaCompleta['quadra']], $horarios[$i]);
                      }
                    }else{
                      $aux = array($horarios[$i]);
                      // $quadra_horario[$horaCompleta['quadra']] = $aux;
                      $quadra_horario += [$horaCompleta['quadra'] => $aux];
                    }
                  
                  }
                  array_push($intervaloHorario, $horaCompleta['horario_saida']);
                }
              }
            }

            $clube_escolhido = "Clube " + $_GET['clubes'];
            $qtd_quadras = 0;
            if( have_rows('clube_quadras') ):
              // loop through the rows of data
              while ( have_rows('clube_quadras') ) : the_row();
                  if(get_sub_field('clube_brapadel') == $clube_escolhido){
                    $qtd_quadras = get_sub_field('quadras_brapadel');
                  }
              endwhile;
            endif;

            $qtd_quadras = $_GET['qtd_quadras'];
            $quadra_horario[1] = $quadra_horario[""];
            unset($quadra_horario[""]);
            // echo "heakjhakesj " . var_dump($quadra_horario);
            // echo "aqui " . $quadra_horario[2][1] . " falou";
          ?>

          <div class="row" style="padding-top: 10%;">
            <div class="parte1" style="float: left; width: 70%;">
              <h2>Selecione a Quadra e os Horários</h2>
              <table style="width: 70%; color: black;" class="customers">
                  <tr>
                    <?php 
                      for ($i=0; $i < $qtd_quadras; $i++) { 
                        ?><th colspan="2" >Quadra <?php echo ($i + 1); ?></th><?php
                      }
                    ?>
                  </tr>
                  <tr>
                    <?php 
                      for ($i=0; $i < $qtd_quadras; $i++) { 
                        if(in_array("06:00", $quadra_horario[($i + 1)])){
                          ?><td id="1-<?php echo ($i + 1); ?>" style="background-color: #ff5757; color: #000000c2;">6h - 6h30</td><?php
                        }else{
                          ?><td id="1-<?php echo ($i + 1); ?>" class="table__cell table__cell--col<?php echo ($i + 1); ?>">6h - 6h30</td><?php
                        }
                        if(in_array("14:30", $quadra_horario[($i + 1)])){
                          ?><td id="18-<?php echo ($i + 1); ?>" style="background-color: #ff5757; color: #000000c2;">14h30 - 15h</td><?php
                        }else{
                          ?><td id="18-<?php echo ($i + 1); ?>" class="table__cell table__cell--col<?php echo ($i + 1); ?>">14h30 - 15h</td><?php
                        }
                      }
                    ?>
                  </tr>
                  <tr>
                    <?php 
                        for ($i=0; $i < $qtd_quadras; $i++) { 
                          if(in_array("06:30", $quadra_horario[($i + 1)])){
                            ?><td id="2-<?php echo ($i + 1); ?>" style="background-color: #ff5757; color: #000000c2;">6h30 - 7h</td><?php
                          }else{
                            ?><td id="2-<?php echo ($i + 1); ?>" class="table__cell table__cell--col<?php echo ($i + 1); ?>">6h30 - 7h</td><?php
                          }
                          if(in_array("15:00", $quadra_horario[($i + 1)])){
                            ?><td id="19-<?php echo ($i + 1); ?>" style="background-color: #ff5757; color: #000000c2;">15h - 15h30</td><?php
                          }else{
                            ?><td id="19-<?php echo ($i + 1); ?>" class="table__cell table__cell--col<?php echo ($i + 1); ?>">15h - 15h30</td><?php
                          }
                        }
                      ?>
                  </tr>
                  <tr>
                    <?php 
                      for ($i=0; $i < $qtd_quadras; $i++) { 
                        if(in_array("07:00", $quadra_horario[($i + 1)])){
                          ?><td id="3-<?php echo ($i + 1); ?>" style="background-color: #ff5757; color: #000000c2;">7h - 7h30</td><?php
                        }else{
                          ?><td id="3-<?php echo ($i + 1); ?>" class="table__cell table__cell--col<?php echo ($i + 1); ?>">7h - 7h30</td><?php
                        }
                        if(in_array("15:30", $quadra_horario[($i + 1)])){
                          ?><td id="20-<?php echo ($i + 1); ?>" style="background-color: #ff5757; color: #000000c2;">15h30 - 16h</td><?php
                        }else{
                          ?><td id="20-<?php echo ($i + 1); ?>" class="table__cell table__cell--col<?php echo ($i + 1); ?>">15h30 - 16h</td><?php
                        }
                      }
                    ?>
                  </tr>
                  <tr>
                    <?php 
                      for ($i=0; $i < $qtd_quadras; $i++) { 
                        if(in_array("07:30", $quadra_horario[($i + 1)])){
                          ?><td id="4-<?php echo ($i + 1); ?>" style="background-color: #ff5757; color: #000000c2;">7h30 - 8h</td><?php
                        }else{
                          ?><td id="4-<?php echo ($i + 1); ?>" class="table__cell table__cell--col<?php echo ($i + 1); ?>">7h30 - 8h</td><?php
                        }
                        if(in_array("16:00", $quadra_horario[($i + 1)])){
                          ?><td id="21-<?php echo ($i + 1); ?>" style="background-color: #ff5757; color: #000000c2;">16h - 16h30</td><?php
                        }else{
                          ?><td id="21-<?php echo ($i + 1); ?>" class="table__cell table__cell--col<?php echo ($i + 1); ?>">16h - 16h30</td><?php
                        }
                      }
                    ?>
                  </tr>
                  <tr>
                    <?php 
                      for ($i=0; $i < $qtd_quadras; $i++) { 
                        if(in_array("08:00", $quadra_horario[($i + 1)])){
                          ?><td id="5-<?php echo ($i + 1); ?>" style="background-color: #ff5757; color: #000000c2;">8h - 8h30</td><?php
                        }else{
                          ?><td id="5-<?php echo ($i + 1); ?>" class="table__cell table__cell--col<?php echo ($i + 1); ?>">8h - 8h30</td><?php
                        }
                        if(in_array("16:30", $quadra_horario[($i + 1)])){
                          ?><td id="22-<?php echo ($i + 1); ?>" style="background-color: #ff5757; color: #000000c2;">16h30 - 17h</td><?php
                        }else{
                          ?><td id="22-<?php echo ($i + 1); ?>" class="table__cell table__cell--col<?php echo ($i + 1); ?>">16h30 - 17h</td><?php
                        }
                      }
                    ?>
                  </tr>
                  <tr>
                    <?php 
                      for ($i=0; $i < $qtd_quadras; $i++) { 
                        if(in_array("08:30", $quadra_horario[($i + 1)])){
                          ?><td id="6-<?php echo ($i + 1); ?>" style="background-color: #ff5757; color: #000000c2;">8h30 - 9h</td><?php
                        }else{
                          ?><td id="6-<?php echo ($i + 1); ?>" class="table__cell table__cell--col<?php echo ($i + 1); ?>">8h30 - 9h</td><?php
                        }
                        if(in_array("17:00", $quadra_horario[($i + 1)])){
                          ?><td id="23-<?php echo ($i + 1); ?>" style="background-color: #ff5757; color: #000000c2;">17h - 17h30</td><?php
                        }else{
                          ?><td id="23-<?php echo ($i + 1); ?>" class="table__cell table__cell--col<?php echo ($i + 1); ?>">17h - 17h30</td><?php
                        }
                      }
                    ?>
                  </tr>
                  <tr>
                    <?php 
                      for ($i=0; $i < $qtd_quadras; $i++) { 
                        if(in_array("09:00", $quadra_horario[($i + 1)])){
                          ?><td id="7-<?php echo ($i + 1); ?>" style="background-color: #ff5757; color: #000000c2;">9h - 9h30</td><?php
                        }else{
                          ?><td id="7-<?php echo ($i + 1); ?>" class="table__cell table__cell--col<?php echo ($i + 1); ?>">9h - 9h30</td><?php
                        }
                        if(in_array("17:30", $quadra_horario[($i + 1)])){
                          ?><td id="24-<?php echo ($i + 1); ?>" style="background-color: #ff5757; color: #000000c2;">17h30 - 18h</td><?php
                        }else{
                          ?><td id="24-<?php echo ($i + 1); ?>" class="table__cell table__cell--col<?php echo ($i + 1); ?>">17h30 - 18h</td><?php
                        }
                      }
                    ?>
                  </tr>
                  <tr>
                    <?php 
                      for ($i=0; $i < $qtd_quadras; $i++) { 
                        if(in_array("09:30", $quadra_horario[($i + 1)])){
                          ?><td id="8-<?php echo ($i + 1); ?>" style="background-color: #ff5757; color: #000000c2;">9h30 - 10h</td><?php
                        }else{
                          ?><td id="8-<?php echo ($i + 1); ?>" class="table__cell table__cell--col<?php echo ($i + 1); ?>">9h30 - 10h</td><?php
                        }
                        if(in_array("18:00", $quadra_horario[($i + 1)])){
                          ?><td id="25-<?php echo ($i + 1); ?>" style="background-color: #ff5757; color: #000000c2;">18h - 18h30</td><?php
                        }else{
                          ?><td id="25-<?php echo ($i + 1); ?>" class="table__cell table__cell--col<?php echo ($i + 1); ?>">18h - 18h30</td><?php
                        }
                      }
                    ?>
                  </tr>
                  <tr>
                    <?php 
                      for ($i=0; $i < $qtd_quadras; $i++) { 
                        if(in_array("10:00", $quadra_horario[($i + 1)])){
                          ?><td id="9-<?php echo ($i + 1); ?>" style="background-color: #ff5757; color: #000000c2;">10h - 10h30</td><?php
                        }else{
                          ?><td id="9-<?php echo ($i + 1); ?>" class="table__cell table__cell--col<?php echo ($i + 1); ?>">10h - 10h30</td><?php
                        }
                        if(in_array("18:30", $quadra_horario[($i + 1)])){
                          ?><td id="26-<?php echo ($i + 1); ?>" style="background-color: #ff5757; color: #000000c2;">18h30 - 19h</td><?php
                        }else{
                          ?><td id="26-<?php echo ($i + 1); ?>" class="table__cell table__cell--col<?php echo ($i + 1); ?>">18h30 - 19h</td><?php
                        }
                      }
                    ?>
                  </tr>
                  <tr>
                    <?php 
                      for ($i=0; $i < $qtd_quadras; $i++) { 
                        if(in_array("10:30", $quadra_horario[($i + 1)])){
                          ?><td id="10-<?php echo ($i + 1); ?>" style="background-color: #ff5757; color: #000000c2;">10h30 - 11h</td><?php
                        }else{
                          ?><td id="10-<?php echo ($i + 1); ?>" class="table__cell table__cell--col<?php echo ($i + 1); ?>">10h30 - 11h</td><?php
                        }
                        if(in_array("19:00", $quadra_horario[($i + 1)])){
                          ?><td id="27-<?php echo ($i + 1); ?>" style="background-color: #ff5757; color: #000000c2;">19h - 19h30</td><?php
                        }else{
                          ?><td id="27-<?php echo ($i + 1); ?>" class="table__cell table__cell--col<?php echo ($i + 1); ?>">19h - 19h30</td><?php
                        }
                      }
                    ?>
                  </tr>
                  <tr>
                    <?php 
                      for ($i=0; $i < $qtd_quadras; $i++) { 
                        if(in_array("11:00", $quadra_horario[($i + 1)])){
                          ?><td id="11-<?php echo ($i + 1); ?>" style="background-color: #ff5757; color: #000000c2;">11h - 11h30</td><?php
                        }else{
                          ?><td id="11-<?php echo ($i + 1); ?>" class="table__cell table__cell--col<?php echo ($i + 1); ?>">11h - 11h30</td><?php
                        }
                        if(in_array("19:30", $quadra_horario[($i + 1)])){
                          ?><td id="28-<?php echo ($i + 1); ?>" style="background-color: #ff5757; color: #000000c2;">19h30 - 20h</td><?php
                        }else{
                          ?><td id="28-<?php echo ($i + 1); ?>" class="table__cell table__cell--col<?php echo ($i + 1); ?>">19h30 - 20h</td><?php
                        }
                      }
                    ?>
                  </tr>
                  <tr>
                    <?php 
                      for ($i=0; $i < $qtd_quadras; $i++) { 
                        if(in_array("11:30", $quadra_horario[($i + 1)])){
                          ?><td id="12-<?php echo ($i + 1); ?>" style="background-color: #ff5757; color: #000000c2;">11h30 - 12h</td><?php
                        }else{
                          ?><td id="12-<?php echo ($i + 1); ?>" class="table__cell table__cell--col<?php echo ($i + 1); ?>">11h30 - 12h</td><?php
                        }
                        if(in_array("20:00", $quadra_horario[($i + 1)])){
                          ?><td id="29-<?php echo ($i + 1); ?>" style="background-color: #ff5757; color: #000000c2;">20h - 20h30</td><?php
                        }else{
                          ?><td id="29-<?php echo ($i + 1); ?>" class="table__cell table__cell--col<?php echo ($i + 1); ?>">20h - 20h30</td><?php
                        }
                      }
                    ?>
                  </tr>
                  <tr>
                    <?php 
                      for ($i=0; $i < $qtd_quadras; $i++) { 
                        if(in_array("12:00", $quadra_horario[($i + 1)])){
                          ?><td id="13-<?php echo ($i + 1); ?>" style="background-color: #ff5757; color: #000000c2;">12h - 12h30</td><?php
                        }else{
                          ?><td id="13-<?php echo ($i + 1); ?>" class="table__cell table__cell--col<?php echo ($i + 1); ?>">12h - 12h30</td><?php
                        }
                        if(in_array("20:30", $quadra_horario[($i + 1)])){
                          ?><td id="30-<?php echo ($i + 1); ?>" style="background-color: #ff5757; color: #000000c2;">20h30 - 21h</td><?php
                        }else{
                          ?><td id="30-<?php echo ($i + 1); ?>" class="table__cell table__cell--col<?php echo ($i + 1); ?>">20h30 - 21h</td><?php
                        }
                      }
                    ?>
                  </tr>
                  <tr>
                    <?php 
                      for ($i=0; $i < $qtd_quadras; $i++) { 
                        if(in_array("12:30", $quadra_horario[($i + 1)])){
                          ?><td id="14-<?php echo ($i + 1); ?>" style="background-color: #ff5757; color: #000000c2;">12h30 - 13h</td><?php
                        }else{
                          ?><td id="14-<?php echo ($i + 1); ?>" class="table__cell table__cell--col<?php echo ($i + 1); ?>">12h30 - 13h</td><?php
                        }
                        if(in_array("21:00", $quadra_horario[($i + 1)])){
                          ?><td id="31-<?php echo ($i + 1); ?>" style="background-color: #ff5757; color: #000000c2;">21h - 21h30</td><?php
                        }else{
                          ?><td id="31-<?php echo ($i + 1); ?>" class="table__cell table__cell--col<?php echo ($i + 1); ?>">21h - 21h30</td><?php
                        }
                      }
                    ?>
                  </tr>
                  <tr>
                    <?php 
                      for ($i=0; $i < $qtd_quadras; $i++) { 
                        if(in_array("13:00", $quadra_horario[($i + 1)])){
                          ?><td id="15-<?php echo ($i + 1); ?>" style="background-color: #ff5757; color: #000000c2;">13h - 13h30</td><?php
                        }else{
                          ?><td id="15-<?php echo ($i + 1); ?>" class="table__cell table__cell--col<?php echo ($i + 1); ?>">13h - 13h30</td><?php
                        }
                        if(in_array("21:30", $quadra_horario[($i + 1)])){
                          ?><td id="32-<?php echo ($i + 1); ?>" style="background-color: #ff5757; color: #000000c2;">21h30 - 22h</td><?php
                        }else{
                          ?><td id="32-<?php echo ($i + 1); ?>" class="table__cell table__cell--col<?php echo ($i + 1); ?>">21h30 - 22h</td><?php
                        }
                      }
                    ?>
                  </tr>
                  <tr>
                    <?php 
                      for ($i=0; $i < $qtd_quadras; $i++) { 
                        if(in_array("13:30", $quadra_horario[($i + 1)])){
                          ?><td id="16-<?php echo ($i + 1); ?>" style="background-color: #ff5757; color: #000000c2;">13h30 - 14h</td><?php
                        }else{
                          ?><td id="16-<?php echo ($i + 1); ?>" class="table__cell table__cell--col<?php echo ($i + 1); ?>">13h30 - 14h</td><?php
                        }
                        if(in_array("22:00", $quadra_horario[($i + 1)])){
                          ?><td id="33-<?php echo ($i + 1); ?>" style="background-color: #ff5757; color: #000000c2;">22h - 22h30</td><?php
                        }else{
                          ?><td id="33-<?php echo ($i + 1); ?>" class="table__cell table__cell--col<?php echo ($i + 1); ?>">22h - 22h30</td><?php
                        }
                      }
                    ?>
                  </tr>
                  <tr>
                    <?php 
                      for ($i=0; $i < $qtd_quadras; $i++) { 
                        if(in_array("14:00", $quadra_horario[($i + 1)])){
                          ?><td id="17-<?php echo ($i + 1); ?>" style="background-color: #ff5757; color: #000000c2;">14h - 14h30</td><?php
                        }else{
                          ?><td id="17-<?php echo ($i + 1); ?>" class="table__cell table__cell--col<?php echo ($i + 1); ?>">14h - 14h30</td><?php
                        }
                        if(in_array("22:30", $quadra_horario[($i + 1)])){
                          ?><td id="34-<?php echo ($i + 1); ?>" style="background-color: #ff5757; color: #000000c2;">22h30 - 23h</td><?php
                        }else{
                          ?><td id="34-<?php echo ($i + 1); ?>" class="table__cell table__cell--col<?php echo ($i + 1); ?>">22h30 - 23h</td><?php
                        }
                      }
                    ?>
                  </tr>
                </table>
                <br><br>
                <script type="text/javascript">
                  var horario_inicial = 0;
                  var horario_final = 0;
                  var quadra = 0;
                  
                  jQuery('.table__cell').click(function(){
                    var numItems = jQuery('.selected').length;
                    if(jQuery(this).hasClass("selected")){
                      console.log("numitems " + numItems);
                      if(numItems >= 3){
                       
                          jQuery(".selected").removeClass("selected");
                        
                      }else{
                        jQuery(this).removeClass("selected");
                      }
                      return;
                    }


                    var length = jQuery('.table__cell.selected').length;
                    if(length > 0 && length < 4){
                      if(jQuery(this).parent().is(':first-child') && jQuery("#" + (parseInt((jQuery(this).attr('id')).substr(0, (jQuery(this).attr('id')).indexOf('-'))) + 1) + "-" + jQuery(this).attr('id').slice(-1).slice(-1)).hasClass("selected")){
                        jQuery(this).addClass("selected");
                        horarios += ',' + jQuery( this ).html();
                      }else if(jQuery(this).parent().is(':last-child') && jQuery("#" + (parseInt((jQuery(this).attr('id')).substr(0, (jQuery(this).attr('id')).indexOf('-'))) - 1) + "-" + jQuery(this).attr('id').slice(-1).slice(-1)).hasClass("selected")){
                        jQuery(this).addClass("selected");
                        horarios += ',' + jQuery( this ).html();
                      }else if(jQuery("#" + (parseInt((jQuery(this).attr('id')).substr(0, (jQuery(this).attr('id')).indexOf('-'))) + 1) + "-" + jQuery(this).attr('id').slice(-1).slice(-1)).hasClass("selected")
                      || jQuery("#" + (parseInt((jQuery(this).attr('id')).substr(0, (jQuery(this).attr('id')).indexOf('-'))) - 1) + "-" + jQuery(this).attr('id').slice(-1).slice(-1)).hasClass("selected")){
                        jQuery(this).addClass("selected");
                        horarios += ',' + jQuery( this ).html();
                      }else{
                        jQuery('.table__cell').removeClass('selected');
                        jQuery(this).addClass("selected");
                        horarios = jQuery( this ).html();
                      }
                    }else if(length == 0){
                      jQuery(this).addClass("selected");
                      horarios = jQuery( this ).html();
                    } else if(length == 4){
                      if(!jQuery(this).hasClass("selected")) {
                        jQuery('.table__cell').removeClass('selected');
                        jQuery(this).addClass("selected");
                        horarios = jQuery( this ).html();

                      }
                    }
                    console.log(horarios);

                    horario_inicial = 0;
                    horario_final = 0;

                    if(horarios.split(" - ").length > 0){
                      quadra = jQuery('.table__cell.selected').attr("class");
                      quadra = quadra.substr(0, quadra.length - 9);
                      quadra = quadra[quadra.length - 1];
                      console.log("Split " + horarios.split(" - "));

                      horario_inicial = 0;
                      horario_final = 0;

                      horarios_n = horarios.split(" - ");
                      horario_inicial = horarios_n[0].replace("h", ":00");
                      horario_inicial = horarios_n[0].replace("h30", ":30");
                      horario_inicial = horario_inicial.replace("h", ":00");

                      horario_final = horarios_n[horarios_n.length - 1].replace("h", ":00");
                      horario_final = horarios_n[horarios_n.length - 1].replace("h30", ":30");
                      horario_final = horario_final.replace("h", ":00");
                    }

                  });
                </script>
                <a class="hours__button before__button hours-before">Voltar</a>
                <script type="text/javascript">
                  jQuery('.hours-before').click(function(){
                    window.location.href =  window.location.href.split('?')[0]+ '?clubes=' + getUrlParameter('clubes') + '&qtd_quadras=' + getUrlParameter('qtd_quadras') + '&quadra=' + getUrlParameter('quadra') + '&socios=' + getUrlParameter('socios') + '&reservation__dates=true';
                  });
                </script>
                <a class="hours__button next__button hours-next">Próximo</a>
                <script type="text/javascript">

                  var date = getUrlParameter('date').split(".");

                  date_obj = new Date( parseInt(date[2]),  parseInt(date[1]) - 1,  parseInt(date[0]), 0, 0, 0, 0);
                
                  function validaHora(){

                    if(date_obj.getDay() == 6 || date_obj.getDay() == 0){ 
                      weekend = true;;
                    }else{
                      weekend = false;
                    }
                    var hora_inicial = "00:00";
                    var hora_final = "00:00"; 
                    
                    hora_inicial = horario_inicial;
                    hora_final = horario_final;

                    hora_inicial = hora_inicial.split(":");
                    hora_final = hora_final.split(":");

                    hora_inicial[0] = Number(hora_inicial[0]);
                    hora_inicial[1] = Number(hora_inicial[1]);

                    hora_final[0] = Number(hora_final[0]);
                    hora_final[1] = Number(hora_final[1]);

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

                    return true;
                  }

                  jQuery('.hours-next').click(function(){
                    if(validaHora()){
                      window.location.href =  window.location.href.split('?')[0]+ '?clubes=' + getUrlParameter('clubes') + '&qtd_quadras=' + getUrlParameter('qtd_quadras') + '&quadra=' + quadra + '&socios=' + getUrlParameter('socios') + '&date=' + getUrlParameter('date') + '&horario_inicial=' + horario_inicial + '&horario_final=' + horario_final + '&reservation_extras=true';
                    }else{
                 
                      alert("Horário Inválido!");
                      
                    }
                  });
                </script>
                </div>
                  <div class="parte2" style="float: right; border-left: 1px solid black; padding-left: 2%;">  
                    <h3><strong style="margin-bottom: 1px;">Resumo da Reserva</strong></h3>
                    <p>Data: <?php echo str_replace(".", "/", $_GET['date']); ?></p>
                    <p style="margin-bottom: 1px;">Valor por Sócio: $<?php echo $sociosString; ?></p>
                    <p style="margin-bottom: 1px;">Valor por Não Sócio: $<?php echo $jogadoresString; ?></p>
                    <h5>Total a Pagar: $<?php echo $totalString; ?></h5>
                  </div>
                </div>
              </div>
          <br><br><br>         
        </div>
      </div>
    </div>
  </section>
  <?php endif; ?>


  <?php 
  
    function isWeekend($date) {
      if(date('N', strtotime($date)) == 6 || date('N', strtotime($date)) == 7){
        return true;
      }else{
        return false;
      }
    }

    $date = $_GET['date'];
    $hora_inicial = $_GET['horario_inicial'];
    $hora_final = $_GET['horario_final'];

    $hora_inicial = explode(":", $hora_inicial);
    $hora_inicial = intval($hora_inicial[0]);
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

        $jogadores = 4 - $socios; 

        if($socios != 0){
          if($socios == 4){
            $total = 4 * $preco_atleta_socio_baixa;
          }else{
            $total = $preco_atleta_comum_baixa * $jogadores + $preco_atleta_socio_baixa * $socios;
          }
        }else{
          $total = 40;
        }

        $preco_horario_comum = $preco_atleta_comum_baixa;
        $preco_horario_socio = $preco_atleta_socio_baixa;

        $totalString = number_format($total, 2);
      }else{
        $jogadores = 4 - $socios; 

        if($socios != 0){
          if($socios == 4){
            $total = 4 * $preco_atleta_socio_alta;
          }else{
            $total = ($preco_atleta_comum_alta * $jogadores) + ($preco_atleta_socio_alta * $socios);
          }
        }else{
          $total = 4 * $preco_atleta_comum_alta;
        }

        $preco_horario_comum = $preco_atleta_comum_alta;
        $preco_horario_socio = $preco_atleta_socio_alta;

        $totalString = number_format($total, 2);
      }

 

      if($horario_alta == false){
    
        $jogadores = 4 - $socios; 

        if($socios != 0){
          if($socios == 4){
            $totalClube = 4 * $preco_atleta_socio_baixa_pagamento_clube;
          }else{
            $totalClube = ($preco_atleta_comum_baixa_pagamento_clube * $jogadores) + ($preco_atleta_socio_baixa_pagamento_clube * $socios);
          }
        }else{
          $totalClube = (4 * $preco_atleta_comum_baixa_pagamento_clube) + 5;
        }

        $preco_horario_comum = $preco_atleta_comum_baixa;
        $preco_horario_socio = $preco_atleta_socio_baixa;
      }else{
        $jogadores = 4 - $socios; 

        if($socios != 0){
          if($socios == 4){
            $totalClube = 4 * $preco_atleta_socio_alta_pagamento_clube;
          }else{
            $totalClube = ($preco_atleta_comum_alta_pagamento_clube * $jogadores) + ($preco_atleta_socio_alta_pagamento_clube * $socios);
          }
        }else{
          $totalClube = 4 * $preco_atleta_comum_alta_pagamento_clube;
        }

        
        $preco_horario_comum = $preco_atleta_comum_alta;
        $preco_horario_socio = $preco_atleta_socio_alta;
      }

      $hora_inicial = $_GET['horario_inicial'];

      $hora_inicial = explode(":", $hora_inicial);
      
      if(($hora_inicial[0] >= 18) && ($hora_inicial[1] == 30 || $hora_inicial[1] == 0)){
        $total = $total + $luz;
        $totalClube = $totalClube + $luz;
        $cobrandoLuz = true;
      }else{
        $cobrandoLuz = false;
      }
      $totalString = number_format($total, 2);

      $totalClubeString = number_format($totalClube, 2);

      $sociosString = number_format(($socios * $preco_horario_socio), 2);

      $jogadoresString = number_format( ($jogadores * $preco_horario_comum), 2);

  ?>

  <?php if (isset($_GET['reservation_extras'])): ?>
  <section class="reservation__block" id="reservation_extras">
    <div class="container">
      <ul class="steps">
        <li>Selecione os clubes</li>
        <li>Selecione os tipos de jogadores</li>
        <li>Selecione a data</li>
        <li>Selecione os horários</li>
        <li class="active">Selecione os extras</li>
        <li>Realize o pagamento</li>
      </ul>
      <div class="row" style="padding-bottom: 30%;">
        <div class="col-md-8 col-md-offset-2 col-sm-12">
        <div class="row" style="padding-top: 10%;">
            <div class="parte1" style="float: left; width: 70%;">
              <h2 id="h2-selecione-extras">Selecione os extras</h2>
              <label style="float: left;" for="">Alugar raquetes?</label>
              <select id="raquetes_select" name="types__select">
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>

              </select>
              <label for="">Comprar bolinhas?</label>
              <select id="bolinhas_select" class="clubes__select" name="types__select">
                <option value="0">Não</option>
                <option value="1">Um tubo</option>
                <option value="2">Dois tubos</option>
                <option value="3">Três tubos</option>
              </select>
              <a class="extras__button before__button extras-before">Voltar</a>
              <script type="text/javascript">
                jQuery('.extras-before').click(function(){
                  window.location.href =  window.location.href.split('?')[0]+ '?clubes=' + getUrlParameter('clubes') + '&qtd_quadras=' + getUrlParameter('qtd_quadras') + '&quadra=' + getUrlParameter('quadra') + '&socios=' + getUrlParameter('socios') + '&date=' +  getUrlParameter('date') + '&reservation__hours=true';
                });
              </script>
              <a class="extras__button next__button extras-next">Próximo</a>
              <script type="text/javascript">
                jQuery('.extras-next').click(function(){

                  function validaHora(){

                    var url_string = window.location.href;
                    var url = new URL(url_string);
                    var hora_inicial = url.searchParams.get("horario_inicial");
                    var hora_final = url.searchParams.get("horario_final");
                  
                    hora_inicial = hora_inicial.split(":");
                    hora_final = hora_final.split(":");

                    hora_inicial[0] = Number(hora_inicial[0]);
                    hora_inicial[1] = Number(hora_inicial[1]);

                    hora_final[0] = Number(hora_final[0]);
                    hora_final[1] = Number(hora_final[1]);

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

                  if(validaHora()){
                    window.location.href =  window.location.href.split('?')[0]+ '?clubes=' + getUrlParameter('clubes') + '&socios=' + getUrlParameter('socios') + '&date=' +  getUrlParameter('date') + '&qtd_quadras=' + getUrlParameter('qtd_quadras') + '&quadra=' + getUrlParameter('quadra') + '&horario_inicial=' + getUrlParameter('horario_inicial') + '&horario_final=' + getUrlParameter('horario_final') + '&raquetes=' + jQuery('#raquetes_select').val() + '&bolinhas=' + jQuery('#bolinhas_select').val() + '&reservation__payment=true';
                  }else{
                    alert("Horário Inválido!");
                  }
                });
              </script>
            </div>
            <div class="parte2" style="float: right; border-left: 1px solid black; padding-left: 2%;">  
              <h3><strong style="margin-bottom: 1px;">Resumo da Reserva</strong></h3>
                <p style="margin-bottom: 0px;">Data: <?php echo str_replace(".", "/", $_GET['date']); ?></p>
                <p style="margin-bottom: 0px;">Horário de Entrada: <?php echo $_GET["horario_inicial"]; ?></p>
                <p>Horário de Saída: <?php echo $_GET["horario_final"]; ?></p>
                <?php if($cobrandoLuz){ ?>  
                  <p style="margin-bottom: 1px;">Cobrança de luz: $<?php echo $luz; ?></p>
                <?php } ?>  
                <p style="margin-bottom: 1px;">Valor por Sócio: $<?php echo $sociosString; ?></p>
                <p style="margin-bottom: 1px;">Valor por Não Sócio: $<?php echo $jogadoresString; ?></p>
                <h5>Total a Pagar: $<?php echo $totalString; ?></h5>
            </div>
          </div>
          <br><br><br><br><br>

        </div>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <?php 

    $raquetes = $_GET['raquetes'];
    $bolinhas = $_GET['bolinhas'];
    $hora_inicial = $_GET['horario_inicial'];

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
    $totalClube = $totalClube + ($preco_raquete * $raquetes) + ($preco_bolinhas * intval($bolinhas));

    $totalString = number_format($total, 2);
    $totalStringClube = number_format($totalClube, 2);

    $raqueteString = number_format($preco_raquete * $raquetes, 2);
    $bolinhasString = number_format($preco_bolinhas * intval($bolinhas), 2);
    $luzString = number_format($luz, 2);
  
  
  ?>

  <?php if (isset($_GET['reservation__payment'])): ?>
 

  <section class="reservation__block" id="reservation__payment">
    <div class="container">
    <div class="modal"><!-- Place at bottom of page --></div>
      <ul class="steps">
        <li>Selecione os clubes</li>
        <li>Selecione os tipos de jogadores</li>
        <li>Selecione a data</li>
        <li>Selecione os horários</li>
        <li>Selecione os extras</li>
        <li class="active">Realize o pagamento</li>
      </ul>
      <div class="row row_pagamento" style="padding-top: 10%; padding-bottom: 15%;">
        <div class="parte1 pagamento" style="float: left; width: 22%; position: absolute;">
          <h2>Pagamento</h2>
          <div id="div_pagamentos">
            <div id="pagar_online" style="float: left;">
              <label style="font-size: 13px;font-weight: bold;" for="pay_online">Pagar online</label>
              <input id="pay_online" name="pay_online" type="checkbox" />
            </div>
            <div id="pagar_clube" style="margin-bottom: 18px; float: left;">
              <label style="font-size: 13px;font-weight: bold;" for="pay_atm">Pagar no clube</label>
              <input id="pay_atm" name="pay_atm" type="checkbox" />
            </div>
          </div>
          <div class="voltar_pagina_pagamento">
            <a class="extras__button before__button pay-before">Voltar</a>
            <script type="text/javascript">
              jQuery('.pay-before').click(function(){
                window.location.href =  window.location.href.split('?')[0]+ '?clubes=' + getUrlParameter('clubes') + '&socios=' + getUrlParameter('socios') + '&qtd_quadras=' + getUrlParameter('qtd_quadras') + '&quadra=' + getUrlParameter('quadra')  + '&date=' +  getUrlParameter('date') + '&horario_inicial=' + getUrlParameter('horario_inicial') + '&horario_final=' + getUrlParameter('horario_final') + '&reservation_extras=true';
              });
            </script>
            <a id="confirmar-reserva" class="extras__button next__button" style="float: left;display:none;">Confirmar reserva</a>
          </div>
        </div>
        <div class="parte2 resumo_pagamento" style="float: right; border-left: 1px solid black; padding-left: 2%;">  
          <h3>Resumo da Reserva</h3>
          <p style="margin-bottom: 0px;">Data: <?php echo str_replace(".", "/", $_GET['date']); ?></p>
          <p style="margin-bottom: 0px;">Horário de Entrada: <?php echo $_GET["horario_inicial"]; ?></p>
          <p>Horário de Saída: <?php echo $_GET["horario_final"]; ?></p>
          <p style="margin-bottom: 1px;">Valor por Sócio: $<?php echo $sociosString; ?></p>
          <p style="margin-bottom: 1px;">Valor por Não Sócio: $<?php echo $jogadoresString; ?></p>
          <?php if($cobrandoLuz){ ?>
            <p style="margin-bottom: 1px;">Luz da Quadra: $<?php echo $luzString; ?></p>
          <?php } ?>
          <?php if($raqueteString != '0.00'){ ?>
            <p style="margin-bottom: 1px;">Valor das Raquetes: $<?php echo $raqueteString; ?></p>
          <?php } ?>
          <?php if($_GET['bolinhas'] != '0'){ ?>
            <p style="margin-bottom: 1px;">Valor das Bolinhas: $<?php echo $bolinhasString; ?></p>
          <?php } ?>
          <h5 style="margin-bottom: 1px;">Total a Pagar Online: $<?php echo $totalString; ?></h5>
          <h5>Total a Pagar no Clube: $<?php echo $totalStringClube; ?></h5>
        </div>
      </div>
      <br><br><br><br><br>
      
      <script type="text/javascript">
        jQuery('#confirmar-reserva').on("click", function(){
          // var ask = window.confirm("Tem certeza que deseja confirmar reserva?");
            function validaHora(){

              var url_string = window.location.href;
              var url = new URL(url_string);
              var hora_inicial = url.searchParams.get("horario_inicial");
              var hora_final = url.searchParams.get("horario_final");

              hora_inicial = hora_inicial.split(":");
              hora_final = hora_final.split(":");

              hora_inicial[0] = Number(hora_inicial[0]);
              hora_inicial[1] = Number(hora_inicial[1]);

              hora_final[0] = Number(hora_final[0]);
              hora_final[1] = Number(hora_final[1]);

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
            if(validaHora()){
              
                var database = firebase.database();
                console.log(database);
                firebase.database().ref('reservas/' + '<?php echo get_current_user_id(); ?>').set({
                  username: 't',
                  email: 't: ',
                  profile_picture : 't'
                });
                  var url_string = window.location.href;
                  var url = new URL(url_string);
                  var clubes = url.searchParams.get("clubes");
                  var socios = url.searchParams.get("socios");
                  var raquetes = url.searchParams.get("raquetes");
                  var hora_inicial = url.searchParams.get("horario_inicial");
                  var hora_final = url.searchParams.get("horario_final");
                  var data = url.searchParams.get("date");
                  var quadra = url.searchParams.get("quadra");
                  var bolinhas = 0;

                if(jQuery('#pay_atm').is(":checked")){
                
                  var ask = window.confirm("Deseja confirmar reserva?");
                  if(ask){
                    alert("Aguarde enquanto a Reserva é confirmada");
                    jQuery.ajax({
                        type: "POST",
                        url: window.location.href,
                        data: { clube :<?php echo $_GET['clubes']; ?>,
                                socios : socios,
                                horario_inicial : hora_inicial,
                                horario_final : hora_final,
                                data : data,
                                quadra : quadra,
                                raquetes : raquetes,
                                valor : <?php echo $totalClube; ?>,
                                bolinhas : 0},
                        success: function(){
                          // alert("sucesso");
                        },
                        error: function(e){
                          alert("error");
                        }
                    }).done(function( msg ) {
                      alert("Reserva Feita");
                      window.location.replace("https://brapadel.com.br/minhas-reservas");
                    });       
                  }    
                }else{
                  var ask = window.confirm("Deseja confirmar reserva?");
                  if(ask){
                    alert("Aguarde enquanto a Reserva é confirmada");
                    jQuery.ajax({
                        type: "POST",
                        url: window.location.href,
                        data: { clube :<?php echo $_GET['clubes']; ?>,
                                socios : socios,
                                horario_inicial : hora_inicial,
                                horario_final : hora_final,
                                data : data,
                                quadra : quadra,
                                raquetes : raquetes,
                                valor : <?php echo $total; ?>,
                                bolinhas : 0},
                        success: function(){
                          // alert("sucesso");
                        },
                        error: function(e){
                          alert("error");
                        }
                    }).done(function( msg ) {
                      alert("Reserva Feita");
                      window.location.replace("https://brapadel.com.br/minhas-reservas");
                    }); 
                  }
                }
              
            }else{
              alert("Horário Inválido!");
            }
          

        });
      </script>


      <script type="text/javascript">
      jQuery('#pay_online').change(function() {
          if(!jQuery(this).is(":checked")) {
              jQuery("form").css('display', 'none');
              jQuery(".voltar_pagina_pagamento").css("left", "-59%");
          }else{
            jQuery("#pay_atm").prop('checked', false);
            jQuery("form").css('display', 'block');
            jQuery(".extras__button").css('display', 'none');
            jQuery(".voltar_pagina_pagamento").css("left", "-33%");
          }
      });

      jQuery('#pay_atm').change(function() {
          if(!jQuery(this).is(":checked")) {
            jQuery(".voltar_pagina_pagamento").css("left", "-33%");
          }else{
            jQuery("#pay_online").prop('checked', false);
            jQuery("form").css('display', 'none');
            jQuery(".extras__button").css('display', 'block');
            jQuery(".voltar_pagina_pagamento").css("left", "-59%");
          }
      });

      </script>




<?php

  $price_alta = get_field('preco_atleta_comum_alta');
  $price_baixa = get_field('preco_atleta_comum_baixa');

  $socio_alta = get_field('preco_atleta_socio_alta');
  $socio_baixa = get_field('preco_atleta_socio_baixa');

  $luz = get_field('luz');
  $raquete = get_field('aluguel_raquete');

  $tubos = 10;

  $cur_socios = $_GET['socios'];
  $cur_horarios = $_GET['horarios'];
  $cur_raquetes = $_GET['raquetes'];
  $cur_bolinhas = $_GET['bolinhas'];

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clube = $_POST['clube'];
    $quadra = $_POST['quadra'];
    $socios = $_POST['socios'];
    $hora_inicial = $_POST['horario_inicial'];
    $hora_final = $_POST['horario_final'];
    $raquetes = $_POST['raquetes'];
    $bolinhas = $_POST['bolinhas'];
    $data = $_POST['data'];
    $current_user = wp_get_current_user();
    
    $post_id = wp_insert_post(
    array(
        'post_author'   =>  get_currentuserinfo()->ID,                
        'post_type'     => 'reservab',
        'post_title'    => 'Reserva '
    )
    );

    $my_post = array(
    'ID'           =>  $post_id,
    'post_title'   =>  'Reserva ' . $post_id
    );

    wp_update_post( $my_post );
    
    // save a basic text value
    $field_key = "clube";
    $value = $clube;
    update_field( $field_key, $value, $post_id );

    $field_key = "quadra";
    $value = $quadra;
    update_field( $field_key, $value, $post_id );

    // save a basic text value
    $field_key = "socios";
    $value = $socios;
    update_field( $field_key, $value, $post_id );

    $field_key = "data";
    $value = $data;
    update_field( $field_key, $value, $post_id );

    // save a basic text value
    $field_key = "hora_inicial";
    $value = $hora_inicial;
    update_field( $field_key, $value, $post_id );

    // save a basic text value
    $field_key = "hora_final";
    $value = $hora_final;
    update_field( $field_key, $value, $post_id );

    // save a basic text value
    $field_key = "raquetes";
    $value = $raquetes;
    update_field( $field_key, $value, $post_id );

    // save a basic text value
    $field_key = "bolinhas";
    $value = $bolinhas;
    update_field( $field_key, $value, $post_id );
    
    // save a basic text value
    $field_key = "status";
    $value = 1;
    update_field( $field_key, $value, $post_id );

    // save a basic text value
    $field_key = "usuario";
    $value = $current_user->user_firstname . " " . $current_user->user_lastname;
    update_field( $field_key, $value, $post_id );

    $field_key = "valor";
    $value = $_POST['valor'];
    update_field( $field_key, $value, $post_id ); 
    wp_publish_post( $post_id ); 

    $user_data = get_userdata( get_currentuserinfo()->ID );
    
    // the message
    $msg = "Sua Reserva foi cadastrada com sucesso!\nO código da sua reserva é " . $post_id . " e está programada para acontecer no dia " . str_replace(".", "/", $data) . " às  " . $hora_inicial;

    // use wordwrap() if lines are longer than 70 characters
    $msg = wordwrap($msg,70);

    // send email
    mail($user_data->user_email,"Confirmação de Reserva",$msg);

  }


 ?>



      <!-- Declaração do formulário -->
<form method="post" target="pagseguro" style="display: none;"
  action="https://pagseguro.uol.com.br/v2/checkout/payment.html">

          <!-- Campos obrigatórios -->
          <input name="receiverEmail" type="hidden" value="felipelira1908@hotmail.com">
          <input name="currency" type="hidden" value="BRL">

          <!-- Itens do pagamento (ao menos um item é obrigatório) -->
          <input name="itemId1" type="hidden" value="0001">
          <input name="itemDescription1" type="hidden" value="Notebook Prata">
          <input name="itemAmount1" type="hidden" value="<?php echo $totalString; ?>">
          <input name="itemQuantity1" type="hidden" value="1">
          <input name="itemWeight1" type="hidden" value="1000">

          <!-- Código de referência do pagamento no seu sistema (opcional) -->
          <input name="reference" type="hidden" value="REF1234">

          <!-- submit do form (obrigatório) -->
          <input alt="Pague com PagSeguro" name="submit"  type="image"
  src="https://p.simg.uol.com.br/out/pagseguro/i/botoes/pagamentos/120x53-pagar.gif"/>

  </form>
    </div>
  </section>
  <?php endif; ?>

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