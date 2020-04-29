
<?php
// A sessão precisa ser iniciada em cada página diferente
   
    
    if(!function_exists("protect"))
    {

        

    function protect($pagina)
    {
        // Verifica se não há a variável da sessão que identifica o usuário
        if (!isset($_SESSION['UsuarioID'])) 
        {
            // Destrói a sessão por segurança
            session_destroy();
            // Redireciona o visitante de volta pro login
            header("Location: login.php"); exit;
        }

        $servername = "Localhost";
        $database = "ads_sql";
        $username = "root";
        $password = "";
        $conn = mysqli_connect($servername, $username, $password, $database);
        $permissao = 0;
        $sql = "SELECT 
                    permitido
                FROM 
                    permissoes_pagina_usuario
                where 
                id_usuario = ".$_SESSION['UsuarioID']." 
                and id_permissoes_pagina in (select id from permissoes_pagina where pagina = '".$pagina."')";
            //echo $sql;
     
        $result = mysqli_query($conn,$sql) ;

        if ($result <> null)
        {
            while($row = mysqli_fetch_array($result))
            {
                $permissao = $row['permitido']; 
            }
        }
        mysqli_close($conn);

        if ($permissao !=1) 
        {
            // Destrói a sessão por segurança
            // Redireciona o visitante de volta pro login
            header("Location: acessonegado.php"); exit;
        }
    }
}
  ?> 

