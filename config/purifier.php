<?php

/**
 * Ok, glad you are here
 * first we get a config instance, and set the settings
 * $config = HTMLPurifier_Config::createDefault();
 * $config->set('Core.Encoding', $this->config->get('purifier.encoding'));
 * $config->set('Cache.SerializerPath', $this->config->get('purifier.cachePath'));
 * if ( ! $this->config->get('purifier.finalize')) {
 *     $config->autoFinalize = false;
 * }
 * $config->loadArray($this->getConfig());
 *
 * You must NOT delete the default settings
 * anything in settings should be compacted with params that needed to instance HTMLPurifier_Config.
 *
 * @link http://htmlpurifier.org/live/configdoc/plain.html
 */

return [
    'encoding'           => 'UTF-8',
    'finalize'           => true,
    'ignoreNonStrings'   => false,
    'cachePath'          => storage_path('app/purifier'),
    'cacheFileMode'      => 0755,
    'settings'      => [
        'default' => [
            'HTML.Doctype'             => 'XHTML 1.0 Strict',

            'HTML.AllowedElements' => [
                'div', 'span',
                'section', 'nav', 'article', 'aside', 'header', 'footer',
                'h1', 'h2', 'h3', 'h4', 'h5', 'h6',
                'p', 'b', 'i', 'small', 'pre',
                'sub', 'sup', 'mark', 'ins', 'del', 'blockquote',
                'ul', 'ol', 'li',
                'img', 'a',
                'table', 'thead', 'tbody', 'tfoot', 'tr', 'th', 'td',
                'audio', 'video', 'source',
                'iframe',
                'meta',
                'br', 'hr',
            ],

            'HTML.AllowedAttributes' => [
                'id', 'class', 'style',
                'title', 'type',
                'src', 'alt', 'width', 'height',
                'href', 'target',
                'controls', 'autoplay', 'muted', 'loop', 'preload', 'poster',
                'allowfullscreen', 'frameborder',
                'name', 'property', 'content', 'charset',
            ],

            'CSS.ForbiddenProperties' => [],

            'Attr.EnableID' => true,
            'Attr.DefaultImageAlt' => '',
            'CSS.MaxImgLength' => null,

            'AutoFormat.AutoParagraph' => false,
            'AutoFormat.RemoveEmpty' => false,
            // 'Cache.DefinitionImpl' => null,
        ],
        'test'    => [
            'Attr.EnableID' => 'true',
        ],
        'custom_definition' => [
            'id'  => 'html5-definitions',
            'rev' => 1,
            'debug' => false,
            'elements' => [
                ['section', 'Block', 'Flow', 'Common'],
                ['nav',     'Block', 'Flow', 'Common'],
                ['article', 'Block', 'Flow', 'Common'],
                ['aside',   'Block', 'Flow', 'Common'],
                ['header',  'Block', 'Flow', 'Common'],
                ['footer',  'Block', 'Flow', 'Common'],

                // Content model actually excludes several tags, not modelled here
                ['address', 'Block', 'Flow', 'Common'],
                ['hgroup', 'Block', 'Required: h1 | h2 | h3 | h4 | h5 | h6', 'Common'],

                // http://developers.whatwg.org/grouping-content.html
                ['figure', 'Block', 'Optional: (figcaption, Flow) | (Flow, figcaption) | Flow', 'Common'],
                ['figcaption', 'Inline', 'Flow', 'Common'],

                // http://developers.whatwg.org/the-video-element.html#the-video-element
                ['audio', 'Block', 'Optional: (source, Flow) | (Flow, source) | Flow', 'Common', [
                    'src' => 'URI',
                    'type' => 'Text',
                    'preload' => 'Enum#auto,metadata,none',
                    'controls' => 'Bool',
                    'autoplay' => 'Bool',
                    'muted' => 'Bool',
                    'loop' => 'Bool',
                ]],
                ['video', 'Block', 'Optional: (source, Flow) | (Flow, source) | Flow', 'Common', [
                    'src' => 'URI',
                    'type' => 'Text',
                    'width' => 'Length',
                    'height' => 'Length',
                    'poster' => 'URI',
                    'preload' => 'Enum#auto,metadata,none',
                    'controls' => 'Bool',
                    'autoplay' => 'Bool',
                    'muted' => 'Bool',
                    'loop' => 'Bool',
                ]],
                ['source', 'Block', 'Flow', 'Common', [
                    'src' => 'URI',
                    'type' => 'Text',
                ]],

                // http://developers.whatwg.org/text-level-semantics.html
                ['s',    'Inline', 'Inline', 'Common'],
                ['var',  'Inline', 'Inline', 'Common'],
                ['sub',  'Inline', 'Inline', 'Common'],
                ['sup',  'Inline', 'Inline', 'Common'],
                ['mark', 'Inline', 'Inline', 'Common'],
                ['wbr',  'Inline', 'Empty', 'Core'],

                // http://developers.whatwg.org/edits.html
                ['ins', 'Block', 'Flow', 'Common', ['cite' => 'URI', 'datetime' => 'CDATA']],
                ['del', 'Block', 'Flow', 'Common', ['cite' => 'URI', 'datetime' => 'CDATA']],

                // Custom

                ['iframe', 'Block', 'Flow', 'Common', [
                    'src' => 'URI',
                    'allowfullscreen' => 'Bool',
                    'frameborder' => 'Length',
                    'width' => 'Length',
                    'height' => 'Length',
                ]],
                ['meta', 'Inline', 'Empty', 'Common', [
                    'name' => 'Text',
                    'property' => 'Text',
                    'content' => 'Text',
                    'charset' => 'Text',
                ]],
            ],
            'attributes' => [
                ['table', 'height', 'Text'],
                ['td', 'border', 'Text'],
                ['th', 'border', 'Text'],
                ['tr', 'width', 'Text'],
                ['tr', 'height', 'Text'],
                ['tr', 'border', 'Text'],
            ],
        ],
        'custom_attributes' => [
            ['a', 'target', 'Enum#_blank,_self,_target,_top'],
        ],
        'custom_elements' => [
            ['u', 'Inline', 'Inline', 'Common'],
        ],
    ],

];
