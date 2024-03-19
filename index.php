<?php namespace x\twitter_cards;

function content($content) {
    if (!$content || false === \strpos($content, '</head>')) {
        return $content;
    }
    \extract(\lot(), \EXTR_SKIP);
    if (empty($page)) {
        return $content;
    }
    $y = [false, [], []];
    $y[1]['twitter:card'] = ['meta', false, [
        'content' => $page->image ? 'summary_large_image' : 'summary',
        'name' => 'twitter:card'
    ]];
    if ($creator = $state->x->{'twitter-cards'}->creator ?? "") {
        $y[1]['twitter:creator'] = ['meta', false, [
            'content' => '@' . $creator,
            'name' => 'twitter:creator'
        ]];
    }
    if ($description = \w($page->description ?? $site->description ?? "")) {
        $y[1]['twitter:description'] = ['meta', false, [
            'content' => $description,
            'name' => 'twitter:description'
        ]];
    }
    $y[1]['twitter:image'] = ['meta', false, [
        'content' => $page->image ?? $url . '/favicon.ico',
        'name' => 'twitter:image'
    ]];
    if ($origin = $state->x->{'twitter-cards'}->site ?? "") {
        $y[1]['twitter:site'] = ['meta', false, [
            'content' => '@' . $origin,
            'name' => 'twitter:site'
        ]];
    }
    if ($title = \w($page->title ?? $t ?? "")) {
        $y[1]['twitter:title'] = ['meta', false, [
            'content' => $title,
            'name' => 'twitter:title'
        ]];
    }
    $y[1]['twitter:url'] = ['meta', false, [
        'content' => $url->current,
        'name' => 'twitter:url'
    ]];
    $v = new \HTML(\Hook::fire('y.twitter-cards', [$y], $page), true);
    return \strtr($content, ['</head>' => $v . '</head>']);
}

\Hook::set('content', __NAMESPACE__ . "\\content", 1.9);