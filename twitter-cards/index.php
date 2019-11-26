<?php namespace _\lot\x;

function twitter_cards($content) {
    extract($GLOBALS, \EXTR_SKIP);
    if (!empty($page)) {
        $out  = '<!-- Begin Twitter Cards -->';
        $out .= '<meta name="twitter:card" content="' . ($page->image ? 'summary_large_image' : 'summary') . '">';
        $out .= !empty($state->x->{'twitter-cards'}->site) ? '<meta name="twitter:site" content="@' . $state->x->{'twitter-cards'}->site . '">' : "";
        $out .= !empty($state->x->{'twitter-cards'}->creator) ? '<meta name="twitter:creator" content="@' . $state->x->{'twitter-cards'}->creator . '">' : "";
        $out .= '<meta name="twitter:title" content="' . \w($t->reverse) . '">';
        $out .= '<meta name="twitter:url" content="' . \r('&', '&amp;', $url->current) . '">';
        if ($w = \w($page->description ?? $state->description ?? "")) {
            $out .= '<meta name="twitter:description" content="' . $w . '">';
        }
        $out .= '<meta name="twitter:image" content="' . ($page->image ?? $url . '/favicon.ico') . '">';
        $out .= '<!-- End Twitter Cards -->';
        return \str_replace('</head>', $out . '</head>', $content);
    }
    return $content;
}

\Hook::set('content', __NAMESPACE__ . "\\twitter_cards", 1.9);