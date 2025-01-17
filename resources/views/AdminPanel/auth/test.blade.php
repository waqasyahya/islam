{{-- 
<?php

// session_start();

// if(isset($_POST['submit_credentials'])) { 

//     $connection = mysqli_connect('localhost', 'root', '', 'islame');

//     if($connection) {
//         $queryCheck = mysqli_query($connection, "SELECT * FROM users WHERE email = '".$_POST['Email']."' AND password = '".$_POST['password']."'");

//         if(mysqli_num_rows($queryCheck) > 0) { 

//             $result = mysqli_fetch_array($queryCheck);
//             $_SESSION['type'] = $result['type'];

//             if($result['type'] == 1) {
//                 header('Location: http://127.0.0.1:8000/read', true);
//                 exit();
//             } else {
//                 header('Location: http://127.0.0.1:8000/dashboard', true);
//             }

//             exit();
            
//         }

//     }

// }

?> --}}