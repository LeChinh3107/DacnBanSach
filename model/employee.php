<?php
function load()
{
    $sql = "SELECT masach, tensach, image, gia FROM sach WHERE matheloai = 1";
    $empList = selectSQL($sql);
    return $empList;
}
function loadAll()
{
    $sql = "SELECT masach, tensach, image, gia FROM sach";
    $empList = selectSQL($sql);
    return $empList;
}
?>