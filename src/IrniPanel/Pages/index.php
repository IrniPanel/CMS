<?php
    use Noodlehaus\Config;
    use Noodlehaus\Parser\Json;

    $config = Config::load('../config/config.json');

    echo '<title>Dashboard | ' . $config->get('name') . '</title>';