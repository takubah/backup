<?php

$eventBase = new Antoniputra\Asmoyo\Utilities\Cache\ModelObserver;

Antoniputra\Asmoyo\Pages\Page::observe($eventBase);
Antoniputra\Asmoyo\Users\User::observe($eventBase);