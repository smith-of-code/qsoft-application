<?php

foreach (array_slice(scandir("$_SERVER[DOCUMENT_ROOT]/local/src/Events"), 2) as $file) {
    $class = str_replace('.php', '', $file);
    $module = strtolower(str_replace('ModuleEvents', '', $class));
    $classNamespace = "QSoft\\Events\\$class";
    foreach (get_class_methods($classNamespace) as $method) {
        if (!str_starts_with($method, '__') && (new ReflectionMethod("$classNamespace::$method"))->isPublic()) {
            AddEventHandler($module, $method, [$classNamespace, $method]);
        }
    }
}
