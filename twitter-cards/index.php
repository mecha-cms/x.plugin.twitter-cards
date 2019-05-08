<?php namespace _;

function twitter_cards($content) {
    extract($GLOBALS, \EXTR_SKIP);
    if (!empty($page)) {
        $state = \Plugin::state('twitter-cards');
        $out  = '<!-- Begin Twitter Cards -->';
        $out .= '<meta name="twitter:card" content="' . ($page->image ? 'summary_large_image' : 'summary') . '">';
        $out .= $state['twitter_site'] ? '<meta name="twitter:site" content="@' . $state['twitter_site'] . '">' : "";
        $out .= $state['twitter_creator'] ? '<meta name="twitter:creator" content="@' . $state['twitter_creator'] . '">' : "";
        $out .= '<meta name="twitter:title" content="' . \To::text($config->trace) . '">';
        $out .= '<meta name="twitter:url" content="' . \strtr($url->current, ['&' => '&amp;']) . '">';
        $out .= '<meta name="twitter:description" content="' . \To::text($page->description ?? $config->description) . '">';
        $out .= '<meta name="twitter:image" content="' . ($page->image ?? $url . '/favicon.ico') . '">';
        $out .= '<!-- End Twitter Cards -->';
        return \str_replace('</head>', $out . '</head>', $content);
    }
    return $content;
}

\Hook::set('content', __NAMESPACE__ . "\\twitter_cards", 1.9);