<?php

    // fungsi get-data level 
    function selectUser1($level)
    {
        $result = null;
        if ($level == 1) {
            $result = "selected";
        }
        return $result;
    }

    function selectUser2($level)
    {
        $result = null;
        if ($level == 2) {
            $result = "selected";
        }
        return $result;
    }

    // fungsi get-data jabatan
    function selectJabatan1($jabatan)
    {
        $result = null;
        if ($jabatan == "Komandan") {
            $result = "selected";
        }
        return $result;
    }

    function selectJabatan2($jabatan)
    {
        $result = null;
        if ($jabatan == "Wakil komandan") {
            $result = "selected";
        }
        return $result;
    }

    function selectJabatan3($jabatan)
    {
        $result = null;
        if ($jabatan == "Petugas") {
            $result = "selected";
        }
        return $result;
    }

    function selectJabatan4($jabatan)
    {
        $result = null;
        if ($jabatan == "Operator") {
            $result = "selected";
        }
        return $result;
    }

    ?>