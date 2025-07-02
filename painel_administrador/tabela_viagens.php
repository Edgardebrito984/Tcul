<?php

include('../conecao.php')
?>
<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    // Não é admin ou sessão expirou
    header("Location: ../paginas/login.php");
    exit();
    

    }
    $adminNome = $_SESSION['admin_nome'];
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Rotas</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.PHP">
                <div class="sidebar-brand-icon rotate-n-15">
                    
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">TCUL </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.PHP">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Registro</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        <a class="collapse-item" href="Motorista.php">Motorista</a>
                        <a class="collapse-item" href="cadastrar_autocarro.php">Autocarro</a>
                        <a class="collapse-item" href="Cadastrar_viagem.php">Viagem</a>
                        <a class="collapse-item" href="cadastrar_rota.php">Rotas</a>
                        <a class="collapse-item" href="#">Poltronas</a>
                    </div>
                </div>
            </li>

           

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

          

            <!-- Nav Item - Charts -->
            

            <!-- Nav Item - Motoristas -->
            <li class="nav-item">
                <a class="nav-link" href="tabela-motorista.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tabela Motorista</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="tabela-autocarro.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tabela Autocarro</span></a>
            </li>


            <li class="nav-item">
                <a class="nav-link" href="tabela_rota.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tabela Rota</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="tabela_reserva.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tabela Reserva</span></a>
            </li>
             <li class="nav-item">
                <a class="nav-link" href="tabela_viagens.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tabela Viagens</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

           

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

          
                   

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                     
                    <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo htmlspecialchars( $adminNome); ?></span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../paginas/logout.php" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                

                    
                 

                    
                    <div class="container-fluid">


<div class="card shadow mb-4">
        <?php include('mensagem.php');?> 
    <div class="card-header py-3">
       
        <h6 class="m-0 font-weight-bold text-primary">Viagens</h6>
        <button class="btn btn-primary float-end" >
            <a href="cadastrar_viagem.php" class="btn btn-primary">
            Cadastrar Viagem
        </a>
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  
                    <tr>
                        <th>id</th>
                         <th>Rota ID</th>
                        <th>Data De Partida</th>
                        <th>Hora de parida</th>
                        <th>Hora de chegada</th>
                        <th>Autocarro ID</th>
                        <th>Data de criação</th>
                        <th>Ações</th>
                    </tr>
                   
                </thead>
               
                <tbody>
                <?php
                    $sql="SELECT * FROM viagens";
                    $result = $conn->query($sql);
                    if($result-> num_rows > 0){
                    while($row=$result->fetch_assoc()){ 
                    ?>
                    <tr>
                        <td><?= $row['id']?></td>
                        <td><?= $row['rota_id']?></td>
                        <td><?= $row['data_partida']?></td>
                        <td><?= $row['hora_partida']?></td>
                        <td><?= $row['hora_chegada']?></td>
                        <td><?= $row['autocarro_id']?></td>
                        <td><?= date('d-m-y', strtotime($row['data_criacao']))?></td>
                       
                        
                        <td>
                            <a href="" class="btn btn-secondary btn sm">Visualizar</a>
                            <a href="motorista-editar.php?id=<?=$row['id']?>" class="btn btn-success btn sm">Editar</a>
                            <form action="acoes.php" Method="POST" class="d-inline">
                                <button onclick="return confirm('Tens a certeza que desejas excluir?')" type="submit" name="delete_rota" value="<?= $row['id']?>" class="btn btn-danger btn-sn">
                                excluir
                                </button>
                            </form>
                        </td>
                    </tr>
                   
                    
                </tbody>
                <?php 
                    }
                } else{
                   
                    echo' <h5>Nenhum Autocarro encontrado</h5>';
                }
                ?>
            </table>
        </div>
    </div>
</div>

</div>