<?php
session_start();
class DB
{

    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "db_imoveis";
    // private $servername = "localhost";
    // private $username = "u258163094_db_user";
    // private $password = "Joao1@2@3@";
    // private $database = "u258163094_db_imoveis";
    private $conn;


    public function __construct()
    {
        try {
            //code...
            $dsn = "mysql:host=" . $this->servername . ";dbname=" . $this->database;
            $this->conn = new PDO($dsn, $this->username, $this->password);
        } catch (PDOException $e) {
            echo "Conexão falhada: " . $e->getMessage();
        }
    }

    // método para retornar a conexão
    public function getConnection()
    {
        return $this->conn;
    }

    public function getUser($email)
    {
        $sql = "SELECT * FROM perfil WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
        // var_dump($data);
    }

    public function getEmail($email, $senha)
    {
        $sql = "SELECT email, password FROM perfil WHERE email = :email AND password = :senha";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email, 'senha' => $senha]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
        // var_dump($data);
    }

    // selecionar bairros
    public function getBairros()
    {
        $sql = "SELECT * FROM bairros ORDER BY nome ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    function generateBairroOptions()
    {
        $bairros = $this->getBairros();

        $selectOptions = '';

        foreach ($bairros as $bairro) {
            $value = $bairro['id'];
            $text = $bairro['nome'];

            $selected = '';
            if (isset($_GET['bairro']) && $_GET['bairro'] == $value) {
                $selected = 'selected';
            }

            $selectOptions .= "<option value='$value' $selected>$text</option>";
        }

        return $selectOptions;
    }


    public function getEmailExist($email, )
    {
        $sql = "SELECT email FROM perfil WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
        // var_dump($data);
    }


    public function insertData($name, $email, $password, $payment = "free")
    {
        $sql = "INSERT INTO perfil (nome_user,email,password, payment) VALUES (:name, :email, :password, :payment)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['name' => $name, 'email' => $email, 'password' => $password, 'payment' => $payment]);
        echo "Inserido";
    }

    // **********************************************************
    // UPLOAD IMAGENS
    // **********************************************************
    function uploadImagens($id_imovel, $upload_path, $files)
    {

        // informações das imagens
        $allowed_types = array('jpg', 'jpeg', 'png');

        // inserir as informações das imagens no banco de dados
        foreach ($files['name'] as $key => $value) {

            $file_name = $files['name'][$key];
            $file_tmp = $files['tmp_name'][$key];
            $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));


            // verificar se o tipo de arquivo é permitido
            if (in_array($file_type, $allowed_types)) {

                // gerar um nome único para o arquivo
                $new_file_name = uniqid() . '.' . $file_type;

                // conteúdo da imagem
                // $image = imagecreatefromstring(file_get_contents($upload_path . $new_file_name));

                // var_dump($image);

                // $info = pathinfo($upload_path);
                // echo '<pre>';
                // print_r($info);
                // echo '</pre>';


                // fazer upload do arquivo
                move_uploaded_file($file_tmp, $upload_path . $new_file_name);


                $image = imagecreatefromstring(file_get_contents($upload_path . $new_file_name));

                // obter as dimensões da imagem
                $width = imagesx($image);
                $height = imagesy($image);

                // calcular novas dimensões
                $new_width = 500;
                $new_height = 500;

                if ($width > $height) {
                    // imagem horizontal
                    $new_height = ($height / $width) * $new_width;
                } else {
                    // imagem vertical
                    $new_width = ($width / $height) * $new_height;
                }

                // redimensionar a imagem
                $resized_image = imagecreatetruecolor($new_width, $new_height);
                imagecopyresampled($resized_image, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

                //  imagem
                imagejpeg($resized_image, $upload_path . $new_file_name, 70);

                echo "<img src=" . $upload_path . $new_file_name . ">";
                echo "<hr>";



                // inserir informações da imagem no banco de dados
                $sql = "INSERT INTO imagem (id_imovel, url, nome, incluida_em) VALUES (?, ?, ?, NOW())";

                // preparar a consulta SQL
                $stmt = $this->conn->prepare($sql);

                // executar a consulta SQL
                $stmt->execute([$id_imovel, $upload_path . $new_file_name, $file_name]);
            } else {
                echo "Uma imagem ultrapassa o tamanho máximo permitido!";
            }
        }
    }



    // *************************************************************************
    // Query para obter o último ID inserido na tabela
    public function ultimoImovelId()
    {
        $query = "SELECT MAX(id_imovel) as ultimo_id FROM imovel";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        // Obtém o último ID inserido na tabela
        $ultimo_id = $resultado['ultimo_id'];
        // return $ultimo_id;

        // Verifica se o último ID é nulo, caso seja, define o valor inicial como 1, caso contrário, incrementa o valor em 1
        if ($ultimo_id === null) {
            $codigo = 1;
        } else {
            $codigo = $ultimo_id + 1;
        }

        return $codigo;
    }
    // *************************************************************************
    // *************************************************************************
    // Query para obter o último ID inserido na tabela
    public function ultimoImovel()
    {
        $query = "SELECT MAX(cod_imovel) as ultimo_id FROM imovel";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        // Obtém o último ID inserido na tabela
        $ultimo_id = $resultado['ultimo_id'];
        // return $ultimo_id;

        // Verifica se o último ID é nulo, caso seja, define o valor inicial como 1, caso contrário, incrementa o valor em 1
        if ($ultimo_id === null) {
            $codigo = 20230001;
        } else {
            $codigo = $ultimo_id + 1;
        }

        return $codigo;
    }
    // *************************************************************************

    public function insertImovel($id, $cod_imovel, $titulo, $id_bairro, $id_proprietario, $valor, $valor_condominio, $iptu, $area_construida, $quartos, $banheiros, $garagem, $cozinha, $sala, $garden, $sacada, $lavanderia, $suite, $elevador, $area_lazer, $descricao, $views, $status, $data_criacao, $data_atualizacao)
    {
        $sql = "INSERT INTO imovel (id_imovel,cod_imovel, titulo, id_bairro, id_proprietario, valor, valor_condominio, iptu, area_construida, quartos, banheiros, garagem, cozinha, sala, garden, sacada, lavanderia, suite, elevador, area_lazer, descricao, views, status, data_criacao, data_atualizacao)
                            VALUES (:id,:cod_imovel, :titulo, :id_bairro, :id_proprietario, :valor, :valor_condominio, :iptu, :area_construida, :quartos, :banheiros, :garagem, :cozinha, :sala, :garden, :sacada, :lavanderia, :suite, :elevador, :area_lazer, :descricao,   :views, :status, :data_criacao, :data_atualizacao)";
        $stmt = $this->conn->prepare($sql);
        $inserido = $stmt->execute([

            'id' => $id,
            'cod_imovel' => $cod_imovel,
            'titulo' => $titulo,
            'id_bairro' => $id_bairro,
            'id_proprietario' => $id_proprietario,
            'valor' => $valor,
            'valor_condominio' => $valor_condominio,
            'iptu' => $iptu,
            'area_construida' => $area_construida,
            'quartos' => $quartos,
            'banheiros' => $banheiros,
            'garagem' => $garagem,
            'cozinha' => $cozinha,
            'sala' => $sala,
            'garden' => $garden,
            'sacada' => $sacada,
            'lavanderia' => $lavanderia,
            'suite' => $suite,
            'elevador' => $elevador,
            'area_lazer' => $area_lazer,
            'descricao' => $descricao,
            'views' => $views,
            'status' => $status,
            'data_criacao' => $data_criacao,
            'data_atualizacao' => $data_atualizacao
        ]);

        if ($inserido) {
            echo "inserido no banco";
        } else {
            echo "erro ao inserir";
        }
    }

    // ************************************************************
    // ******************UPLOAD DE IMAGEM**************************
    // ************************************************************


    // select imóveis


    // paginação
    function paginationLinks($total, $page, $perPage, $url)
    {
        $pagesToShow = 3; // número máximo de páginas a serem exibidas para cada lado da página atual
        $last = ceil($total / $perPage); // número total de páginas
        $start = max(min($page - $pagesToShow, $last - 2 * $pagesToShow), 1); // número da primeira página a ser exibida
        $end = min(max($page + $pagesToShow - $last + 2 * $pagesToShow, 2 * $pagesToShow + 1), $last); // número da última página a ser exibida

        $html = '<div class="pagination">';
        if ($page > 1) {
            $html .= '<a href="' . $url . '&page=' . ($page - 1) . '">&laquo; Anterior</a>';
        }
        if ($start > 1) {
            $html .= '<a href="' . $url . '&page=1">1</a>';
            if ($start > 2) {
                $html .= '<span class="ellipsis">...</span>';
            }
        }
        for ($i = $start; $i <= $end; $i++) {
            if ($i == $page) {
                $html .= '<span class="current">' . $i . '</span>';
            } else {
                $html .= '<a href="' . $url . '&page=' . $i . '">' . $i . '</a>';
            }
        }
        if ($end < $last) {
            if ($end < $last - 1) {
                $html .= '<span class="ellipsis">...</span>';
            }
            $html .= '<a href="' . $url . '&page=' . $last . '">' . $last . '</a>';
        }
        if ($page < $last) {
            $html .= '<a href="' . $url . '&page=' . ($page + 1) . '">Próxima &raquo;</a>';
        }
        $html .= '</div>';
        return $html;
    }

    // select imagens por email

    public function getImageByIdImovel($idImovel)
    {
        $sql = "SELECT * FROM imagem WHERE id_imovel = :id_imovel";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id_imovel' => $idImovel]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
        // var_dump($data);
    }

    // listar imóveis

    function listarImoveisComImagens($pagina = 1, $registros_por_pagina = 10)
    {


        $sql = "SELECT imovel.*, imagem.*, MIN(imagem.id) AS id_imagem
            FROM imovel
            INNER JOIN imagem ON imovel.id_imovel = imagem.id_imovel
            GROUP BY imovel.id_imovel
            ORDER BY imovel.id_imovel DESC
            LIMIT ?, ?
    ";


        $stmt = $this->conn->prepare($sql);

        // definindo os parâmetros para paginação
        $inicio = ($pagina - 1) * $registros_por_pagina;

        // executando a consulta com os parâmetros
        $stmt->bindParam(1, $inicio, PDO::PARAM_INT);
        $stmt->bindParam(2, $registros_por_pagina, PDO::PARAM_INT);
        $stmt->execute();

        // percorrendo os resultados e retornando como array associativo
        $resultados = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $resultados[] = $row;
        }

        // fechando a conexão com o banco de dados
        $stmt->closeCursor();
        // $db = null;

        // retornando os resultados
        return $resultados;
    }

    public function pagImoImg($pagina = 1, $registros_por_pagina = 10, $bairro = null, $valor = null, $quarto = null)
    {
        # code...
        //     // Prepara a query SQL para contar o total de registros com os filtros aplicados
        //     $sql_total = "SELECT COUNT(DISTINCT imovel.id_imovel) AS total_registros
        //   FROM imovel
        //   INNER JOIN imagem ON imovel.id_imovel = imagem.id_imovel
        //   WHERE 1";


        //     // Prepara a query SQL para recuperar os registros da página atual com os filtros aplicados
        //     $sql = "SELECT imovel.*, imagem.*, MIN(imagem.id) AS id_imagem
        //         FROM imovel
        //         INNER JOIN imagem ON imovel.id_imovel = imagem.id_imovel
        //         WHERE 1";

        // Prepara a query SQL para contar o total de registros com os filtros aplicados
        $sql_total = "SELECT COUNT(DISTINCT imovel.id_imovel) AS total_registros
FROM imovel
INNER JOIN imagem ON imovel.id_imovel = imagem.id_imovel
WHERE imovel.status = 1";

        // Prepara a query SQL para recuperar os registros da página atual com os filtros aplicados
        $sql = "SELECT imovel.*, imagem.*, MIN(imagem.id) AS id_imagem
FROM imovel
INNER JOIN imagem ON imovel.id_imovel = imagem.id_imovel
WHERE imovel.status = 1";

        // Adiciona as condições de busca se os filtros não forem nulos
        if ($bairro !== null) {
            $sql_total .= " AND imovel.id_bairro = :bairro";
            $sql .= " AND imovel.id_bairro = :bairro";
        }

        if ($valor !== null) {
            // Separa o valor em faixa inicial e faixa final
            list($faixa_inicial, $faixa_final) = explode("-", $valor);

            // Adiciona as condições de busca para a faixa de valores
            $sql_total .= " AND imovel.valor >= :faixa_inicial AND imovel.valor <= :faixa_final";
            $sql .= " AND imovel.valor >= :faixa_inicial AND imovel.valor <= :faixa_final";
        }

        if ($quarto !== null) {
            $sql_total .= " AND imovel.quartos = :quartos";
            $sql .= " AND imovel.quartos = :quartos";
        }

        // Calcula o offset para a página atual
        $offset = ($pagina - 1) * $registros_por_pagina;

        // Prepara e executa a query SQL para contar o total de registros com os filtros aplicados
        $stmt_total = $this->conn->prepare($sql_total);
        if ($bairro !== null) {
            $stmt_total->bindValue(':bairro', $bairro);
        }
        if ($valor !== null) {
            $stmt_total->bindValue(':faixa_inicial', $faixa_inicial);
            $stmt_total->bindValue(':faixa_final', $faixa_final);
        }
        if ($quarto !== null) {
            $stmt_total->bindValue(':quartos', $quarto);
        }
        $stmt_total->execute();
        $total_registros = $stmt_total->fetch(PDO::FETCH_ASSOC)['total_registros'];

        // Calcula o número de páginas
        $total_paginas = ceil($total_registros / $registros_por_pagina);

        // Verifica se a página atual está dentro do intervalo permitido
        $pagina = max(min($pagina, $total_paginas), 1);

        // Adiciona a cláusula LIMIT à query SQL
        $sql .= " GROUP BY imovel.id_imovel
            ORDER BY imovel.id_imovel DESC
            LIMIT :offset, :registros_por_pagina";

        // Prepara e executa a query SQL para recuperar os registros
        // Prepara e executa a query SQL para recuperar os registros da página atual com os filtros aplicados
        $stmt = $this->conn->prepare($sql);
        if ($bairro !== null) {
            $stmt->bindValue(':bairro', $bairro);
        }
        if ($valor !== null) {
            $stmt->bindValue(':faixa_inicial', $faixa_inicial);
            $stmt->bindValue(':faixa_final', $faixa_final);
        }
        if ($quarto !== null) {
            $stmt->bindValue(':quartos', $quarto);
        }
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':registros_por_pagina', $registros_por_pagina, PDO::PARAM_INT);
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Cria a lista de links de paginação
        $links_paginacao = '';
        $max_links = 3;
        $pagina_inicial = max(1, $pagina - $max_links);
        $pagina_final = min($pagina + $max_links, $total_paginas);

        for ($i = $pagina_inicial; $i <= $pagina_final; $i++) {
            $filtro_link = "";
            if ($bairro !== null) {
                $filtro_link .= "&bairro=" . urlencode($bairro);
            }
            if ($valor !== null) {
                $filtro_link .= "&valor=" . urlencode($valor);
            }
            if ($quarto !== null) {
                $filtro_link .= "&quarto=" . urlencode($quarto);
            }

            if ($i == $pagina) {
                $links_paginacao .= "<a class='pagina-atual active' href='?apartamentos=$i$filtro_link'>$i</a>";
            } else {
                $links_paginacao .= "<a class='pagina-atual' href='?apartamentos=$i$filtro_link'>$i</a>";
            }
        }

        // echo "<pre>";
        // print_r($total_registros);
        // echo "<br>";
        // print_r($resultados);
        // echo "<br>";
        // print_r($links_paginacao);
        // echo "</pre>";


        // Retorna os resultados e a lista de links de paginação
        return array(
            'resultados' => $resultados,
            'links_paginacao' => $links_paginacao,
            'registro' => $total_registros
        );
    }

    function paginarImoveisComImagens($pagina = 1, $registros_por_pagina = 10)
    {

        // Prepara a query SQL para contar o total de registros
        $sql_total = "SELECT COUNT(DISTINCT imovel.id_imovel) AS total_registros
        FROM imovel
        INNER JOIN imagem ON imovel.id_imovel = imagem.id_imovel";


        // Prepara a query SQL para recuperar os registros da página atual
        $sql = "SELECT imovel.*, imagem.*, MIN(imagem.id) AS id_imagem
            FROM imovel
            INNER JOIN imagem ON imovel.id_imovel = imagem.id_imovel
            GROUP BY imovel.id_imovel
            ORDER BY imovel.id_imovel DESC
            LIMIT :offset, :registros_por_pagina";


        // Calcula o offset para a página atual
        $offset = ($pagina - 1) * $registros_por_pagina;



        // Prepara e executa a query SQL para contar o total de registros
        $stmt_total = $this->conn->prepare($sql_total);
        $stmt_total->execute();
        $total_registros = $stmt_total->fetch(PDO::FETCH_ASSOC)['total_registros'];

        // var_dump($total_registros);

        // Calcula o número de páginas
        $total_paginas = ceil($total_registros / $registros_por_pagina);

        // var_dump($total_paginas);

        // Verifica se a página atual está dentro do intervalo permitido
        $pagina = max(min($pagina, $total_paginas), 1);

        // var_dump($pagina);

        // Prepara e executa a query SQL para recuperar os registros da página atual
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':registros_por_pagina', $registros_por_pagina, PDO::PARAM_INT);
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // var_dump($resultados);

        // Cria a lista de links de paginação
        $links_paginacao = '';
        $max_links = 2;
        for ($i = max(1, $pagina - $max_links); $i <= min($pagina + $max_links, $total_paginas); $i++) {

            // Verifica se $i é igual a $pagina e adiciona a classe "active" ao link atual
            $active_class = ($i == $pagina) ? 'active' : '';

            $links_paginacao .= '<a class="page-link ' . $active_class . '" href="?apartamentos=' . $i . '">' . $i . '</a>';
        }

        // adiciona o parâmetro de página na URL dos links de paginação
        $url = $_SERVER['PHP_SELF'] . '?' . http_build_query($_GET);
        $url .= '&apartamentos=';


        // Retorna um array associativo contendo os resultados da página atual e a lista de links de paginação
        return array(
            'resultados' => $resultados,
            'registros' => $total_registros,
            'links_paginacao' => $links_paginacao
        );
    }






    // search
    function buscarImoveisComFiltros($bairro = null, $valor = null, $quartos = null, $pagina = 1, $registros_por_pagina = 10)
    {
        // Prepara a query SQL para contar o total de registros com os filtros aplicados
        $sql_total = "SELECT COUNT(DISTINCT imovel.id_imovel) AS total_registros
            FROM imovel
            INNER JOIN imagem ON imovel.id_imovel = imagem.id_imovel
            WHERE 1";

        // Prepara a query SQL para recuperar os registros da página atual com os filtros aplicados
        $sql = "SELECT imovel.*, imagem.*, MIN(imagem.id) AS id_imagem
            FROM imovel
            INNER JOIN imagem ON imovel.id_imovel = imagem.id_imovel
            WHERE 1";

        // Adiciona as condições de busca se os filtros não forem nulos
        if ($bairro !== null) {
            $sql_total .= " AND imovel.id_bairro = :bairro";
            $sql .= " AND imovel.id_bairro = :bairro";
        }

        if ($valor !== null) {
            // Separa o valor em faixa inicial e faixa final
            list($faixa_inicial, $faixa_final) = explode("-", $valor);

            // Adiciona as condições de busca para a faixa de valores
            $sql_total .= " AND imovel.valor >= :faixa_inicial AND imovel.valor <= :faixa_final";
            $sql .= " AND imovel.valor >= :faixa_inicial AND imovel.valor <= :faixa_final";
        }

        if ($quartos !== null) {
            $sql_total .= " AND imovel.quartos >= :quartos";
            $sql .= " AND imovel.quartos >= :quartos";
        }

        // Calcula o offset para a página atual
        $offset = ($pagina - 1) * $registros_por_pagina;

        // Prepara e executa a query SQL para contar o total de registros com os filtros aplicados
        $stmt_total = $this->conn->prepare($sql_total);
        if ($bairro !== null) {
            $stmt_total->bindValue(':bairro', $bairro);
        }
        if ($valor !== null) {
            $stmt_total->bindValue(':faixa_inicial', $faixa_inicial);
            $stmt_total->bindValue(':faixa_final', $faixa_final);
        }
        if ($quartos !== null) {
            $stmt_total->bindValue(':quartos', $quartos);
        }
        $stmt_total->execute();
        $total_registros = $stmt_total->fetch(PDO::FETCH_ASSOC)['total_registros'];

        // Calcula o número de páginas
        $total_paginas = ceil($total_registros / $registros_por_pagina);

        // Verifica se a página atual está dentro do intervalo permitido
        $pagina = max(min($pagina, $total_paginas), 1);

        // Adiciona a cláusula LIMIT à query SQL
        $sql .= " GROUP BY imovel.id_imovel
            ORDER BY imovel.id_imovel DESC
            LIMIT :offset, :registros_por_pagina";

        // Prepara e executa a query SQL para recuperar os registros
        // Prepara e executa a query SQL para recuperar os registros da página atual com os filtros aplicados
        $stmt = $this->conn->prepare($sql);
        if ($bairro !== null) {
            $stmt->bindValue(':bairro', $bairro);
        }
        if ($valor !== null) {
            $stmt->bindValue(':faixa_inicial', $faixa_inicial);
            $stmt->bindValue(':faixa_final', $faixa_final);
        }
        if ($quartos !== null) {
            $stmt->bindValue(':quartos', $quartos);
        }
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':registros_por_pagina', $registros_por_pagina, PDO::PARAM_INT);
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);


        // Cria a lista de links de paginação
        $links_paginacao = '';
        $max_links = 3;
        $pagina_inicial = max(1, $pagina - $max_links);
        $pagina_final = min($pagina + $max_links, $total_paginas);

        for ($i = $pagina_inicial; $i <= $pagina_final; $i++) {
            $filtro_link = "";
            if ($bairro !== null) {
                $filtro_link .= "&bairro=" . urlencode($bairro);
            }
            if ($valor !== null) {
                $filtro_link .= "&valor=" . urlencode($valor);
            }
            if ($quartos !== null) {
                $filtro_link .= "&quarto=" . urlencode($quartos);
            }

            if ($i == $pagina) {
                $links_paginacao .= "<a class='pagina-atual active' href='?apartamentos=$i$filtro_link'>$i</a>";
            } else {
                $links_paginacao .= "<a class='pagina-atual' href='?apartamentos=$i$filtro_link'>$i</a>";
            }
        }


        // Retorna os resultados e a lista de links de paginação
        return array(
            'resultados' => $resultados,
            'links_paginacao' => $links_paginacao,
            'registro' => $total_registros
        );
    }


    public function criar_url_amigavel($url, $titulo, $codigo)
    {
        // Remove espaços e caracteres especiais do título

        $normalizeChars = array(
            'Š' => 'S',
            'š' => 's',
            'Ð' => 'Dj',
            'Ž' => 'Z',
            'ž' => 'z',
            'À' => 'A',
            'Á' => 'A',
            'Â' => 'A',
            'Ã' => 'A',
            'Ä' => 'A',
            'Å' => 'A',
            'Æ' => 'A',
            'Ç' => 'C',
            'È' => 'E',
            'É' => 'E',
            'Ê' => 'E',
            'Ë' => 'E',
            'Ì' => 'I',
            'Í' => 'I',
            'Î' => 'I',
            'Ï' => 'I',
            'Ñ' => 'N',
            'Ń' => 'N',
            'Ò' => 'O',
            'Ó' => 'O',
            'Ô' => 'O',
            'Õ' => 'O',
            'Ö' => 'O',
            'Ø' => 'O',
            'Ù' => 'U',
            'Ú' => 'U',
            'Û' => 'U',
            'Ü' => 'U',
            'Ý' => 'Y',
            'Þ' => 'B',
            'ß' => 'Ss',
            'à' => 'a',
            'á' => 'a',
            'â' => 'a',
            'ã' => 'a',
            'ä' => 'a',
            'å' => 'a',
            'æ' => 'a',
            'ç' => 'c',
            'è' => 'e',
            'é' => 'e',
            'ê' => 'e',
            'ë' => 'e',
            'ì' => 'i',
            'í' => 'i',
            'î' => 'i',
            'ï' => 'i',
            'ð' => 'o',
            'ñ' => 'n',
            'ń' => 'n',
            'ò' => 'o',
            'ó' => 'o',
            'ô' => 'o',
            'õ' => 'o',
            'ö' => 'o',
            'ø' => 'o',
            'ù' => 'u',
            'ú' => 'u',
            'û' => 'u',
            'ü' => 'u',
            'ý' => 'y',
            'ý' => 'y',
            'þ' => 'b',
            'ÿ' => 'y',
            'ƒ' => 'f',
            'ă' => 'a',
            'î' => 'i',
            'â' => 'a',
            'ș' => 's',
            'ț' => 't',
            'Ă' => 'A',
            'Î' => 'I',
            'Â' => 'A',
            'Ș' => 'S',
            'Ț' => 'T',
        );

        //Output: E A I A I A I A I C O E O E O E O O e U e U i U i U o Y o a u a y c
        $titulo = strtr($titulo, $normalizeChars);
        $titulo_sem_espacos = preg_replace('/[^a-zA-Z0-9]/', '-', $titulo);

        // $titulo_sem_espacos = preg_replace('/[^a-zA-Z0-9]/', '-', iconv('UTF-8', 'ASCII//TRANSLIT', $titulo));


        // Remove a última barra se houver
        $url_sem_barra = rtrim($url, '/');

        // Cria a nova URL amigável
        $nova_url = "{$url_sem_barra}/{$titulo_sem_espacos}-{$codigo}";

        // Retorna a nova URL
        return $nova_url;
    }

    function buscarImovel($cod_imovel)
    {
        try {
            // Prepara a consulta SQL para buscar os dados do imóvel, suas imagens relacionadas e perfil do proprietário
            $stmt = $this->conn->prepare("
                SELECT imovel.*, perfil.*, bairros.*
                FROM imovel
                
                JOIN perfil ON perfil.id = imovel.id_proprietario
                JOIN bairros ON bairros.id = imovel.id_bairro
                WHERE imovel.cod_imovel = :cod_imovel
            ");
            $stmt->bindParam(':cod_imovel', $cod_imovel);
            $stmt->execute();

            // Verifica se algum resultado foi retornado
            if ($stmt->rowCount() > 0) {
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // Retorna os dados encontrados
                return $results;
            } else {
                // Retorna um array vazio se nenhum resultado foi encontrado
                return array();
            }
        } catch (PDOException $e) {
            // Trate qualquer exceção ou erro de banco de dados aqui
            // Por exemplo, você pode exibir uma mensagem de erro ou registrar o erro em um arquivo de log
            return array();
        }
    }

    function buscarImovel1($cod_imovel)
    {
        try {
            // Prepara a consulta SQL para buscar os dados do imóvel, suas imagens relacionadas, perfil do proprietário e bairro
            $stmt = $this->conn->prepare("
                SELECT imovel.*, imagem.*, perfil.*, bairros.*
                FROM imovel
                JOIN imagem ON imagem.id_imovel = imovel.id
                JOIN perfil ON perfil.id = imovel.id_proprietario
                JOIN bairros ON bairros.id = imovel.id_bairro
                WHERE imovel.cod_imovel = :cod_imovel
            ");
            $stmt->bindParam(':cod_imovel', $cod_imovel);
            $stmt->execute();

            // Verifica se algum resultado foi retornado
            if ($stmt->rowCount() > 0) {
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // Retorna os dados encontrados
                return $results;
            } else {
                // Retorna um array vazio se nenhum resultado foi encontrado
                return array();
            }
        } catch (PDOException $e) {
            // Trate qualquer exceção ou erro de banco de dados aqui
            // Por exemplo, você pode exibir uma mensagem de erro ou registrar o erro em um arquivo de log
            return array();
        }
    }

    // busca de faixa de preço

    public function faixaValor()
    {
        # code...
        $sql = "SELECT * FROM faixavalor";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function generateSelectOptions()
    {
        $results = $this->faixaValor();

        $selectOptions = '';

        foreach ($results as $row) {
            $value = $row['faixa_preco'];
            $text = $row['faixa_desc'];

            $selected = '';
            if (isset($_GET['valor']) && $_GET['valor'] == $value) {
                $selected = 'selected';
            }

            $selectOptions .= "<option value='$value' $selected>$text</option>";
        }

        return $selectOptions;
    }

    function generateQuartoOptions()
    {
        $min = 1; // Valor mínimo
        $max = 5; // Valor máximo

        $selectOptions = '';

        for ($i = $min; $i <= $max; $i++) {
            $selected = '';
            if (isset($_GET['quarto']) && $_GET['quarto'] == $i) {
                $selected = 'selected';
            }

            $selectOptions .= "<option value='$i' $selected>$i Quartos</option>";
        }

        return $selectOptions;
    }


    // aqui é editar perfil

    public function saveUserData(
        $nome_user,
        $imob_autonomo,
        $whatsapp,
        $email,

        $descricao_user = null,
        $fb = null,
        $ig = null,
        $linkedin = null,
        $site = null,
        $creci = null,
        $access_type = "user",
        
    ) {
        // Verificar se o usuário já existe no banco de dados
        $userExists = $this->checkUserExists($email);

        if ($userExists) {
            // Executar a atualização dos campos existentes
            $this->updateUser(
                $nome_user,
                $imob_autonomo,
                $whatsapp,
                $email,

                $descricao_user,
                $fb,
                $ig,
                $linkedin,
                $site,
                $creci,
                $access_type,
               
            );
        } else {
            // Executar a inserção dos campos
            $this->insertUser(
                $nome_user,
                $imob_autonomo,
                $whatsapp,
                $email,

                $descricao_user,
                $fb,
                $ig,
                $linkedin,
                $site,
                $creci,
                $access_type,
                
            );
        }
    }

    private function checkUserExists($email)
    {
        $query = "SELECT COUNT(*) FROM perfil WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        return $count > 0;
    }

    private function insertUser(
        $nome_user,
        $imob_autonomo,
        $whatsapp,
        $email,


        $descricao_user,
        $fb,
        $ig,
        $linkedin,
        $site,
        $creci,
        $access_type,
        
    ) {
        $query = "INSERT INTO perfil (nome_user, imob_autonomo, whatsapp, email, 
                  descricao_user, fb, ig, linkedin, site, creci, access_type)
                  VALUES (:nome_user, :imob_autonomo, :whatsapp, :email, 
                  :descricao_user, :fb, :ig, :linkedin, :site, :creci, :access_type)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nome_user', $nome_user);
        $stmt->bindParam(':imob_autonomo', $imob_autonomo);
        $stmt->bindParam(':whatsapp', $whatsapp);
        $stmt->bindParam(':email', $email);

        $stmt->bindParam(':descricao_user', $descricao_user);
        $stmt->bindParam(':fb', $fb);
        $stmt->bindParam(':ig', $ig);
        $stmt->bindParam(':linkedin', $linkedin);
        $stmt->bindParam(':site', $site);
        $stmt->bindParam(':creci', $creci);
        $stmt->bindParam(':access_type', $access_type);
      
        $stmt->execute();
    }

    private function updateUser(
        $nome_user,
        $imob_autonomo,
        $whatsapp,
        $email,

        $descricao_user,
        $fb,
        $ig,
        $linkedin,
        $site,
        $creci,
        $access_type,
        
    ) {
        $query = "UPDATE perfil SET nome_user = :nome_user, imob_autonomo = :imob_autonomo, whatsapp = :whatsapp,
                                               descricao_user = :descricao_user, fb = :fb,
                                              ig = :ig, linkedin = :linkedin, site = :site, creci = :creci,
                                              access_type = :access_type WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nome_user', $nome_user);
        $stmt->bindParam(':imob_autonomo', $imob_autonomo);
        $stmt->bindParam(':whatsapp', $whatsapp);

        $stmt->bindParam(':descricao_user', $descricao_user);
        $stmt->bindParam(':fb', $fb);
        $stmt->bindParam(':ig', $ig);
        $stmt->bindParam(':linkedin', $linkedin);
        $stmt->bindParam(':site', $site);
        $stmt->bindParam(':creci', $creci);
        $stmt->bindParam(':access_type', $access_type);
        
        $stmt->bindParam(':email', $email);
        $stmt->execute();
    }


    public function buscarPorEmail($email)
    {
        $query = "SELECT * FROM perfil WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    // retornando imagem do perfil

    // Função para buscar o caminho da imagem no banco de dados
    public function getProfileImage($email)
    {
        // Query para buscar o caminho da imagem
        $query = "SELECT img FROM perfil WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // Verificar se há um resultado
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $imagePath = $row['img'];

            // Verificar se o caminho da imagem está vazio
            if (!empty($imagePath)) {
                // Retornar o caminho da imagem existente no banco de dados
                return $imagePath;
            }
        }

        // Caso não haja caminho de imagem no banco de dados, retornar o caminho da imagem genérica
        return '../imagem/perfil.jpg';
    }

    // caminho da imagem no banco
    public function atualizarImagemPerfil($email, $novoCaminhoImagem)
    {
        // Incluir o arquivo de conexão com o banco de dados


        // Preparar a query de atualização
        $query = "UPDATE perfil SET img = :img WHERE email = :email";
        $stmt = $this->conn->prepare($query);

        // Executar a query de atualização
        $stmt->execute([
            ':img' => $novoCaminhoImagem,
            ':email' => $email
        ]);
    }

    //   pegar imóveis com base no id
    function buscarImovelPorId($id)
    {
        try {

            // Consulta SQL para buscar o imóvel por ID
            $query = "SELECT * FROM imovel WHERE id_imovel = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            // Retorna os resultados como um array associativo
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Trate o erro adequadamente (exibindo mensagem, log, etc.)
            echo 'Erro no banco de dados: ' . $e->getMessage();
            return false;
        }
    }

    // bairro pelo ID

    // Função para buscar o bairro pelo ID
    function buscarBairroPorId($id)
    {
        try {

            // Consulta SQL para buscar o bairro pelo ID
            $query = "SELECT * FROM bairros WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            // Retorna o resultado como um array associativo
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Trate o erro adequadamente (exibindo mensagem, log, etc.)
            echo 'Erro no banco de dados: ' . $e->getMessage();
            return false;
        }
    }

    // excluir imagem no editar imóvel

    function deletarImagem($imagem_id, $caminho_imagem)
    {
        try {

            // Verificar se o ID da imagem é válido
            if (!is_numeric($imagem_id)) {
                throw new Exception('ID da imagem inválido');
            }

            // Consulta SQL para verificar se o ID da imagem e o caminho correspondem
            $query = "SELECT id FROM imagem WHERE id = :id AND url = :caminho";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':id', $imagem_id, PDO::PARAM_INT);
            $stmt->bindValue(':caminho', $caminho_imagem, PDO::PARAM_STR);
            $stmt->execute();

            // Verificar se a imagem existe
            if ($stmt->rowCount() > 0) {
                // Excluir a imagem da tabela
                $query_delete = "DELETE FROM imagem WHERE id = :id";
                $stmt_delete = $this->conn->prepare($query_delete);
                $stmt_delete->bindValue(':id', $imagem_id, PDO::PARAM_INT);
                $stmt_delete->execute();

                // Excluir a imagem do diretório
                if (file_exists($caminho_imagem)) {
                    unlink($caminho_imagem);
                }

                return true; // Exclusão bem-sucedida
            } else {
                throw new Exception('Imagem não encontrada');
            }
        } catch (PDOException $e) {
            // Tratar o erro adequadamente (exibindo mensagem, log, etc.)
            echo 'Erro no banco de dados: ' . $e->getMessage();
            return false;
        } catch (Exception $e) {
            // Tratar o erro adequadamente (exibindo mensagem, log, etc.)
            echo 'Erro: ' . $e->getMessage();
            return false;
        }
    }



    public function atualizarImovel(
        $id_imovel,
        $titulo,
        $id_bairro,
        $valor,
        $valor_condominio,
        $iptu,
        $area_construida,
        $quartos,
        $banheiros,
        $garagem,
        $cozinha,
        $sala,
        $garden,
        $sacada,
        $lavanderia,
        $suite,
        $elevador,
        $area_lazer,
        $descricao,
        $data_atualizacao
    ) {
        try {
            // Preparar a consulta SQL
            $sql = "UPDATE imovel SET titulo = :titulo, id_bairro = :id_bairro, valor = :valor, valor_condominio = :valor_condominio, iptu = :iptu, area_construida = :area_construida, quartos = :quartos, banheiros = :banheiros, garagem = :garagem, cozinha = :cozinha, sala = :sala, garden = :garden, sacada = :sacada, lavanderia = :lavanderia, suite = :suite, elevador = :elevador, area_lazer = :area_lazer, descricao = :descricao, data_atualizacao = :data_atualizacao WHERE id_imovel = :id_imovel";

            // Preparar a instrução PDO
            $stmt = $this->conn->prepare($sql);

            // Bind dos parâmetros
            $stmt->bindParam(':id_imovel', $id_imovel, PDO::PARAM_INT);
            $stmt->bindParam(':titulo', $titulo, PDO::PARAM_STR);
            $stmt->bindParam(':id_bairro', $id_bairro, PDO::PARAM_INT);
            $stmt->bindParam(':valor', $valor, PDO::PARAM_STR);
            $stmt->bindParam(':valor_condominio', $valor_condominio, PDO::PARAM_STR);
            $stmt->bindParam(':iptu', $iptu, PDO::PARAM_STR);
            $stmt->bindParam(':area_construida', $area_construida, PDO::PARAM_STR);
            $stmt->bindParam(':quartos', $quartos, PDO::PARAM_INT);
            $stmt->bindParam(':banheiros', $banheiros, PDO::PARAM_INT);
            $stmt->bindParam(':garagem', $garagem, PDO::PARAM_INT);
            $stmt->bindParam(':cozinha', $cozinha, PDO::PARAM_INT);
            $stmt->bindParam(':sala', $sala, PDO::PARAM_INT);
            $stmt->bindParam(':garden', $garden, PDO::PARAM_INT);
            $stmt->bindParam(':sacada', $sacada, PDO::PARAM_INT);
            $stmt->bindParam(':lavanderia', $lavanderia, PDO::PARAM_INT);
            $stmt->bindParam(':suite', $suite, PDO::PARAM_INT);
            $stmt->bindParam(':elevador', $elevador, PDO::PARAM_INT);
            $stmt->bindParam(':area_lazer', $area_lazer, PDO::PARAM_INT);
            $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
            $stmt->bindParam(':data_atualizacao', $data_atualizacao, PDO::PARAM_STR);

            // Executar a consulta
            $stmt->execute();

            // Verificar se a atualização foi bem-sucedida
            if ($stmt->rowCount() > 0) {
                echo "Atualização realizada com sucesso.";
            } else {
                echo "Nenhum registro foi atualizado.";
            }
        } catch (PDOException $e) {
            echo "Erro ao atualizar o imóvel: " . $e->getMessage();
        }
    }

    public function inserirLead($nome, $whatsapp, $url, $valor, $bairro, $quartos)
    {
        try {
            date_default_timezone_set('America/Cuiaba');
            // Conexão com o banco de dados

            // Preparar a consulta de inserção
            $query = "INSERT INTO leads (nome, whatsapp, url, valor, bairro, quartos, data) VALUES (:nome, :whatsapp, :url, :valor, :bairro, :quartos, :data)";
            $stmt = $this->conn->prepare($query);

            // Bind dos parâmetros
            $stmt->bindValue(':nome', $nome, PDO::PARAM_STR);
            $stmt->bindValue(':whatsapp', $whatsapp, PDO::PARAM_STR);
            $stmt->bindValue(':url', $url, PDO::PARAM_STR);
            $stmt->bindValue(':valor', $valor, PDO::PARAM_STR);
            $stmt->bindValue(':bairro', $bairro, PDO::PARAM_STR);
            $stmt->bindValue(':quartos', $quartos, PDO::PARAM_INT);
            $stmt->bindValue(':data', date('Y-m-d H:i:s'), PDO::PARAM_STR); // Data atual

            // Executar a consulta
            $stmt->execute();

            // Retorna o ID da última inserção
            return $this->conn->lastInsertId();
        } catch (PDOException $e) {
            // Tratar erros de PDO aqui
            // Por exemplo, lançar uma exceção personalizada ou registrar o erro em um log
            throw new Exception("Erro ao inserir lead: " . $e->getMessage());
        }
    }

    public function getImoveisMenorViews()
    {
        // Consulta para obter os 4 imóveis com os menores valores de views
        $query = "
        SELECT i.titulo, i.cod_imovel, i.valor, i.quartos, i.id_bairro, img.url AS primeira_imagem_url, b.nome AS nome_bairro
        FROM imovel AS i
        JOIN bairros AS b ON b.id = i.id_bairro
        LEFT JOIN (
            SELECT id_imovel, url
            FROM imagem
            WHERE id IN (
                SELECT MIN(id)
                FROM imagem
                GROUP BY id_imovel
            )
        ) AS img ON img.id_imovel = i.id_imovel
        WHERE i.views IN (
            SELECT views
            FROM (
                SELECT views
                FROM imovel
                ORDER BY views ASC
                LIMIT 4
            ) AS temp
        )
        LIMIT 4
    ";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    // visita na página do imóvel

    public function incrementarVisita($idImovel)
    {
        try {
            $sql = "UPDATE imovel SET views = views + 1 WHERE id_imovel = :idImovel";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':idImovel', $idImovel, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            die("Erro ao atualizar as visualizações do imóvel: " . $e->getMessage());
        }
    }


    // deletando imóvel e imagens

    public function deleteImovel($idImovel)
    {
        try {
            // Seleciona o caminho da pasta do imóvel para exclusão posterior
            $sql = "SELECT url FROM imagem WHERE id_imovel = :idImovel";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':idImovel', $idImovel, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $pastaImovel1 = $result['url'];

            $lastSlashPos = strrpos($pastaImovel1, '/');
            $pastaImovel = substr($pastaImovel1, 0, $lastSlashPos);

            // var_dump($pastaImovel);

            // Exclui as imagens do imóvel da tabela imagem
            $sql = "DELETE FROM imagem WHERE id_imovel = :idImovel";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':idImovel', $idImovel, PDO::PARAM_INT);
            $stmt->execute();

            // Exclui o registro do imóvel da tabela imovel
            $sql = "DELETE FROM imovel WHERE id_imovel = :idImovel";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':idImovel', $idImovel, PDO::PARAM_INT);
            $stmt->execute();

            // Apaga a pasta do imóvel e suas imagens
            $path = $pastaImovel;
            if (file_exists($path)) {
                $this->deleteDirectory($path);
            }
        } catch (PDOException $e) {
            die("Erro ao excluir o imóvel: " . $e->getMessage());
        }
    }

    private function deleteDirectory($dir)
    {
        if (!file_exists($dir)) {
            return true;
        }

        if (!is_dir($dir)) {
            return unlink($dir);
        }

        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }

            if (!$this->deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
                return false;
            }
        }

        return rmdir($dir);
    }

    public function atualizarStatusImovel($idImovel, $status)
    {
        try {
            $sql = "UPDATE imovel SET status = :status WHERE id_imovel = :idImovel";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':status', $status, PDO::PARAM_INT);
            $stmt->bindParam(':idImovel', $idImovel, PDO::PARAM_INT);
            $stmt->execute();

            // Verifica se ocorreu algum erro durante a execução da consulta
            var_dump($stmt->errorInfo());

            if ($stmt->rowCount() > 0) {
                return 'Status do imóvel atualizado com sucesso.';
            } else {
                return 'Imóvel não encontrado ou status não alterado.';
            }
        } catch (PDOException $e) {
            return 'Erro ao atualizar o status do imóvel: ' . $e->getMessage();
        }
    }

    public function verificarWhatsAppPerfil($email)
    {
        try {

            // Consultar o campo "whatsapp" na tabela "perfil" para o email especificado
            $query = "SELECT whatsapp FROM perfil WHERE email = :email";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            // Verificar se o campo "whatsapp" está vazio
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if (empty($result['whatsapp'])) {
                // Exibir a div de alerta
                echo '<div class="col-md-12 my-2">';
                echo '<div class="alert alert-danger" role="alert">';
                echo '<img src="../imagem/alert1.svg" width="20"> Antes de cadastrar Imóvel edite seu perfil colocando seu WhatsApp!';
                echo '</div>';
                echo '</div>';
            }
        } catch (PDOException $e) {
            // Tratar erros de PDO aqui
            // Por exemplo, lançar uma exceção personalizada ou registrar o erro em um log
            throw new Exception("Erro ao verificar WhatsApp do perfil: " . $e->getMessage());
        }
    }


    // aqui é para desabilitar os botões
    public function verificarRegistroImovel($id_proprietario)
    {
        try {


            // Consultar a quantidade de registros na tabela "imovel" para o ID do proprietário especificado
            $query = "SELECT COUNT(*) AS total FROM imovel WHERE id_proprietario = :id_proprietario";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id_proprietario', $id_proprietario, PDO::PARAM_INT);
            $stmt->execute();

            // Verificar o resultado da consulta
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $totalRegistros = $result['total'];



            // Verificar o campo "payment" na tabela "perfil"
            $query = "SELECT payment FROM perfil WHERE id = :id_proprietario";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id_proprietario', $id_proprietario, PDO::PARAM_INT);
            $stmt->execute();

            // Verificar o valor do campo "payment"
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $payment = $result['payment'];

           

            // Verificar se há 1 registro na tabela "imovel" e o "payment" é "free"
            if ($totalRegistros >= 1 && $payment == "free") {
                // Desabilitar o botão "Add Novo Imóvel"
                echo '<script>';
                echo 'document.getElementById("btnAddNovoImovel").removeAttribute("href");';
                echo '</script>';

                echo '<style>';
                echo '#btnAddNovoImovel { pointer-events: none; opacity: 0.6; }';
                echo '</style>';


                // Exibir a mensagem de aviso para se tornar Premium
                echo '<div class="col-md-12 my-2">';
                echo '<div class="alert alert-warning" role="alert">';
                echo '<img src="../imagem/alert.svg" width="25"> Seja <strong> PREMIUM </strong> para inserir imóveis ILIMITADOS.';
                echo '</div>';
                echo '</div>';

            }
        } catch (PDOException $e) {
            // Tratar erros de PDO aqui
            // Por exemplo, lançar uma exceção personalizada ou registrar o erro em um log
            throw new Exception("Erro ao verificar registro de imóvel: " . $e->getMessage());
        }
    }



}