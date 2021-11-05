
<?php
function formatear($num)
{
    setlocale(LC_MONETARY, 'en_US');
    return "$" . number_format($num, 2);
}
?>

