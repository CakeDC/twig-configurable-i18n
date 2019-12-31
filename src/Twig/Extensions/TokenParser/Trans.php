<?php

/**
 * A class implementing a token parser for translation nodes.
 *
 * @author Jaime Pérez Crespo
 */

namespace SimpleSAML\TwigConfigurableI18n\Twig\Extensions\TokenParser;

use SimpleSAML\TwigConfigurableI18n\Twig\Extensions\Node\Trans as NodeTrans;
use Twig\Token;

class Trans extends \Symfony\Bridge\Twig\TokenParser\TransTokenParser
{
    /**
     * Parses a token and returns a node.
     *
     * @param \Twig\Token $token A \Twig\Token instance
     *
     * @return \Twig\Node\Node A \Twig\Node\Node instance
     */
    public function parse(Token $token)
    {
        $parsed = parent::parse($token);
        $body = $parsed->getNode('body');
        $domain = $parsed->getNode('domain');

        /** @var \Twig\Node\Expression\AbstractExpression|null */
        $count = ($parsed->hasNode('count')) ? $parsed->getNode('count') : null;
        /** @var \Twig\Node\Expression\AbstractExpression|null */
        $vars = ($parsed->hasNode('vars')) ? $parsed->getNode('vars') : null;
        /** @var \Twig\Node\Expression\AbstractExpression|null */
        $locale = ($parsed->hasNode('locale')) ? $parsed->getNode('locale') : null;

        /** @var \Twig\Node\Node */
        return new NodeTrans($body, $domain, $count, $vars, $locale, $parsed->getTemplateLine(), $parsed->getNodeTag());
    }
}
