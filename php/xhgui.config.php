<?php
return array(
    'db.host' => 'mongodb://mongo:27017',

    'profiler.enable' => function() {
        return rand(1, 100) === 42;
    },
);
