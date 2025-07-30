<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Yosymfony\Toml\Toml;

if (file_exists(base_path(".config.json5"))) {
    return ["config" => json5_decode(file_get_contents(base_path(".config.json5")), true)];
} else {
    return ["config" => []];
}


