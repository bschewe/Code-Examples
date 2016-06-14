<?php

function cleanupData() {
    global $pdo;

    $stmt = $pdo->prepare('DELETE FROM Profile
        WHERE updated_at < (NOW() - INTERVAL 60 MINUTE)');
    $stmt->execute();
}
