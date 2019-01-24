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

    /* .selection-box{
      width: 150%;
    } */

    @media only screen and (max-width: 575px) {
      .jsCalendar thead .jsCalendar-week-days th, .jsCalendar tbody td{
        height: 30px !important;
        width: 30px !important;
      }
      .parte2{
        margin-top: 17%;
        text-align: center;
        border-left: 0px solid white !important;
      } 

      .parte1{
        text-align: center;
        padding-right: 0px !important;
      }

      /* .parte1 #confirmar-reserva{
        margin-left: 20px !important;
      } */
    }

    @media only screen and (max-width: 767px) {
      .parte2{
        
        border-left: 0px solid white !important;
      } 

      .parte1 #confirmar-reserva{
        margin-left: 0px !important;
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
      <div class="row">
        <div class="col-sm">
          <ul class="steps">
            <li class="active">Selecione os clubes</li>
            <li>Selecione a quantidade de sócios</li>
            <li>Selecione a data</li>
            <li>Selecione os horários</li>
            <li>Selecione os extras</li>
            <li>Realize o pagamento</li>
          </ul>
        </div>
      </div>
      <br><br>
      <div class="row" style="padding-bottom: 25%;">
        <div class="parte1 col-sm col-lg-10" style="padding-right: 25%;">
          <h2 id="selecione-clube">Selecione o clube</h2>
          <select class="clubes__select" name="clubes__select">
            <option value="0">Clubes</option>
            <?php 
              foreach ($clube_quadras as $key => $value) {
                ?><option value="<?php echo ($key + 1); ?>"><?php echo $value['Clube']; ?></option><?php 
              }
              ?>
          </select>
          <a  class="clubes__button next__button">Próximo</a>
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
        
        <!-- <div class="parte2 col-lg-2 col-sm" style="float: right; border-left: 1px solid black; padding-left: 2%;" >  
          <h3><strong style="margin-bottom: 1px;">Resumo da Reserva</strong></h3>
          <h5>Total a Pagar: $0,00</h5>
        </div> -->
      </div>
    </div>
  </section>
  <?php endif; ?>


  <?php 

    $preco_atleta_comum_baixa = floatval(str_replace(",", ".", get_field('preco_atleta_comum_baixa')));
    $preco_atleta_comum_alta = floatval(str_replace(",", ".", get_field('preco_atleta_comum_alta')));
    $preco_atleta_socio_baixa = floatval(str_replace(",", ".", get_field('preco_atleta_socio_baixa')));
    $preco_atleta_socio_alta = floatval(str_replace(",", ".", get_field('preco_atleta_socio_alta')));

    $preco_atleta_comum_baixa_pagamento_clube = floatval(str_replace(",", ".", get_field('preco_atleta_comum_baixa_pagamento_clube')));
    $preco_atleta_comum_alta_pagamento_clube = floatval(str_replace(",", ".", get_field('preco_atleta_comum_alta_pagamento_clube')));
    $preco_atleta_socio_baixa_pagamento_clube = floatval(str_replace(",", ".", get_field('preco_atleta_socio_baixa_pagamento_clube')));
    $preco_atleta_socio_alta_pagamento_clube = floatval(str_replace(",", ".", get_field('preco_atleta_socio_alta_pagamento_clube')));

    $preco_raquete = floatval(str_replace(",", ".",get_field('aluguel_raquete')));
    $preco_bolinhas = floatval(str_replace(",", ".", get_field('bolinhas')));
    $horario_luz = get_field('horario_luz');
    $luz = floatval(str_replace(",", ".", get_field('luz')));

 
    
  ?>


  <?php if (isset($_GET['reservation__types'])): ?>
    <section class="reservation__block reservation__active" id="reservation__types">
      <div class="container">
        <div class="row">
          <div class="col-sm">
            <ul class="steps">
              <li>Selecione os clubes</li>
              <li class="active">Selecione os tipos de jogadores</li>
              <li>Selecione a data</li>
              <li>Selecione os horários</li>
              <li>Selecione os extras</li>
              <li>Realize o pagamento</li>
            </ul>
          </div>
        </div>
        <br>
        <!-- <br><br><br><br><br> -->
        <div class="row">
          <div class="parte1 col-sm col-lg-9" style="padding-right: 25%;">
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
          <div class="parte2 col-lg-3 col-sm" style="border-left: 1px solid black; padding-left: 2%;">  
            <h3><strong style="margin-bottom: 1px;">Resumo da Reserva</strong></h3>
            <p>Clube <?php echo $_GET['clubes'];?></p>
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

    $totalSemSocio = 4 * $preco_atleta_comum_baixa;

    $desconto = $totalSemSocio - $total;
    $totalString = number_format($total, 2);

    $sociosString = number_format(($socios * $preco_atleta_socio_baixa), 2);

    $jogadoresString = number_format( ($jogadores * $preco_atleta_comum_baixa), 2);
  
  ?>

  <?php if (isset($_GET['reservation__dates'])): ?>
  <section class="reservation__block" id="reservation__dates">
    <div class="container">
      <div class="row">
        <div class="col-sm">
          <ul class="steps">
            <li>Selecione os clubes</li>
            <li>Selecione os tipos de jogadores</li>
            <li class="active">Selecione a data</li>
            <li>Selecione os horários</li>
            <li>Selecione os extras</li>
            <li>Realize o pagamento</li>
          </ul>
        </div>
      </div>
      <div class="row" style="padding-top: 3%;">
        <div class="parte1 col-lg-9 col-sm" style="padding-right: 25%;">
          <?php

            $clube_datas_disabled = array();
            $aux = array();
            if( have_rows('clubes_datas_disabled') ):
              // loop through the rows of data
              $i = 0;
              while ( have_rows('clubes_datas_disabled') ) : the_row();
                foreach (get_sub_field('datas') as $key => $data) {
                  array_push($aux, $data['data_disabled']);
                }
                $clube_datas_disabled[get_sub_field('clube_disabled')] = $aux;
        
              endwhile;
            endif;

            $datas_disabled = $clube_datas_disabled[$_GET['clubes']];

            $texto_datas = '';
            if(isset($datas_disabled) && $datas_disabled != null && $datas_disabled != ''){
              foreach ($datas_disabled as $key => $data) {
                if($key == count($datas_disabled) - 1){
                  $texto_datas = $texto_datas . $data; 
                }else{
                  $texto_datas = $texto_datas . $data . ', ';
                }
              }
            }
          
          ?>
          <h2>Selecione a data da reserva</h2>
          <!-- <input data-date-inline-picker="true" onclick="pureJSCalendar.open('dd.MM.yyyy', 20, 30, 1, '2018-5-5', '2019-8-20', 'example', 20);" type="text" id="example"> -->
          <?php if($texto_datas != ''){ ?>
            <strong>O clube não funcionará nos dias: <?php echo $texto_datas; ?></strong>
          <?php } ?>
          <div id="my-calendar" style="margin-bottom: 7%;" data-language="pt" ></div>
          <script>
            var datas_disabled = <?php echo json_encode($datas_disabled); ?>;
            var element = document.getElementById("my-calendar");
            var date2 = '0';
            var newDate;
            // Create the calendar
            var myCalendar = jsCalendar.new({

              // language
              target : element,
              date : new Date(),
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

            myCalendar.min("now");

            function dataAtualFormatada(date){
              var data = date,
                  dia  = data.getDate().toString(),
                  diaF = (dia.length == 1) ? '0'+dia : dia,
                  mes  = (data.getMonth()+1).toString(), 
                  mesF = (mes.length == 1) ? '0'+mes : mes,
                  anoF = data.getFullYear();
              return diaF+"/"+mesF+"/"+anoF;
            }

            function verificaData(date){
              var today = new Date();
              dia  = today.getDate().toString(),
              diaF = (dia.length == 1) ? '0'+dia : dia,
              mes  = (today.getMonth()+1).toString(), 
              mesF = (mes.length == 1) ? '0'+mes : mes,
              anoF = today.getFullYear();

              var today = new Date(anoF, parseInt(mesF) - 1, diaF);
              date_split = date.split("/");
              var expireDate = new Date(date_split[2], parseInt(date_split[1]) - 1, date_split[0]);

              if (today > expireDate) {
                return false;
              }else{
                return true;
              }

            }
            
            jQuery("#my-calendar table").css('box-shadow', '0px');
            // jQuery("#my-calendar table td").removeClass('jsCalendar-current');

            jQuery("#my-calendar table td").click(function(){
              jQuery("#my-calendar table td").removeClass('jsCalendar-current');
              jQuery(this).addClass('jsCalendar-current');
            });
            var permissao = true;
            myCalendar.onDateClick(function(event, date){
                date = dataAtualFormatada(date);
                if(datas_disabled != null){
                  permissao = !datas_disabled.includes(date);
                }
                date2 = date;
                console.log(permissao);
                newDate = date.replace(/\//g, '.');
                
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
              if(permissao){
                if(verificaData(date2)){
                  window.location.href =  window.location.href.split('?')[0]+ '?clubes=' + getUrlParameter('clubes') + '&qtd_quadras=' + getUrlParameter('qtd_quadras') + '&socios=' + getUrlParameter('socios') + '&date=' + newDate + '&reservation__hours=true';
                }else{
                  
                  alert("Data Inválida");
                }
              }else{
                alert("Data inválida");
              }
            });
          </script>
        </div>
        <div class="parte2 col-lg-3 col-sm" style="height: 270%; border-left: 1px solid black; padding-left: 2%;">  
          <h3><strong style="margin-bottom: 1px;">Resumo da Reserva</strong></h3>
          <p style="margin-bottom: 1px;">Clube <?php echo $_GET['clubes'];?></p>
          <?php if($socios > 0){ ?>
          <p style="margin-bottom: 1px;"><?php echo $socios; ?>x desconto sócio: -R$<?php echo $desconto; ?>.00</p>
          <?php }?>
          <h5>Total a Pagar: $<?php echo $totalString; ?></h5>
        </div>
      </div>
    </div>
  </section>
  <?php endif; ?>


  <?php if (isset($_GET['reservation__hours'])): ?>
  <section class="reservation__block" id="reservation__hours">
    <div class="container">
      <div class="row">
        <div class="col-sm">
          <ul class="steps">
            <li>Selecione os clubes</li>
            <li>Selecione os tipos de jogadores</li>
            <li>Selecione a data</li>
            <li class="active">Selecione os horários</li>
            <li>Selecione os extras</li>
            <li>Realize o pagamento</li>
          </ul>
        </div>
      </div>

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
            $data_reserva = str_replace("/", ".", $data_reserva);
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
  
        $clube_escolhido = "Clube " . $_GET['clubes'];
        $qtd_quadras = 0;
        wp_reset_query();
        if( have_rows('clube_quadras') ):
          // loop through the rows of data
          while ( have_rows('clube_quadras') ) : the_row();
              if(get_sub_field('clube_brapadel') == $clube_escolhido){
                $qtd_quadras = get_sub_field('quadras_brapadel');
              }
          endwhile;
        endif;

        $qtd_quadras = $_GET['qtd_quadras'];
        // echo var_dump($quadra_horario);
       
        // echo print_r($quadra_horario);
        for ($i=0; $i < $qtd_quadras; $i++) { 
          if($quadra_horario[($i + 1)] == null){
            $quadra_horario[($i + 1)] = array(0);
          }
        }
        // $quadra_horario[1] = $quadra_horario[""];
        // unset($quadra_horario[""]);
        // echo "heakjhakesj " . var_dump($quadra_horario);
        // echo "aqui " . $quadra_horario[2][1] . " falou";
      ?>

      <div class="row" style="padding-top: 3%;">
        <div class="parte1 col-lg-9 col-sm" style="float: left;">
          <h2>Selecione a Quadra e os Horários</h2>
          <table style="width: 70%; color: black;" class="customers">
            <!-- <colgroup>
              <col style="width: 10%" />
              
            </colgroup> -->
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
        <div class="parte2 col-lg-3 col-sm" style="height: 300%; float: right; border-left: 1px solid black; padding-left: 2%;">  
          <h3><strong style="margin-bottom: 1px;">Resumo da Reserva</strong></h3>
          <p style="margin-bottom: 1px;">Clube <?php echo $_GET['clubes']; ?></p>
          <p>Data: <?php echo str_replace(".", "/", $_GET['date']); ?></p>
          <?php if($socios > 0){ ?>
          <p style="margin-bottom: 1px;"><?php echo $socios; ?>x desconto sócio: -R$<?php echo $desconto; ?>.00</p>
          <?php } ?>
          <h5>Total a Pagar: $<?php echo $totalString; ?></h5>
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
    $qualhorario = '';

    if(isWeekend($date)){
      if($hora_inicial >= 9){
        $horario_alta = true;
        $qualhorario = "(horário alta)";
      }
    }else{
      if($hora_inicial >= 18){
        $horario_alta = true;
        $qualhorario = "(horário alta)";
      }else{
        $horario_alta = false;
        $qualhorario = "(horário baixa)";
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
      $hora_final = $_GET['horario_final'];

      $hora_inicial = explode(":", $hora_inicial);
      $hora_final = explode(":", $hora_final);
      $horario_luz = explode(":", $horario_luz);
      $horario_luz[0] = intval($horario_luz[0]);
      $horario_luz[1] = intval($horario_luz[1]);
      
      $qtd30 = 0;

      if(($hora_final[1] == '30' && $hora_inicial[1] == '00') || ($hora_final[1] == '00' && $hora_inicial[1] == '30')){
        if((((intval($hora_final[0]) - intval($hora_inicial[0])) == 2) && ($hora_inicial[1] == '30')) || (((intval($hora_final[0]) - intval($hora_inicial[0])) == 1) && ($hora_final[1] == '30'))){
          $qtd30 = 3;
        }else{
          $qtd30 = 1;
        }
      }else{
        if((intval($hora_final[0]) - intval($hora_inicial[0])) == 2){
          $qtd30 = 4;
        }else{
          $qtd30 = 2;
        }
      }
      
      if(($hora_inicial[0] == $horario_luz[0] && $hora_inicial[1] == $horario_luz[1]) || ($hora_inicial[0] == $horario_luz[0] && $horario_luz[1] == 0) || ($hora_inicial[0] > $horario_luz[0] && ($hora_inicial[1] == 30 || $hora_inicial[1] == 0))){
        $total = $total + ($qtd30 * $luz);
        $totalClube = $totalClube + ($qtd30 * $luz);
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
      <div class="row">
        <div class="col-sm">
          <ul class="steps">
            <li>Selecione os clubes</li>
            <li>Selecione os tipos de jogadores</li>
            <li>Selecione a data</li>
            <li>Selecione os horários</li>
            <li class="active">Selecione os extras</li>
            <li>Realize o pagamento</li>
          </ul>
        </div>
      </div>
      <div class="row" style="padding-top: 4%;">
        <div class="parte1 col-lg-9 col-sm" style="padding-right: 25%;">
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

       
                var hora_inicial = "00:00";
                var hora_final = "00:00"; 

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
                

                return true;
              }

              

              if(validaHora()){
                window.location.href =  window.location.href.split('?')[0]+ '?clubes=' + getUrlParameter('clubes') + '&socios=' + getUrlParameter('socios') + '&date=' +  getUrlParameter('date') + '&qtd_quadras=' + getUrlParameter('qtd_quadras') + '&quadra=' + getUrlParameter('quadra') + '&horario_inicial=' + getUrlParameter('horario_inicial') + '&horario_final=' + getUrlParameter('horario_final') + '&raquetes=' + jQuery('#raquetes_select').val() + '&bolinhas=' + jQuery('#bolinhas_select').val() + '&reservation__payment=true';
              }else{
                alert("Horário Inválido!");
              }
            });
          </script>
        </div>
        <div class="parte2 col-lg-3 col-sm" style="border-left: 1px solid black; padding-left: 2%;">  
          <h3><strong style="margin-bottom: 1px;">Resumo da Reserva</strong></h3>
            <p style="margin-bottom: 0px;">Clube <?php echo $_GET['clubes']; ?>&nbsp Quadra <?php echo $_GET['quadra']; ?></p>
            <p style="margin-bottom: 0px;">Data: <?php echo str_replace(".", "/", $_GET['date']); ?></p>
            <p style="margin-bottom: 3px;">Entrada: <?php echo str_replace(":", "h", $_GET["horario_inicial"]); ?>&nbsp Saída: <?php echo str_replace(":", "h", $_GET["horario_final"]); ?></p>
            <p style="margin-bottom: -5px;"><?php echo $qtd30; ?>x reserva de 30 minutos<?php echo $qualhorario; ?></p>
            <?php if($socios > 0){ ?>
            <p style="margin-bottom: 10px;"><?php echo $socios; ?>x desconto sócio: -R$<?php echo $desconto; ?>.00</p>
            <?php } ?>
            <?php if($cobrandoLuz){ ?>  
              <p style="margin-bottom: 1px;">Adicional iluminação noturna: R$<?php echo ($qtd30 * $luz); ?>.00</p>
            <?php } ?>  
            
            <h5>Total a Pagar: $<?php echo $totalString; ?></h5>
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
      $totalClube = $totalClube + ($qtd30 * $luz);
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
      <div class="row">
        <div class="col-sm">
          <ul class="steps">
            <li>Selecione os clubes</li>
            <li>Selecione os tipos de jogadores</li>
            <li>Selecione a data</li>
            <li>Selecione os horários</li>
            <li>Selecione os extras</li>
            <li class="active">Realize o pagamento</li>
          </ul>
        </div>
      </div>
      <div class="row" style="padding-top: 4%;">
        <div class="parte1 col-lg-9 col-sm pagamento" style="padding-left: 0px;">
          <div class="row">
            <h2>Pagamento</h2>
          </div>
          <div id="div_pagamentos" class="row">
            <div id="pagar_online" style="margin-right: 20px;text-align: center; padding: 10px 30px 30px 30px; border: 2px solid #179ed6; border-radius: 5px; box-shadow: 3px 3px #1490c3; margin-bottom: 10px;">
              <!-- <label style="font-size: 13px;font-weight: bold;" for="pay_online">Pagar online</label> -->
              <i style="color: #545454;" class="fab fa-paypal fa-2x"></i><br>
              <span>Pagamento<br> Online</span><br>
              <input id="pay_online" name="pay_online" type="checkbox" />
            </div>
            <div id="pagar_clube" style="text-align: center; padding: 10px 30px 30px 30px; border: 2px solid #179ed6; border-radius: 5px; box-shadow: 3px 3px #1490c3; margin-bottom: 10px;">
              <i style="color: #545454;" class="far fa-credit-card fa-2x"></i><br>
              <span>Pagamento<br>no Clube</span><br>
              <input id="pay_atm" name="pay_atm" type="checkbox" />
            </div>
          </div>
          <br>
          <div class="row">
          <a style="margin-bottom: 10px;" class="extras__button before__button pay-before">Voltar</a>
            <script type="text/javascript">
              jQuery('.pay-before').click(function(){
                window.location.href =  window.location.href.split('?')[0]+ '?clubes=' + getUrlParameter('clubes') + '&socios=' + getUrlParameter('socios') + '&qtd_quadras=' + getUrlParameter('qtd_quadras') + '&quadra=' + getUrlParameter('quadra')  + '&date=' +  getUrlParameter('date') + '&horario_inicial=' + getUrlParameter('horario_inicial') + '&horario_final=' + getUrlParameter('horario_final') + '&reservation_extras=true';
              });
            </script>
            <a id="confirmar-reserva" class="extras__button next__button" style="margin-left: 20px; float: left;display:none;">Confirmar reserva</a>
          </div>
            <?php $user_logged =  wp_get_current_user();?> 
             <!-- Declaração do formulário -->
            <form method="post" target="pagseguro" style="display: none;"
            action="<?php echo get_stylesheet_directory_uri() ?>/checkout.php">
                    <?php
                      $_SESSION['codigo'] = ""; 
                    ?>
                    <!-- Campos obrigatórios -->
                    <input name="receiverEmail" type="hidden" value="felipelira1908@hotmail.com">
                    <input name="currency" type="hidden" value="BRL">
                    <input type="hidden" name="clube" value="<?php echo $_GET['clubes']; ?>">
                    <input type="hidden" name="user" value="<?php echo $user_logged->ID; ?>">
                    <input type="hidden" name="socios" value="<?php echo $_GET['socios']; ?>">
                    <input type="hidden" name="horario_inicial" value="<?php echo $_GET['horario_inicial']; ?>">
                    <input type="hidden" name="horario_final" value="<?php echo $_GET['horario_final']; ?>">
                    <input type="hidden" name="data" value="<?php echo $_GET['date']; ?>">
                    <input type="hidden" name="quadra" value="<?php echo $_GET['quadra']; ?>">
                    <input type="hidden" name="raquetes" value="<?php echo $_GET['raquetes']; ?>">
                    <input type="hidden" name="bolinhas" value="<?php echo $_GET['bolinhas']; ?>">
                    <input type="hidden" name="forma_pagamento" value="1">
                    <input type="hidden" name="valor" value="<?php echo $total; ?>">
                    <!-- Itens do pagamento (ao menos um item é obrigatório) -->
                    <input name="itemId1" type="hidden" value="0001">
                    <input name="itemDescription1" type="hidden" value="Reserva de Quadra">
                    <input name="itemAmount1" type="hidden" value="<?php echo $total ?>">
                    <input name="itemQuantity1" type="hidden" value="1">
                    <input name="itemWeight1" type="hidden" value="1000">

                    <!-- Código de referência do pagamento no seu sistema (opcional) -->
                    <input name="reference" type="hidden" value="REF1234">

                    <!-- submit do form (obrigatório) -->
                    <input onclick="window.location = 'http://brapadel-com-br.umbler.net/minhas-reservas';" id="submitpagseguro" alt="Pague com PagSeguro" name="submit"  type="image"
            src="https://p.simg.uol.com.br/out/pagseguro/i/botoes/pagamentos/120x53-pagar.gif"/>

            </form>
        </div>
        <div class="parte2 col-lg3 col-sm resumo_pagamento" style="border-left: 1px solid black; padding-left: 2%;">  
          <h3><strong style="margin-bottom: 1px;">Resumo da Reserva</strong></h3>
          <p style="margin-bottom: 0px;">Clube <?php echo $_GET['clubes']; ?>&nbsp Quadra <?php echo $_GET['quadra']; ?></p>
          <p style="margin-bottom: 0px;">Data: <?php echo str_replace(".", "/", $_GET['date']); ?></p>
          <p style="margin-bottom: 3px;">Entrada: <?php echo str_replace(":", "h", $_GET["horario_inicial"]); ?>&nbsp Saída: <?php echo str_replace(":", "h", $_GET["horario_final"]); ?></p>
          <p style="margin-bottom: -5px;"><?php echo $qtd30; ?>x reserva de 30 minutos<?php echo $qualhorario; ?></p>
          <?php if($socios > 0){ ?>
          <p style="margin-bottom: 10px;"><?php echo $socios; ?>x desconto sócio: -R$<?php echo $desconto; ?>.00</p>
          <?php } ?>
          <?php if($cobrandoLuz){ ?>  
            <p style="margin-bottom: 1px;">Adicional iluminação noturna: R$<?php echo ($qtd30 * $luz); ?>.00</p>
          <?php } ?>
          <?php if($_GET['raquetes'] != '0'){ ?> 
            <p style="margin-bottom: 1px;"><?php echo $_GET['raquetes']; ?>x Aluguel Raquete: R$<?php echo $raqueteString; ?></p>
          <?php } ?> 
          <?php if($_GET['bolinhas'] != '0'){ ?>
            <p style="margin-bottom: 10px;"><?php echo $_GET['bolinhas']; ?>x Bolinhas: R$<?php echo $bolinhasString; ?></p>
          <?php } ?>
          <h5 style="margin-bottom: 1px;">Total a Pagar Online: $<?php echo $totalString; ?></h5>
          <h5>Total a Pagar no Clube: $<?php echo $totalStringClube; ?></h5>
        </div>
      </div>
    </div>
    </div>
      <br><br><br><br><br>
      
    <script type="text/javascript">

      jQuery('#confirmar-reserva').on("click", function(){
          if(true){
            
             
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
                              forma_pagamento : 0,
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
                    window.location.replace(window.location.href.split('?')[0] + "minhas-reservas");
                  });       
                }    
              }else{
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
                            forma_pagamento : 1,
                            valor : <?php echo $total; ?>,
                            bolinhas : 0},
                    success: function(){
                      // alert("sucesso");
                    },
                    error: function(e){
                      alert("error");
                    }
                }).done(function( msg ) {
                  window.location.replace(window.location.href.split('?')[0] + "minhas-reservas");
                }); 
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
    $value = $current_user->ID;
    update_field( $field_key, $value, $post_id );

    $field_key = "valor";
    $value = $_POST['valor'];
    update_field( $field_key, $value, $post_id ); ; 

    $field_key = "forma_de_pagamento";
    $value = $_POST['forma_pagamento'];
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
      <div class="row" style="text-align: center;">
        <div class="col-sm">
          <h2 class="reservation__warning">Você precisa estar logado para realizar a reserva. Clique <a href="../wp-login.php">aqui</a> para entrar.</h2>
        </div>
      </div>
    </div>
  </section>



<?php endif; ?>

<?php get_footer(); ?>