<?php
header("Content-Type: text/plain; charset=UTF-8");
header('Content-Disposition: attachment; filename="backup-chat-RH '.date("d-m-Y G.i").'.txt"');
while ($pesannya = $result->fetch_assoc()):
    echo "[ ".$pesannya['waktu']." ] ".$pesannya['nama']." : ".$pesannya['pesan']."\n";
endwhile;
?>