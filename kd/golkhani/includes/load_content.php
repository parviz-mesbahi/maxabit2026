<?php
function load_content(string $page): array {
    $file = __DIR__ . '/../content/' . $page . '.json';
    if (!file_exists($file)) return [];
    return json_decode(file_get_contents($file), true) ?? [];
}
