<!DOCTYPE html>
<html lang="en-US">

<head>
    <!--Meta Tags Starts Here-->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <!--Meta Tags Ends Here-->

    <title>Quizpper-beta Test</title>

    <!--COUNT DOWN TIMER STARTS HERE-->
    <script src="<?php echo SITEURL; ?>/assets/js/countdown/jquery.js"></script>
    <script src="<?php echo SITEURL; ?>/assets/js/countdown/jquery.simple.timer.js"></script>
    <script>
        $(function() {
            $('.timer').startTimer();
        });
    </script>
    <!--COUNT DOWN TIMER ENDS HERE-->

    <!--ADDING CKEDITOR HERE-->
    <script type="text/javascript" src="<?php echo SITEURL; ?>/assets/ckeditor/ckeditor.js"></script>

    <!--CSS File Starts Here-->
    <link rel="stylesheet" type="text/css" href="<?php echo SITEURL; ?>/assets/css/style.css" />
    <!--CSS File Ends Here-->

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Font -->
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>

    <!-- SweetAlert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <!--Header Starts Here-->
    <nav class="navbar navbar-expand-lg navbar-dark shadow-5-strong">
        <div class="container-fluid">
            <div style="position: relative; margin-top: 12px;">
                <a class="navbar-brand" href="#">
                    <img src="https://i.ibb.co/KX4XZSL/removal-ai-tmp-634a698c25201-2.png" height="150" alt="Quizpper">
                </a>
            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <?php
                    if ((isset($_SESSION['student_id'])) && ($_GET['page'] != 'login')) {
                        echo '<li class="nav-item">';
                        echo '<a class="nav-link ';
                        if (($_GET['page']) == 'home') {
                            echo 'active"';
                        } else {
                            echo '"';
                        };
                        echo 'aria-current="page" href="index.php?page=home">Beranda</a>';
                        echo '</li>';
                        echo '<li class="nav-item">';
                        echo '<a class="nav-link ';
                        if (($_GET['page']) == 'schedule') {
                            echo 'active"';
                        } else {
                            echo '"';
                        };
                        echo 'href="index.php?page=schedule">Jadwal</a>
                        </li>';
                    } else {
                        echo '';
                    };
                    ?>
                </ul>
                <?php
                if ((isset($_SESSION['student_id'])) && ($_GET['page'] != 'login')) {
                    $student_username = $_SESSION['student_username'];
                    echo "<form class='d-flex ms-auto'>
                    <div class='nav-item dropdown'>
                        <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-bs-toggle='dropdown' data-bs-display='static' aria-expanded='false'>
                            <img src='https://www.pngmart.com/files/21/Admin-Profile-PNG-Clipart.png' class='rounded-circle' width='70' height='70'>
                        </a>
                        <ul class='dropdown-menu dropdown-menu-dark dropdown-menu-lg-end' aria-labelledby='navbarDropdown'>
                            <li><p class='dropdown-item'>$student_username</li>
                            <li><a class='dropdown-item' href='#'><i class='fa-solid fa-user-pen me-2'></i>Edit Profil</a></li>
                            <li><a class='dropdown-item' onclick='logout_alert()' data-bs-toggle='modal_' data-bs-target='#logoutModal_' id='logout_alert'><i class='me-2 fa-solid fa-right-from-bracket'></i>Log Out</a></li>
                        </ul>
                    </div>
                </form>";
                } else {
                    echo '';
                }
                ?>

                <!-- sweetalert2 logout_alert -->
                <script>
                    function logout_alert() {
                        Swal.fire({
                            title: 'Kamu Yakin?',
                            text: 'Semua aktivitas kamu tidak disimpan!',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, keluar!',
                            cancelButtonText: 'Batal!',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                Swal.fire(
                                    'Logged Out!',
                                    'Kamu berhasi keluar.',
                                    'success',
                                    window.location = "index.php?page=logout"
                                )
                            }
                        })
                    }
                </script>

            </div>
        </div>
    </nav>
    <!--Header Ends Here-->