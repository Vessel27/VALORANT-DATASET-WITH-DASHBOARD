<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Valorant Dashboard</title>
    <!-- AdminLTE & Bootstrap -->
    <link rel="icon" href="img/valo.png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="font/css/all.css">
    <link rel="stylesheet" href="css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="css/design.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light"
            style="position: sticky; top: 0; z-index: 1030; width: 100%;">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index.php" class="nav-link">Home</a>
                </li>
            </ul>
        </nav>

        <!-- Sidebar -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="#" class="brand-link">
                <img src="img/valo.png" style="opacity: .8; width: 40px; height: 25px;">
                <span class="brand-text font-weight-light">Valorant Dashboard</span>
            </a>
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column">
                        <li class="nav-item">
                            <a href="index.php" class="nav-link active">
                                <i class="nav-icon fas fa-dollar-sign"></i>
                                <p> Price </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="dmg.php" class="nav-link">
                                <i class="nav-icon fas fa-gun"></i>
                                <p> Weapon Damage </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="firerate.php" class="nav-link">
                                <i class="nav-icon far fa-dot-circle"></i>
                                <p> Fire Rate </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="wall.php" class="nav-link">
                                <i class="nav-icon fas fa-cogs"></i>
                                <p> Wall Penetration </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="mag.php" class="nav-link">
                                <i class="nav-icon fas fa-cogs"></i>
                                <p> Magazine Capacity </p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <h1 class="m-0">Weapon Damage</h1>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <p>Weapon <i class="fa-solid fa-gun"></i></p>
                    </div>
                    <div class="col-md-12 text-center">
                        <canvas id="myRadarChart" height="500px"></canvas>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Top 10 Lowest Damage Weapons</h3>
                            </div>
                            <div class="card-body">
                                <ul id="topMostDamageWeapons" class="list-group"></ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Top 10 Highest Damage Weapons</h3>
                            </div>
                            <div class="card-body">
                                <ul id="topLeastDamageWeapons" class="list-group"></ul>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>

        <!-- Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2025 <a href="#">Your Company</a>.</strong>
            All rights reserved.
        </footer>
    </div>

    <!-- AdminLTE Scripts -->
    <script src="js/jquery-3.7.1.min.js"></script> <!-- jQuery must be loaded first -->
    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/dataTables.min.js"></script>
    <script src="js/sweetalert2.js"></script>
    <script src="js/chart.js"></script>
    <script src="js/dmgdata.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <script src="js/design.js"></script>
</body>

</html>