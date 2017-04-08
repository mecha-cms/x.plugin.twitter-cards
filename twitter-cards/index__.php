<?php

function fn_twitter_cards_replace($content) {
    if ($page = Lot::get('page')) {
        global $site, $url;
        $state = Plugin::state(__DIR__);
        $html  = '<!-- Begin Twitter Cards -->';
        $html .= '<meta name="twitter:card" content="' . ($page->image ? 'summary_large_image' : 'summary') . '">';
        $html .= $state['twitter_site'] ? '<meta name="twitter:site" content="@' . $state['twitter_site'] . '">' : "";
        $html .= $state['twitter_creator'] ? '<meta name="twitter:creator" content="@' . $state['twitter_creator'] . '">' : "";
        $html .= '<meta name="twitter:title" content="' . To::text($site->page->title) . '">';
        $html .= '<meta name="twitter:url" content="' . $url->current . '">';
        $html .= '<meta name="twitter:description" content="' . To::text($page->description($site->description)) . '">';
        $html .= '<meta name="twitter:image" content="' . $page->image($url . '/favicon.ico') . '">';
        $html .= '<!-- End Twitter Cards -->';
        return str_ireplace('</head>', $html . '</head>', $content);
    }
    return $content;
}

Hook::set('shield.output', 'fn_twitter_cards_replace', 1.9);