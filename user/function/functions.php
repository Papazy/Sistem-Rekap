<?php 

    function getData($sql) {
        global $koneksi;

        $result = mysqli_query($koneksi, $sql);
        $rows   = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    function userLogin() {
        $userActive = $_SESSION["ssUser"];
        $dataUser   = getData("SELECT * FROM user WHERE username = '$userActive'")[0];
        return $dataUser;
    }

?>


