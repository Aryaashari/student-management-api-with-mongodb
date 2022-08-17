<?php

namespace Student\Management\App;

class View {

    public static function render(string $path, array $model = null) {
        require __DIR__."/../view/".$path;
    }

}