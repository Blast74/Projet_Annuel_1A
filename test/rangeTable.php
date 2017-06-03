<?php
// array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12)
foreach (range(0, 12) as $number) {
    echo $number;
    echo '<br>';
}

// La paramètre de pas (step)
// array(0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100)
foreach (range(0, 100, 10) as $number) {
    echo $number;
    echo '<br>';
}

// Utilisation des caractères
// array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i');
foreach (range('a', 'i') as $letter) {
    echo $letter;
    echo '<br>';
}
// array('c', 'b', 'a');
foreach (range('c', 'a') as $letter) {
    echo $letter;
    echo '<br>';
}
?>
