<html>
<body>
<?php
$x = array();
$y = array();
echo 'array()', '<=>', 'array()', ' Returns ', $x <=> $y;

echo '<br>';
$c = array(1, 2, 3);
$d = array(1, 2, 3);
$e = array(1, 2, 1);
$f = array(1, 2, 4);

echo 'array()', '<=>', 'array(1,2,3)', ' Returns ', $x <=> $c;

echo '<br>';

echo 'array(1,2,3)', '<=>', 'array(1,2,3)', ' Returns ', $c <=> $d;

echo '<br>';

echo 'array(1,2,3)', '<=>', 'array(1,2,1)', ' Returns ', $c <=> $e;

echo '<br>';

echo 'array(1,2,3)', '<=>', 'array(1,2,4)', ' Returns ', $c <=> $f;


?>
</body>
</html>