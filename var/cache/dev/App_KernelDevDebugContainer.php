<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerZvwdVid\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerZvwdVid/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerZvwdVid.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerZvwdVid\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerZvwdVid\App_KernelDevDebugContainer([
    'container.build_hash' => 'ZvwdVid',
    'container.build_id' => '379c794a',
    'container.build_time' => 1682195746,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerZvwdVid');
