<html>
    <head>
        <meta charset="UTF-8">
        <title>Jquery</title>
        <link href="https://fonts.googleapis.com/css2?family=Alata&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/css.css" />
    </head>
    <body>
        <div id="loader">
            <p align="center">
                <img src="img/loader.gif" style="width:100px" />
            </p>
        </div>
        
        <div id="conteudo-ajax"></div>
        <div id="formulario">
            <p align="center">
                <img src="img/logodevplay.png" />
            </p>
            <h1>Utilize o formulário abaixo para se cadastrar</h1>
            <form action="#" id="formulario-cadastro">
                <input type="hidden" name="id_linha" id="id_linha" />
                <div class="form-item">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" id="nome" placeholder="Insira o seu nome completo" required />
                    <br style="clear:both" />
                </div>
                <div class="form-item">
                    <label for="nome">CPF</label>
                    <input type="text" name="cpf" id="cpf" placeholder="Insira o seu CPF" required />
                    <br style="clear:both" />
                </div>
                <div class="form-item">
                    <label for="nome">E-mail</label>
                    <input type="email" name="email" id="email" placeholder="Insira o seu e-mail" required />
                    <br style="clear:both" />
                </div>
                <div class="form-item">
                    <label for="nome">Celular</label>
                    <input type="text" name="celular" id="celular" placeholder="Exemplo: (31) 98331-6822" required />
                    <br style="clear:both" />
                </div>
                <div class="form-item">
                    <label for="nome">CEP</label>
                    <input type="text" name="cep" id="cep" class="cep" placeholder="Insira o seu cep" required />
                    <br style="clear:both" />
                </div>
                <div class="form-item endereco">
                    <label for="nome">Endereço</label>
                    <input type="text" name="rua" id="rua" class="rua" placeholder="Insira o seu endereco" />
                    <br style="clear:both" />
                </div>
                <div class="form-item endereco">
                    <label for="nome">Número</label>
                    <input type="text" name="numero" id="numero" placeholder="Número" />
                    <br style="clear:both" />
                </div>
                <div class="form-item endereco">
                    <label for="nome">Complemento</label>
                    <input type="text" name="complemento" id="complemento" class="complemento" placeholder="Complemento" />
                    <br style="clear:both" />
                </div>
                <div class="form-item endereco">
                    <label for="nome">Bairro</label>
                    <input type="text" name="bairro" id="bairro" class="bairro" placeholder="Bairro" />
                    <br style="clear:both" />
                </div>
                <div class="form-item endereco">
                    <label for="nome">Cidade</label>
                    <input type="text" name="cidade" id="cidade" class="cidade" placeholder="Cidade" />
                    <br style="clear:both" />
                </div>
                <div class="form-item endereco">
                    <label for="nome">Estado</label>
                    <input type="text" name="estado" id="estado" class="estado" placeholder="Estado" />
                    <br style="clear:both" />
                </div>
                <div class="form-item">
                    <button type="submit" name="btn-enviar" id="btn-enviar">Prosseguir</button>
                </div>
            </form>
        </div>
        <div id="tabela" style="display: none;">
            <button type="button" id="btn-cadastrar-novo">Cadastrar Novo</button>
            <form id="cadastros" action="processar_dados.php" method="POST" >
                <table>
                    <thead>
                        <tr>
                            <th style="display: none">Dados</th>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>E-mail</th>
                            <th>Celular</th>
                            <th>CEP</th>
                            <th>Rua</th>
                            <th>Número</th>
                            <th>Complemento</th>
                            <th>Bairro</th>
                            <th>Cidade</th>
                            <th>Estado</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody id="conteudo-tabela">
                    </tbody>
                </table>
                <button type="button" name="btn-enviar-cadastros" style="display: none" id="btn-enviar-cadastros">Enviar Cadastros</button>
            </form>
        </div>
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/jQuery-Mask-Plugin-master/dist/jquery.mask.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <script src="js/busca-endereco.js"></script>
        <script type="text/javascript">
        $(document).ready(function(){
                //inserindo mascara nos campos
                $("#cpf").mask("999.999.999-99");
                $("#celular").mask("(99) 99999-9999");

                //trabalhando com o formulario
                var total_registros = 0;
                $("#formulario-cadastro").submit(function(){
                   var id_linha    = $("#id_linha").val();
                   var nome        = $("#nome").val();
                   var cpf         = $("#cpf").val();
                   var email       = $("#email").val();
                   var celular     = $("#celular").val();
                   var cep         = $("#cep").val();
                   var rua         = $("#rua").val();
                   var numero      = $("#numero").val();
                   var complemento = $("#complemento").val();
                   var bairro      = $("#bairro").val();
                   var cidade      = $("#cidade").val();
                   var estado      = $("#estado").val();

                   //verifica se existe id_linha pare remover antes de inserir
                   if(id_linha != ''){
                      $("#linha_"+id_linha).remove();
                   }

                   //monta tr para inserir na tabela
                   var html_tabela = '<tr id="linha_'+total_registros+'">'+
                                        '<td style="display: none">' +
                                            '<input type="hidden" name="cadastros['+total_registros+'][nome]" value="' + nome + '">' +
                                            '<input type="hidden" name="cadastros['+total_registros+'][cpf]" value="' + cpf + '">' +
                                            '<input type="hidden" name="cadastros['+total_registros+'][email]" value="' + email + '">' +
                                            '<input type="hidden" name="cadastros['+total_registros+'][celular]" value="' + celular + '">' +
                                            '<input type="hidden" name="cadastros['+total_registros+'][cep]" value="' + cep + '">' +
                                            '<input type="hidden" name="cadastros['+total_registros+'][rua]" value="' + rua + '">' +
                                            '<input type="hidden" name="cadastros['+total_registros+'][numero]" value="' + numero + '">' +
                                            '<input type="hidden" name="cadastros['+total_registros+'][complemento]" value="' + complemento + '">' +
                                            '<input type="hidden" name="cadastros['+total_registros+'][bairro]" value="' + bairro + '">' +
                                            '<input type="hidden" name="cadastros['+total_registros+'][cidade]" value="' + cidade + '">' +
                                            '<input type="hidden" name="cadastros['+total_registros+'][estado]" value="' + estado + '">' +
                                        '</td>' +
                                        '<td class="nome"> '+nome+' </td>'+
                                        '<td class="cpf"> '+cpf+' </td>'+
                                        '<td class="email"> '+email+' </td>'+
                                        '<td class="celular"> '+celular+' </td>'+
                                        '<td class="cep"> '+cep+' </td>'+
                                        '<td class="rua"> '+rua+' </td>'+
                                        '<td class="numero"> '+numero+' </td>'+
                                        '<td class="complemento"> '+complemento+' </td>'+
                                        '<td class="bairro"> '+bairro+' </td>'+
                                        '<td class="cidade"> '+cidade+' </td>'+
                                        '<td class="estado"> '+estado+' </td>'+
                                        '<td>'+
                                            '<img src="img/edit.png" width="30" class="editar" id="'+total_registros+'" />'+
                                            '<img src="img/remove.png" width="30" class="remover" id="'+total_registros+'" />'+
                                        '</td>'+
                                     '</tr>';

                    $("#conteudo-tabela").append(html_tabela);

                    $("#btn-enviar-cadastros").show();
                    total_registros++;

                    $("#formulario").fadeOut();
                    $("#formulario input").val('');
                    $("#tabela").slideDown();

                   return false;                   
                })

                $("#btn-cadastrar-novo").click(function(){
                    $("#btn-enviar-cadastros").hide();
                    $("#tabela").slideUp();
                    $("#formulario").fadeIn();
                })

                $(document).on('click', '.editar', function(){
                    //id da linha
                    var id = $(this).attr('id');

                    //insere campos
                    $("#nome").val($("#linha_"+id).find('.nome').html());
                    $("#cpf").val($("#linha_"+id).find('.cpf').html());
                    $("#email").val($("#linha_"+id).find('.email').html());
                    $("#celular").val($("#linha_"+id).find('.celular').html());
                    $("#cep").val($("#linha_"+id).find('.cep').html());
                    $("#rua").val($("#linha_"+id).find('.rua').html());
                    $("#numero").val($("#linha_"+id).find('.numero').html());
                    $("#complemento").val($("#linha_"+id).find('.complemento').html());
                    $("#bairro").val($("#linha_"+id).find('.bairro').html());
                    $("#cidade").val($("#linha_"+id).find('.cidade').html());
                    $("#estado").val($("#linha_"+id).find('.estado').html());

                    $("#id_linha").val(id);
                    $("#tabela").slideUp();
                    $("#formulario").fadeIn();
                })

                $(document).on('click', '.remover', function(){
                    //id da linha
                    var id = $(this).attr('id');

                    Swal.fire({
                        title: 'Espere!',
                        text: "Tem certeza que deseja remover este registro?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sim, quero apagar!',
                        cancelButtonText: 'Cancelar',
                    }).then((result) => {
                        if (result.value) {
                            $("#linha_"+id).fadeOut();
                            $("#linha_"+id).remove();
                        }
                    })
                })
                

                $("#btn-enviar-cadastros").click(function(){
                    var linhas_corpo_tabela = $("#conteudo-tabela tr").length

                    if(linhas_corpo_tabela > 0){
                        $("#cadastros").submit();
                    } else {
                        Swal.fire({
                            title: 'Opa!',
                            text: "Não tem nenhum registro para ser enviado!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Sim, quero apagar!',
                            cancelButtonText: 'Cancelar',
                        })
                    }
                })

                function validarCPF(cpf) {
                    cpf = cpf.replace(/[^\d]+/g,'');	
                    if(cpf == '') return false;	

                    // Elimina CPFs invalidos conhecidos	
                    if (cpf.length != 11 || 
                        cpf == "00000000000" || 
                        cpf == "11111111111" || 
                        cpf == "22222222222" || 
                        cpf == "33333333333" || 
                        cpf == "44444444444" || 
                        cpf == "55555555555" || 
                        cpf == "66666666666" || 
                        cpf == "77777777777" || 
                        cpf == "88888888888" || 
                        cpf == "99999999999")
                            return false;		

                    // Valida 1o digito	
                    add = 0;	
                    for (i=0; i < 9; i ++)		
                        add += parseInt(cpf.charAt(i)) * (10 - i);	
                        rev = 11 - (add % 11);	
                        if (rev == 10 || rev == 11)		
                            rev = 0;	
                        if (rev != parseInt(cpf.charAt(9)))		
                            return false;		

                    // Valida 2o digito	
                    add = 0;	
                    for (i = 0; i < 10; i ++)		
                        add += parseInt(cpf.charAt(i)) * (11 - i);	
                    rev = 11 - (add % 11);	
                    if (rev == 10 || rev == 11)	
                        rev = 0;	
                    if (rev != parseInt(cpf.charAt(10)))
                        return false;		

                    return true;   
                }

                $("#cpf").blur(function(){

                    var cpf = $(this).val();
                    
                    if(cpf && !validarCPF(cpf)){
                        Swal.fire({
                            title: 'Ops!',
                            text: "CPF Inválido",
                            icon: 'error',
                            showCancelButton: false
                        });
                    }
                    
                })

            })
        </script>
    </body>
</html>