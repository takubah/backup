<?php

$eventBase = new Antoniputra\Asmoyo\Utilities\Cache\CacheObserver;

Antoniputra\Asmoyo\Pages\Page::observe($eventBase);
Antoniputra\Asmoyo\Users\User::observe($eventBase);
Antoniputra\Asmoyo\Categories\Category::observe($eventBase);