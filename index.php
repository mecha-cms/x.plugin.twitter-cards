<?php namespace x\twitter_cards;

function content($content) {
    \extract($GLOBALS, \EXTR_SKIP);
    if (!empty($page)) {
        $out  = '<!-- Begin Twitter Cards -->';
        $out .= '<meta content="' . ($page->image ? 'summary_large_image' : 'summary') . '" name="twitter:card">';
        $out .= !empty($state->x->{'twitter-cards'}->creator) ? '<meta content="@' . $state->x->{'twitter-cards'}->creator . '" name="twitter:creator">' : "";
        if ($description = \w($page->description ?? $site->description ?? "")) {
            $out .= '<meta content="' . \eat($description) . '" name="twitter:description">';
        }
        $out .= '<meta content="' . \eat($page->image ?? $url . '/favicon.ico') . '" name="twitter:image">';
        $out .= !empty($state->x->{'twitter-cards'}->site) ? '<meta content="@' . $state->x->{'twitter-cards'}->site . '" name="twitter:site">' : "";
        $out .= '<meta content="' . \w($page->title ?? $t ?? "") . '" name="twitter:title">';
        $out .= '<meta content="' . \eat($url->current) . '" name="twitter:url">';
        $out .= '<!-- End Twitter Cards -->';
        return \strtr($content, ['</head>' => $out . '</head>']);
    }
    return $content;
}

\Hook::set('content', __NAMESPACE__ . "\\content", 1.9);