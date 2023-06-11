<?php namespace x\twitter_cards;

function content($content) {
    if (!$content || false === \strpos($content, '</head>')) {
        return $content;
    }
    \extract($GLOBALS, \EXTR_SKIP);
    if (empty($page)) {
        return $content;
    }
    $out = [false, [], []];
    $out[1]['twitter:card'] = ['meta', false, [
        'content' => $page->image ? 'summary_large_image' : 'summary',
        'name' => 'twitter:card'
    ]];
    if ($creator = $state->x->{'twitter-cards'}->creator ?? "") {
        $out[1]['twitter:creator'] = ['meta', false, [
            'content' => '@' . $creator,
            'name' => 'twitter:creator'
        ]];
    }
    if ($description = \w($page->description ?? $site->description ?? "")) {
        $out[1]['twitter:description'] = ['meta', false, [
            'content' => $description,
            'name' => 'twitter:description'
        ]];
    }
    $out[1]['twitter:image'] = ['meta', false, [
        'content' => $page->image ?? $url . '/favicon.ico',
        'name' => 'twitter:image'
    ]];
    if ($origin = $state->x->{'twitter-cards'}->site ?? "") {
        $out[1]['twitter:site'] = ['meta', false, [
            'content' => '@' . $origin,
            'name' => 'twitter:site'
        ]];
    }
    if ($title = \w($page->title ?? $t ?? "")) {
        $out[1]['twitter:title'] = ['meta', false, [
            'content' => $title,
            'name' => 'twitter:title'
        ]];
    }
    $out[1]['twitter:url'] = ['meta', false, [
        'content' => $url->current,
        'name' => 'twitter:url'
    ]];
    $out = new \HTML(\Hook::fire('y.twitter-cards', [$out], $page), true);
    return \strtr($content, ['</head>' => $out . '</head>']);
}

\Hook::set('content', __NAMESPACE__ . "\\content", 1.9);