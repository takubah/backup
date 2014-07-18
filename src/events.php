<?php

$eventBase = new Antoniputra\Asmoyo\Utilities\Cache\CacheObserver;

Antoniputra\Asmoyo\Pages\Page::observe($eventBase);
Antoniputra\Asmoyo\Users\User::observe($eventBase);
Antoniputra\Asmoyo\Categories\Category::observe($eventBase);
Antoniputra\Asmoyo\Medias\Media::observe($eventBase);
Antoniputra\Asmoyo\Posts\Post::observe($eventBase);