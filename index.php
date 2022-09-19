<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Lista de Pessoas</title>

    <link rel="stylesheet" type="text/css" href="./assets/css/style.css">

</head>

<body>
    <header>
        <button onclick="gravar()">Gravar</button>
        <button onclick="ler()">Ler</button>
        <br>
        <br>
        <form method="POST" id="form_nova_pessoa">
            Nome: <input type="text" name="nome_pessoa" id="nome_pessoa" required />
            <input type="button" onclick="cadastrar_pessoa()" value="Incluir">
        </form>
    </header>
    <section>

        <article>

            <table id="tabela_pessoas" border="0" cellpadding="1" cellspacing="2">
                <thead>
                    <tr nobr="true" class="bg_1">
                        <th colspan="4">Pessoas</th>
                    </tr>
                </thead>
                <tbody id="tbody_pessoas">
                    <tr nobr="true" class="bg_2">
                        <td style="width:70%" colspan="3">Teste</td>
                        <td style="width:30%"><button>Remover</button></td>
                    </tr>
                    <tr nobr="true" class="bg_3">
                        <td style="width:70%" colspan="3">➡&nbsp;Filho1</td>
                        <td style="width:30%"><button>Remover Filho</button></td>
                    </tr>
                    <tr nobr="true" align="center" class="bg_4">
                        <td colspan="4" class="bg_4"><button>Adicionar Filho</button></td>
                    </tr>
                </tbody>

            </table>

        </article>

        <aside>

            <textarea border="1" id="json_txt" cols=50 rows=25 readonly></textarea>

        </aside>

    </section>
    <footer>
    <h4><a href="https://github.com/ClaudioAugustoBT">Claudio Augusto Brassachio Tenreiro</a></h4>
    </footer>

    <!--
==================================================  
Scripts
================================================== 
-->

    <script src="./assets/js/script.js"></script>
</body>

</html>