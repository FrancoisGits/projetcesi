<?php
$content = json_decode(
    utf8_encode(
        file_get_contents(__DIR__ . '\config.json', FALSE, NULL)
    ),
    true,
    512
);